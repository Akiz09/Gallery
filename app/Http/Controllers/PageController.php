<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index(){
        $title = "Pealeht";
        return view('pages.index')->with('title',$title);
    }
}
