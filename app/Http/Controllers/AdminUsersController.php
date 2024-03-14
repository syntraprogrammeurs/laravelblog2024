<?php

namespace App\Http\Controllers;

use App\Events\UsersSoftDelete;
use App\Http\Requests\UsersRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminUsersController extends Controller
{
//    public function __construct(){
//        $this->middleware('auth');
//    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //admin/users/index
        //ELOQUENT ORM
        $users = User::with(['roles','photo'])
            ->orderByDesc('id')
            ->withTrashed()
            ->get();
        //onderstaande lijn is enkel voor standaard html tabellen die ook een paginering wensen. Dus dit wordt niet gebruikt met de javascript datatables.
        //$users = User::orderByDesc('id')->withTrashed()->paginate(3);
        //$users = DB::table('users')->get(); //DB FACADE
        $roles = Role::all();
        return view('admin.users.index',['users'=>$users, 'roles'=>$roles]);
        //manier 2
        //return view('admin.users.index',compact('users','roles));
    }
    public function index2()
    {
        $users = User::orderByDesc('id')->withTrashed()->get();
        $roles = Role::all();
        return view('admin.users.index2',['users'=>$users, 'roles'=>$roles]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::pluck('name','id');
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersRequest $request)
    {
        // Creëert een nieuwe instantie van de User model.
        $user = new User();
        // Stelt de basisgegevens van de gebruiker in met de data verkregen uit het formulier.
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->is_active; // Stelt de actieve status van de gebruiker in.
        $user->password = Hash::make($request->password); // Hash het wachtwoord voor veilige opslag.

        // Controleert of er een bestand geüpload is in het 'photo_id' veld van het formulier.
        if ($request->hasFile('photo_id')) {
            $type = 'users'; // Definieert het type opslagdirectory.
            $originalName = $request->file('photo_id')->getClientOriginalName(); // Haalt de originele naam van het bestand op.
            $extension = $request->file('photo_id')->getClientOriginalExtension(); // Haalt de bestandsextensie op.
            $fileName = pathinfo($originalName, PATHINFO_FILENAME); // Extraheert de bestandsnaam zonder extensie.
            // Creëert een unieke bestandsnaam om conflicten te voorkomen.
            $uniqueName = $fileName . '_' . time() . '.' . $extension;

            // Slaat het bestand op in de gespecificeerde directory ('public') onder de 'users' map.
            $request->file('photo_id')->storeAs($type, $uniqueName, 'public');

            // Maakt een nieuw Photo record in de database met de unieke bestandsnaam.
            $photo = Photo::create(['file' => $uniqueName]);
            // Koppelt de nieuwe foto aan de gebruiker.
            $user->photo_id = $photo->id;
        }

        // Slaat de nieuwe gebruiker op in de database.
        $user->save();

        // Synchroniseert eventuele rollen die aan de gebruiker zijn toegewezen.
        // Het tweede argument 'false' voorkomt het verwijderen van bestaande relaties voordat toevoegen.
        $user->roles()->sync($request->roles, false);

        // Redirect de gebruiker terug naar de gebruikerslijstpagina na succesvolle opslag.
        return redirect('/admin/users');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        //validatie
        $request->validate([
           'name'=>'required|max:255',
            'email'=>'required|email',
           'password'=>'nullable|min:6',
           'photo_id'=>'nullable|max:2048'
        ]);
        //zoek user op
        $user = User::findOrFail($id);

        //controle: wachtwoordveld leeg? zo ja, uitsluiten van de update
        if(trim($request->password)==''){
            $input =$request->except('password');
        }else{
            $input = $request->all();
            $input['password']= Hash::make($request['password']);
        }

        // controle: is er een nieuwe foto tijdens het opladen?
        if($request->hasFile('photo_id')){
            $type = 'users';
            //originele bestandsnaam: bijv dog.jpg
            $originalName = $request->file('photo_id')->getClientOriginalName();
            //extensie van dog.jpg = jpg
            $extension = $request->file('photo_id')->getClientOriginalExtension();
            // bestandsnaam zonder extensie: dog
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            $uniqueName = $fileName . '_' .time().'.'.$extension;
            //opslaan nieuwe foto in de opgegeven bestandslocatie = $type= 'users';
            $request->file('photo_id')->storeAs($type,$uniqueName,'public');

            //verkrijg oude foto als ze bestaat
            $oldPhoto = $user->photo;
            if($oldPhoto){
                //verwijder uit de opslag
                //delete = users/1.jpg, database:1.jpg = $oldPhoto->file
                //database = record 1 met file 1.jpg
                Storage::disk('public')->delete($type.'/'.$oldPhoto->file);
                //update het fotorecord met de nieuwe bestandsnaam
                //1.jpg wordt overschreven met de nieuwe filename,nl. dog_121212.jpg
                $oldPhoto->update(['file'=>$uniqueName]);
                //update de gebruiker met de id van de bestaande fotorecord
                $input['photo_id']=$oldPhoto->id;
            }else{
                //wanneer er een placeholder is: als er geen oude foto is, maak nu een nieuwe aan
                $photo = Photo::create(['file'=>$uniqueName]);
                //update de gebruiker met de id van de bestaande fotorecord
                $input['photo_id']=$photo->id;
            }
        }
        //update user met nieuwe gegevens
        $user->update($input);
        //sync rollen
        $user->roles()->sync($request->roles,true);
        //stuur de gebruiker terug naar de lijst met gebruikers
        return redirect('/admin/users')->with('status', 'User updated!')->with('alert-type', 'success');


    }


    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(string $id)
//    {
//        //
//        $user = User::findOrFail($id)->delete();
//        UsersSoftDelete::dispatch($user);
//        return redirect()->route('users.index')->with('status', 'User Deleted!')->with('alert-type', 'danger');
//        //redirect('/admin/users');
//
//    }
    public function destroy(User $user)
    {
        //
        $user->delete();
        UsersSoftDelete::dispatch($user);
        return redirect()->route('users.index')->with('status', 'User Deleted!')->with('alert-type', 'danger');
        //redirect('/admin/users');
    }
    public function restore(string $id){
        User::onlyTrashed()->where('id',$id)->restore();
        return redirect()->route('users.index')->with('status', 'User Restored!')->with('alert-type', 'warning');
    }
}
