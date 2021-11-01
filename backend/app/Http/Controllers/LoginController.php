<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class LoginController extends Controller
{
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Role::find(2);
            $role->givePermissionTo('items list', 'item details');

            $user = Auth::user();
            $user->assignRole($role->id);

            $response = [
                'user' => $user,
                'permissions' =>  $user->getPermissionsViaRoles()
            ];

            return $response;
        }

        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return true;
    }

    public function isLogged()
    {
        if(Auth::check()){
            $user = Auth::user();

            $response = [
                'user' => $user,
                'permissions' =>  $user->getPermissionsViaRoles()
            ];

            return $response;
        } else {
            return false;
        }
    }
}
