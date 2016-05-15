<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class ClientsController extends Controller
{
     
    public function add()
    {
        $countries = DB::table('Country')->orderBy('Name')->get();
        $industries = DB::table('industries')->orderBy('name')->get(); 
        $clients = DB::table('clients')->orderBy('name')->get(); 


        return view('hr.addClient',compact('countries','industries','clients'));
    }
}
