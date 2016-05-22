<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Client;
use App\Contact;

use Carbon\Carbon;

use Excel;
use Auth;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientsList()
    {
         $clients = Client::select(array('clients.*','Country.Name AS countryName', 'City.Name AS cityName', 'status.status AS currentStatus' , 'bd_grade.grade AS bdGrade','industries.name AS industryName',DB::raw('(SELECT count(id) FROM contacts WHERE contacts.client = clients.id) AS addedContacts'),DB::raw('(SELECT count(id) FROM clientCalls WHERE clientCalls.client = clients.id) AS addedCalls')))  
                            ->leftjoin('Country','clients.country', '=', 'Country.Code')
                            ->leftjoin('City','clients.city', '=', 'City.ID')
                            ->leftjoin('status','clients.status', '=', 'status.id')
                            ->leftjoin('bd_grade','clients.bd_grade', '=', 'bd_grade.id')
                            ->leftjoin('industries','clients.industry', '=', 'industries.id') 
                            ->where('deleted',0)
                            ->orderBy('clients.name')
                            ->get();

        Excel::create('CDN Recruiters Clients', function($excel) use ($clients)  {

        // Set the title
        $excel->setTitle('CDN Recruiters Clients');

        // Chain the setters
        $excel->setCreator(Auth::user()->name)
              ->setCompany('CDN Recruiters');

        // Call them separately
        $excel->setDescription('Clients List Import');

        $excel->sheet('First sheet', function($sheet) use ($clients) {
        $sheet->loadView('excel.clientsList')->with(compact('clients'));
        });
        })->export('xls');
    }

    //---------------------------------------------------------------------------------------------------------------------------------

    public function contactsFilter($position,$industry,$country,$city)
    {
       $filterString=" clients.deleted='0' AND contacts.deleted='0'";

       if($industry)         
        $filterString = $filterString." AND clients.industry='$industry'";

       if($position)       
        $filterString = $filterString." AND contacts.position='$position'";


       if($country) 
        $filterString = $filterString." AND clients.country='$country'";

       if($city)
        $filterString = $filterString." AND clients.city='$city'";


       $contacts = Contact::select('contacts.*','Country.Name AS countryName', 'City.Name AS cityName', 'clients.name AS clientName' ,'industries.name AS industryName','designations.position AS positionName')
                            ->leftjoin('clients','clients.id', '=', 'contacts.client')
                            ->leftjoin('Country','clients.country', '=', 'Country.Code')
                            ->leftjoin('City','clients.city', '=', 'City.ID') 
                            ->leftjoin('industries','clients.industry', '=', 'industries.id') 
                            ->leftjoin('designations','contacts.position', '=', 'designations.id')
                            ->whereRaw($filterString)  
                            ->orderBy('clients.name','contacts.name')
                            ->get();

        Excel::create('CDN Recruiters Contacts', function($excel) use ($contacts)  {

        // Set the title
        $excel->setTitle('CDN Recruiters Contacts');

        // Chain the setters
        $excel->setCreator(Auth::user()->name)
              ->setCompany('CDN Recruiters');

        // Call them separately
        $excel->setDescription('Contacts List Import');

        $excel->sheet('First sheet', function($sheet) use ($contacts) {
        $sheet->loadView('excel.contactsList')->with(compact('contacts'));
        });
        })->export('xls');

                         //   return view('excel.contactsList',compact('contacts'));
    }

    
}
