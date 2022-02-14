<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public static function deleteUser(Request $request){
        User::where('id', $request->id)->delete();
        return redirect()->route('users');
    }
    public static function showUser(){
        $users= User::all();
        return view('pages.users' , ['users'=>$users]);
        }
}
