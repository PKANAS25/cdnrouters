<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ClientAddRequest;


use DB;
use App\Client;

use Carbon\Carbon;

use Auth;

use File;
use Image;

class ClientsController extends Controller
{

    public function index()
    {  
        $clients = Client::select('clients.*','Country.Name AS countryName', 'City.Name AS cityName', 'status.status AS currentStatus' , 'bd_grade.grade AS bdGrade','industries.name AS industryName' )
                            ->leftjoin('Country','clients.country', '=', 'Country.Code')
                            ->leftjoin('City','clients.city', '=', 'City.ID')
                            ->leftjoin('status','clients.status', '=', 'status.id')
                            ->leftjoin('bd_grade','clients.bd_grade', '=', 'bd_grade.id')
                            ->leftjoin('industries','clients.industry', '=', 'industries.id') 
                            ->orderBy('clients.name')
                            ->get();

       return view('clients.index',compact('clients'));                     
    }

   //------------------------------------------------------------------------------------------------------------------------------------------


    public function add()
    {
        $countries = DB::table('Country')->orderBy('Name')->get();
        $industries = DB::table('industries')->orderBy('name')->get(); 
        $clients = Client::orderBy('name')->get(); 
        $status = DB::table('status')->get();
        $bdGrades = DB::table('bd_grade')->get();


        return view('clients.addClient',compact('countries','industries','clients','status','bdGrades'));
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

 public function clientEditCheck(Request $request)
    {
          
          $name = $request->get('name'); 

          $count = Client::whereRAW("name LIKE '%".$name."%'")->where('id','!=',$request->clientId)
                            ->count();
            

        if($count)
        return response()->json(['valid' => 'false', 'message' => 'Name exists in the database. Make sure you are not repeating','available'=>'false']);

        else
        return response()->json(['valid' => 'true', 'message' => ' ','available'=>'true']);
         
    } 

//------------------------------------------------------------------------------------------------------------------------------------------

    public function save(ClientAddRequest $request)
    {
          
           $name = ucwords(strtolower($request->name));
  
             $client = new Client(array( 
                                    'name'=>$name,
                                    'industry'=>$request->industry,
                                    'status'=>$request->status,
                                    'bd_grade'=>$request->bd_grade,
                                    'parent_company'=>$request->parent_company,
                                    'url'=>$request->url,
                                    'phone'=>$request->phone,
                                    'country'=>$request->country,
                                    'city'=>$request->city,
                                    'description'=>$request->description,
                                    'address'=>$request->address,
                                    'postal_code'=>$request->postal_code,
                                    'added_by'=>Auth::id(), 
                                   ));
                
                $client->save();
                $clientId = $client->id; 

                if($request->file('fileToUpload') && $clientId)
                {
                 $imageName = $clientId.'.jpg';  
                 Image::make($request->file('fileToUpload'))->save(base_path().'/public/uploads/clientLogos/'.$imageName); 
                } 

               return redirect()->action('ClientsController@profile',base64_encode($clientId))->with('status', 'New Client added!');

         
    }  

//------------------------------------------------------------------------------------------------------------------------------------------

    public function profile($clientId)
    {
         $clientId = base64_decode($clientId);

         $client = Client::select('clients.*','Country.Name AS countryName', 'City.Name AS cityName', 'status.status AS currentStatus' , 'bd_grade.grade AS bdGrade','industries.name AS industryName','parenter.name AS parentCompany','users.name AS addedBy')
                            ->leftjoin('Country','clients.country', '=', 'Country.Code')
                            ->leftjoin('City','clients.city', '=', 'City.ID')
                            ->leftjoin('status','clients.status', '=', 'status.id')
                            ->leftjoin('bd_grade','clients.bd_grade', '=', 'bd_grade.id')
                            ->leftjoin('industries','clients.industry', '=', 'industries.id')
                            ->leftjoin('users','clients.added_by', '=', 'users.id')
                            ->leftjoin('clients AS parenter','clients.parent_company', '=', 'parenter.id')
                            ->where('clients.id',$clientId)
                            ->first();

        $subsidiaries = Client::select('name','id')->where('parent_company',$clientId)->get();  

         $changes = DB::table('clientsHistory')
                     ->select('clientsHistory.*','users.name AS addedBy')
                     ->leftjoin('users','clientsHistory.admin', '=', 'users.id')
                     ->where('client_id',$clientId) 
                     ->orderBy('dated','desc') 
                     ->get();                   

       if (File::exists(base_path().'/public/uploads/clientLogos/'.$clientId.'.jpg'))
            $profile_pic = '/uploads/clientLogos/'.$clientId.'.jpg' ; 
       else
            $profile_pic = '/uploads/clientLogos/no_image.jpg';                   

          return view('clients.profile',compact('clientId','client','profile_pic','subsidiaries','changes'));
    }

//------------------------------------------------------------------------------------------------------------------------------------------

   public function edit($clientId)
    {
         $clientId = base64_decode($clientId);

        $countries = DB::table('Country')->orderBy('Name')->get();
        $industries = DB::table('industries')->orderBy('name')->get(); 
        $clients = Client::orderBy('name')->where('id','!=',$clientId)->get(); 
        $status = DB::table('status')->get();
        $bdGrades = DB::table('bd_grade')->get();


         $client = Client::select('clients.*','Country.Name AS countryName', 'City.Name AS cityName', 'status.status AS currentStatus' , 'bd_grade.grade AS bdGrade','industries.name AS industryName','parenter.name AS parentCompany','users.name AS addedBy')
                            ->leftjoin('Country','clients.country', '=', 'Country.Code')
                            ->leftjoin('City','clients.city', '=', 'City.ID')
                            ->leftjoin('status','clients.status', '=', 'status.id')
                            ->leftjoin('bd_grade','clients.bd_grade', '=', 'bd_grade.id')
                            ->leftjoin('industries','clients.industry', '=', 'industries.id')
                            ->leftjoin('users','clients.added_by', '=', 'users.id')
                            ->leftjoin('clients AS parenter','clients.parent_company', '=', 'parenter.id')
                            ->where('clients.id',$clientId)
                            ->first();

        $subsidiaries = Client::select('name','id')->where('parent_company',$clientId)->get();  

                      

       if (File::exists(base_path().'/public/uploads/clientLogos/'.$clientId.'.jpg'))
            $profile_pic = '/uploads/clientLogos/'.$clientId.'.jpg' ; 
       else
            $profile_pic = '';    
           

        return view('clients.editClient',compact('clientId','client','profile_pic','subsidiaries','countries','industries','clients','status','bdGrades'));
    }

//------------------------------------------------------------------------------------------------------------------------------------------

    public function editProcess(ClientAddRequest $request,$clientId)
    {
             $clientId = base64_decode($clientId);

             $client = Client::select('clients.*','Country.Name AS countryName', 'City.Name AS cityName', 'status.status AS currentStatus' , 'bd_grade.grade AS bdGrade','industries.name AS industryName','parenter.name AS parentCompany','users.name AS addedBy')
                            ->leftjoin('Country','clients.country', '=', 'Country.Code')
                            ->leftjoin('City','clients.city', '=', 'City.ID')
                            ->leftjoin('status','clients.status', '=', 'status.id')
                            ->leftjoin('bd_grade','clients.bd_grade', '=', 'bd_grade.id')
                            ->leftjoin('industries','clients.industry', '=', 'industries.id')
                            ->leftjoin('users','clients.added_by', '=', 'users.id')
                            ->leftjoin('clients AS parenter','clients.parent_company', '=', 'parenter.id')
                            ->where('clients.id',$clientId)
                            ->first();

             $historyString = "";

            if($client->name!=ucwords(strtolower($request->name)))
                $historyString = $historyString."Name : ".$client->name."=>".$request->name."<br>";

            if($client->industry != $request->industry)
                {
                    $industry = DB::table('industries')->where('id',$request->industry)->first();
                    $historyString = $historyString."Industry : ".$client->industryName."=>".$industry->name."<br>";
                }

            if($client->status != $request->status)
                {
                    $status = DB::table('status')->where('id',$request->status)->first();
                    $historyString = $historyString."Status : ".$client->currentStatus."=>".$status->status."<br>";
                }

            if($client->bd_grade != $request->bd_grade)
                {
                    $bdGrade = DB::table('bd_grade')->where('id',$request->bd_grade)->first();
                    $historyString = $historyString."BD Grade : ".$client->bdGrade."=>".$bdGrade->grade."<br>";
                }

            if($client->parent_company != $request->parent_company)
                {   
                   $temp1 =  $temp2 = "None";  

                   if($client->parent_company!=0)
                    {
                        $parentCompany1 = Client::where('id',$client->parent_company)->first();
                        $temp1 = $parentCompany1->name;
                    }           

                    if($request->parent_company!=0)
                    {
                        $parentCompany2 = Client::where('id',$request->parent_company)->first();
                        $temp2 = $parentCompany2->name;
                    }
                    
                    
                    $historyString = $historyString."Parent Company : ".$temp1."=>".$temp2."<br>";
                }        
                    
            if($client->url!=$request->url)
                $historyString = $historyString."URL Changed<br>";

            if($client->phone!=$request->phone)
                $historyString = $historyString."Phone : ".$client->phone."=>".$request->phone."<br>";

            if($client->country!=$request->country || $client->city!=$request->city || $client->address!=$request->address || $client->postal_code!=$request->postal_code)
                $historyString = $historyString."Address/Location changed<br>";

             if($client->description!=$request->description)
                $historyString = $historyString."Company description changed<br>";

                        $client->name = ucwords(strtolower($request->name));
                        $client->industry = $request->industry;
                        $client->status = $request->status;
                        $client->bd_grade = $request->bd_grade;
                        $client->parent_company = $request->parent_company;
                        $client->url = $request->url;
                        $client->phone = $request->phone;
                        $client->country = $request->country;
                        $client->city = $request->city;
                        $client->description = $request->description;
                        $client->address = $request->address;
                        $client->postal_code = $request->postal_code;

                        $client->save(); 

                if($request->file('fileToUpload'))
                {
                    if (File::exists(base_path().'/public/uploads/clientLogos/'.$clientId.'.jpg'))
                         File::delete(base_path().'/public/uploads/clientLogos/'.$clientId.'.jpg');

                 $imageName = $clientId.'.jpg';  
                 Image::make($request->file('fileToUpload'))->save(base_path().'/public/uploads/clientLogos/'.$imageName); 

                 $historyString = $historyString."Logo Changed";
                } 

                DB::table('clientsHistory')->insert(['client_id' => $clientId,'admin' => Auth::id(),'changes' => $historyString,'dated' => Carbon::now()]);

               return redirect()->action('ClientsController@profile',base64_encode($clientId))->with('status', 'Editted succesfully!');

         
    }  

//------------------------------------------------------------------------------------------------------------------------------------------

}
