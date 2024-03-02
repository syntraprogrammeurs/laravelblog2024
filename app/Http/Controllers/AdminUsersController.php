<?php

namespace App\Http\Controllers;

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
        $users = User::all();
        //$users = DB::table('users')->get(); //DB FACADE
        $roles = Role::all();
        return view('admin.users.index',['users'=>$users, 'roles'=>$roles]);
        //manier 2
        //return view('admin.users.index',compact('users','roles));
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
        // Valideer de input van de gebruiker met specifieke regels voor elk veld
        $request->validate([
            'name' => 'required|max:255', // Naam is verplicht en mag maximaal 255 tekens lang zijn
            'email' => 'required|email', // E-mail is verplicht en moet een geldig e-mailadres zijn
            'password' => 'nullable|min:6', // Wachtwoord is optioneel maar moet minimaal 6 tekens lang zijn als het wordt opgegeven
            'photo_id' => 'nullable|image|max:2048', // Foto is optioneel, moet een afbeeldingsbestand zijn en mag maximaal 2MB groot zijn
        ]);

        // Zoek de gebruiker op ID, gooi een 404 error als de gebruiker niet gevonden wordt
        $user = User::findOrFail($id);

        // Controleer of het wachtwoordveld leeg is, zo ja, sluit het uit van de update
        if(trim($request->password) == ''){
            $input = $request->except('password');
        } else {
            // Als er een nieuw wachtwoord is opgegeven, neem alle input op en hash het nieuwe wachtwoord
            $input = $request->all();
            $input['password'] = Hash::make($request['password']);
        }

        // Controleer of er een nieuwe foto is geüpload
        if ($request->hasFile('photo_id')) {
            // Definieer het opslagtype
            $type = 'users';
            // Haal de originele naam van de geüploade foto op
            $originalName = $request->file('photo_id')->getClientOriginalName();
            // Haal de bestandsextensie op
            $extension = $request->file('photo_id')->getClientOriginalExtension();
            // Haal de bestandsnaam zonder extensie op
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            // Maak een unieke bestandsnaam met de huidige tijd om duplicaten te voorkomen
            $uniqueName = $fileName . '_' . time() . '.' . $extension;
            // Sla de nieuwe foto op in de opgegeven opslaglocatie
            $request->file('photo_id')->storeAs($type, $uniqueName, 'public');

            // Verkrijg de oude foto, als deze bestaat
            $oldPhoto = $user->photo;
            if ($oldPhoto) {
                // Verwijder de oude foto uit de opslag
                Storage::disk('public')->delete($type . '/' . $oldPhoto->file);
                // Update de fotorecord met de nieuwe bestandsnaam
                $oldPhoto->update(['file'=>$uniqueName]);
                // Update de gebruiker met de ID van de bestaande fotorecord
                $input['photo_id'] = $oldPhoto->id;
            } else {
                // Als er geen oude foto is, maak een nieuwe fotorecord aan
                $photo = Photo::create(['file' => $uniqueName]);
                // Update de gebruiker met de ID van de nieuwe fotorecord
                $input['photo_id'] = $photo->id;
            }
        }

        // Update de gebruiker met de nieuwe gegevens
        $user->update($input);
        // Synchroniseer de rollen van de gebruiker (voeg toe of verwijder waar nodig)
        $user->roles()->sync($request->roles, true);

        // Stuur de gebruiker terug naar de lijst met gebruikers
        return redirect('/admin/users');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
