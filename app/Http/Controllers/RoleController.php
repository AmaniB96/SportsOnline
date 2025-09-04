<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $admin = User::where('role_id',3)->get();
        $users = User::where('role_id',1)->get();
        $coach = User::where('role_id',2)->get();
        $roles = Role::all();
        return view('back.user',compact('admin','users','coach','roles'));
    }
    public function update($id){
        User::firstOrFail($id)->update([
            'role_id' => request('role_id')
        ]);
        return redirect()->route('back.user.index');
    }
}
