<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        //
       // dd($request);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->is_active;
        $user->password = Hash::make($request['password']);
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('assets/img', $name);
            $photo = Photo::create(['file'=>$name]);
            $user->photo_id = $photo->id;
        }
        $user->save();

        $user->roles()->sync($request->roles,false);

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
    public function update(Request $request, string $id)
    {
        //validation
        request()->validate([
           'name'=>['required','max:255','min:2'],
           'email'=>['required','email'],
           'roles'=>['required', Rule::exists('roles', 'id')],
           'is_active'=>'required'
        ]);

        $user = User::findOrFail($id);
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password']= Hash::make($request['password']);
        }
        //oude foto verwijderen
        //kijken of de foto bestaat?
        if($request->hasFile('photo_id')){
            //the file upload behandelen
            $oldPhoto = Photo::find($user->photo_id);
            if($oldPhoto){
                $oldImagePath = public_path($oldPhoto->file);
                if(file_exists($oldImagePath)){
                    //fysisch verwijderen van server
                    unlink($oldImagePath);
                }
                //verwijderen in de database
                $oldPhoto->delete();
            }
            //nieuwe foto toevoegen
            $file = $request->file('photo_id');
            $name = time() . $file->getClientOriginalName();
            $file->move('assets/img', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }else{
            $input['photo_id'] =$user->photo_id;
        }
        $user->update($input);
        $user->roles()->sync($request->roles, true);
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
