<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        echo "Controller HomeController<br>";
        dd($this);
        echo "Olá Mundo!!!";
    }

    public function welcome($name = null){
        $name = $name?$name:"World";
        echo "Hello $name !!!";
    }

    public function listUsers(){
        $listUsers = User::all();
        // dd($listUsers);
    }
}
