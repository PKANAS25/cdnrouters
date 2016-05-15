<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ClientAddRequest;


use DB;
use App\Client;

class ClientsController extends Controller
{
     
    public function add()
    {
        $countries = DB::table('Country')->orderBy('Name')->get();
        $industries = DB::table('industries')->orderBy('name')->get(); 
        $clients = Client::orderBy('name')->get(); 


        return view('hr.addClient',compact('countries','industries','clients'));
    }


//------------------------------------------------------------------------------------------------------------------------------------------

   public function cityLoader(Request $request)
    {
        $country = $request->country;
        
           
            $cities = DB::table('City')
                        ->where('CountryCode',$country)  
                        ->get();
                ?>
                    <select class="form-control" name="city"  data-fv-notempty="true" >
                    <option value="0" >Multiple Cities</option>
                    <?php  
                        foreach($cities AS $city) { ?>
                        <option value="<?php echo $city->ID; ?>" ><?php echo $city->Name; ?></option>
                    <?php } ?> 
                    </select> 
                <?php
        
    }


//------------------------------------------------------------------------------------------------------------------------------------------

 public function clientAddCheck(Request $request)
    {
          
          $name = $request->get('name'); 

          $count = Client::whereRAW("name LIKE '%".$name."%'")
                            ->count();
            

        if($count)
        return response()->json(['valid' => 'false', 'message' => 'Name exists in the database. Make sure you are not repeating','available'=>'false']);

        else
        return response()->json(['valid' => 'true', 'message' => ' ','available'=>'true']);
         
    } 



//------------------------------------------------------------------------------------------------------------------------------------------

     public function save(ClientAddRequest $request)
    {
          
          echo "tester";
         
    } 



//------------------------------------------------------------------------------------------------------------------------------------------



}
