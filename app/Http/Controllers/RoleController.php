<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function update($id){
        User::findOrFail($id)->update([
            'role_id' => request('role_id')
        ]);
        return redirect()->route('back.user.index');
    }
}
