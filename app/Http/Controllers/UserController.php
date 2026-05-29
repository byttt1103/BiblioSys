<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        return view ('management.users.index', compact('users'));;
    }


    public function create (){
        $roles = Role::all();
        return view('management.users.create', compact('roles'));
    }

    //creates a new user from the data of the create form
    public function store(Request $request){

        // Default to role ID 3 if not provided
        $data['roles'] = $data['roles'] ?? 3;

         $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'document_number' => 'required|integer|unique:users,document_number|digits_between:1,10',
            'phone_number' => 'required|integer|max:3999999999', // Assuming a max of 10 digits for phone numbers
            'address' => 'required|string|max:255',
            'email' => 'email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        if($data['roles'] == 1){
            $roles = [$data['roles'], 2];
        }else if($data['roles'] == 2){
            $roles = [$data['roles']];
        }else {
            $roles = [$data['roles']];
        }

          unset($data['roles']);

        DB::transaction(function() use ($data, $roles){
            $user = User::create($data);
            $user->roles()->attach($roles);
        });
    }

    public function edit(User $user){
        $roles = Role::all();
        return view ('management.users.update', compact('user', 'roles'));
    }

    public function update(Request $request, User $user){
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'document_number' => 'required|integer|digits_between:1,10|unique:users,document_number,' . $user->id,
            'phone_number' => 'required|integer|max:3999999999', // Assuming a max of 10 digits for phone numbers
            'address' => 'required|string|max:255',
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $roles = $data['roles'];

        // if($data['roles'] == 1){
        //     $roles = [$data['roles'], 2];
        // }else if($data['roles'] == 2){
        //     $roles = [$data['roles'], 3];
        // }else {
        //     $roles = [$data['roles']];
        // }

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);}

          unset($data['roles']);

        DB::transaction(function() use ($data, $roles, $user){
            $user->update($data);
            $user->roles()->sync(array_values($roles));
        });

        return redirect()->back()->with("success", "Usuario actualizado correctamente");
    }

    public function destroy(User $user){
        $user->loans()->delete();
        $user->delete();

        return redirect()->back()->with("success", "Usuario eliminado correctamente");
    }

    public function show_profile(){
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update_profile(Request $request){
        $user = Auth::user();

        $data = $request->validate([
            'avatar_path' => 'nullable|url|max:255',
            'phone_number' => 'required|integer|max:3999999999', // Assuming a max of 10 digits for phone numbers
            'address' => 'required|string|max:255',
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        unset($data['first_name']);
        unset($data['last_name']);
        unset($data['document_number']);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->back()->with("success", "Perfil actualizado correctamente");
    }
}
