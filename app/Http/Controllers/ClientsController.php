<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ClientAddRequest;


use DB;
use App\Client;

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
                                    'google_map'=>$request->google_map,
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

       if (File::exists(base_path().'/public/uploads/clientLogos/'.$clientId.'.jpg'))
            $profile_pic = '/uploads/clientLogos/'.$clientId.'.jpg' ; 
       else
            $profile_pic = '/uploads/clientLogos/no_image.jpg';                   

          return view('clients.profile',compact('clientId','client','profile_pic','subsidiaries'));
    }

//------------------------------------------------------------------------------------------------------------------------------------------

   public function edit($clientId)
    {
         $clientId = base64_decode($clientId);

        $countries = DB::table('Country')->orderBy('Name')->get();
        $industries = DB::table('industries')->orderBy('name')->get(); 
        $clients = Client::orderBy('name')->get(); 
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


}
