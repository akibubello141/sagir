<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Http\Model;

class SupervisorController extends Controller
{
    public function products(){
        return view('supervisor.products');
    }
     public function drivers(){
        return view('supervisor.drivers');
    }
    public function maintenences(){
        return view('supervisor.maintenances');
    }
    public function reports(){
        return view('supervisor.reports');
    }

}
