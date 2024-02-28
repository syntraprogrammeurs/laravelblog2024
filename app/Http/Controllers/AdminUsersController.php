<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->is_active;
        $user->password = Hash::make($request['password']);
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
