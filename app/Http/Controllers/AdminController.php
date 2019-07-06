<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users(){

        $users = User::orderBy('approved_at')->with('roles')->paginate(3);
//        return $users;

//        $roles = $users->roles;
//        return User::with('roles')->first()->roles->first()->name;

//        User::all()->sortBy('');
        return view('admin.users', compact('users'));
    }

    public function userDetail(User $user){
       return view('admin.user_detail', compact('user'));
    }

    public function approvingUser(User $user){

        if(!$user->approved_at){
            $user->approved_at = now();
            $user->save();
            return redirect()->back()->with('status', 'the usr approved successfully');
        }
        return redirect()->back()->with('error', 'something sent wrong');

    }
}
