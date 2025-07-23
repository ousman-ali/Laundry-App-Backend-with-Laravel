<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        return User::all();
    }


    // Show a single user
    public function show($id)
    {
        return User::findOrFail($id);
    }

    // Update user info
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'password' => 'nullable|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    //assigning roles method
    public function assignRoles(Request $request, $id)
    {
        $request->validate([
            'roles' => 'required|array',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->syncRoles($request->roles); // e.g. ['admin']

        return response()->json([
            'user' => $user->load('roles'),
            'roles_assigned' => $request->roles,
            'model_has_roles' => DB::table('model_has_roles')->where('model_id', $user->id)->get(),
        ]);
    }

    //Get a user by role 
    public function getByRole($roleName)
    {
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $users = User::role($roleName)->get(); // This is provided by Spatie

        return response()->json([
            'role' => $roleName,
            'users' => $users
        ]);
    }

}
