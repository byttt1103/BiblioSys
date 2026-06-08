<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Loan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();

        $users = User::query()
            ->with(['roles'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('document_number', 'LIKE', "%{$search}%");
                });
            })
            ->get();

        return view('management.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('management.users.create', compact('roles'));
    }

    // creates a new user from the data of the create form
    public function store(Request $request)
    {

        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'document_number' => 'required|integer|unique:users,document_number|digits_between:1,10',
            'phone_number' => 'required|integer|max:3999999999', // Assuming a max of 10 digits for phone numbers
            'address' => 'required|string|max:255',
            'email' => 'email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|integer|exists:roles,id',

        ], [
            'first_name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'document_number.required' => 'El número de documento es obligatorio.',
            'phone_number.required' => 'El número de teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'document_number.unique' => 'El número de documento ya está registrado.',
            'phone_number.unique' => 'El número de teléfono ya está registrado.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'address.max' => 'La dirección no puede exceder 255 caracteres.',
        ]);

        $selectedRole = $data['roles'];

        $addedRoles = [];

        if ($selectedRole == 1) {
            $addedRoles = [1, 2];
        } else{
            $addedRoles = [$selectedRole];
        }

        unset($data['roles']);

        DB::transaction(function () use ($data, $addedRoles) {
            $user = User::create($data);
            $user->roles()->attach($addedRoles);
        });

         return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $library = Library::query()->first();

        return view('management.users.update', compact('user', 'roles', 'library'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'document_number' => 'required|integer|digits_between:1,10|unique:users,document_number,'.$user->id,
            'phone_number' => 'required|integer|max:3999999999', // Assuming a max of 10 digits for phone numbers
            'address' => 'required|string|max:255',
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ], [
            'first_name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'document_number.required' => 'El número de documento es obligatorio.',
            'phone_number.required' => 'El número de teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'document_number.unique' => 'El número de documento ya está registrado.',
            'phone_number.unique' => 'El número de teléfono ya está registrado.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'address.max' => 'La dirección no puede exceder 255 caracteres.',
        ]);

        $roles = $data['roles'];


        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        unset($data['roles']);

        DB::transaction(function () use ($data, $roles, $user) {
            $user->update($data);
            $user->roles()->sync(array_values($roles));
        });

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        $user->update(['is_archived' => 1]);
        $loans = Loan::where('user_id', $user->id)->get();

        foreach ($loans as $loan) {
            $loan->update(['is_archived' => 1]);
        }

        return redirect()->route('users.index')->with('success', 'Usuario desactivado correctamente');
    }

    public function restore(User $user)
    {
        $user->update(['is_archived' => 0]);
        $loans = Loan::where('user_id', $user->id)->get();

        foreach ($loans as $loan) {
            $loan->update(['is_archived' => 0]);
        }

        return redirect()->route('users.index')->with('success', 'Usuario activado correctamente');
    }



    public function show_profile()
    {
        $user = Auth::user();
        $library = Library::query()->first();

        return view('profile.show', compact('user', 'library'));
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'phone_number' => 'required|integer|max:3999999999', // Assuming a max of 10 digits for phone numbers
            'address' => 'required|string|max:255',
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        unset($data['first_name']);
        unset($data['last_name']);
        unset($data['document_number']);

        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('index')->with('success', 'Perfil actualizado correctamente');
    }
}
