<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminContoller extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
        
    }
}
