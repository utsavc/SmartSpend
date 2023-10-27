<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;  
use App\Models\User;  

class HomeController extends Controller
{
    //Entry point of the app
    public function index(Request $request){
        return view('home');
    }

    //shows the login page
    function login(){
        return view('login');
    }

    //shows the registration page
    function registration(){
        $department=Department::all();
        $user=User::all()->count();
        return view('registration',['user'=>$user,'department'=>$department]);
    }
}
