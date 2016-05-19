<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Client;
use App\Contact;

use Carbon\Carbon;

use Auth; 


class CallsController extends Controller
{
   
    public function add($clientId)
    {
         
        $client = Client::select('name','id')->where('id',base64_decode($clientId))->first();
        $contacts =Contact::select('name','id')->where('client',base64_decode($clientId))->orderBy('name')->get(); 

        return view('clients.addCall',compact('clientId','client','contacts'));
    }

     //--------------------------------------------------------------------------------------------
}
