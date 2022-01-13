<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function edit($id) {
        if(!Auth::user()->hasRole('administrator')) {
            abort('404');
        }

        $roles = Role::all();

        $user = User::find($id);

        return view('roles.edit')->with(\compact('roles', 'user'));
    }

    public function update(Request $request) {
        $roles = $request->input('roles');
        $user = User::find($request->input('user_id'));

        $user->syncRoles($roles);

        return \redirect('/');
    }
}
