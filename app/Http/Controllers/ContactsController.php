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

use File;
use Image;

class ContactsController extends Controller
{
    
    public function add($clientId)
    {
        $designations = DB::table('designations')->orderBy('position')->get(); 
        $client = Client::select('name','id')->where('id',base64_decode($clientId))->first();

        return view('clients.addContact',compact('clientId','designations','client'));
    }

  //--------------------------------------------------------------------------------------------------


   public function contactAddCheck(Request $request)
    {
          
          $name = $request->get('name'); 
          $id = $request->get('clientId'); 

          $count =Contact::whereRAW("name LIKE '%".$name."%'")->where('client',$id)
                            ->count();
            

        if($count)
        return response()->json(['valid' => 'false', 'message' => 'Similar Name exists in the database. Make sure you are not repeating','available'=>'false']);

        else
        return response()->json(['valid' => 'true', 'message' => ' ','available'=>'true']);
         
    } 

//------------------------------------------------------------------------------------------------------------------------------------------

 
    public function save($clientId,Request $request)
    {
        $this->validate($request, [
        'name' => 'required', 
        'position' => 'required',
        'mobile' => 'required|numeric',
        'phone' => 'numeric',
        'phone2' => 'numeric',
        'fileToUpload'=>'image|max:615|mimes:jpeg,jpg',]); 

          $clientId =  base64_decode($clientId);
 
          $contact = new Contact(array( 
                                    'name'=>ucwords(strtolower($request->name)),
                                    'client'=>$clientId,
                                    'position'=>$request->position,
                                    'mobile'=>$request->mobile,
                                    'phone'=>$request->phone,
                                    'phone2'=>$request->phone2,
                                    'email'=>$request->email,
                                    'notes'=>$request->notes,
                                    'addedBy'=>Auth::id(), 
                                   ));
                
                $contact->save();
                $contactId = $contact->id; 

                if($request->file('fileToUpload') && $contactId)
                {
                 $imageName = $contactId.'.jpg';  
                 Image::make($request->file('fileToUpload'))->save(base_path().'/public/uploads/contactPics/'.$imageName); 
                } 

               return redirect()->action('ClientsController@profile',base64_encode($clientId))->with('status', 'New Contact added!');

         
    }  
//------------------------------------------------------------------------------------------------------------------------------------------  

public function deleteClientContact(Request $request)
   {
      $id = $request->id;

      Contact::where('id',$id)->update(['deleted' => 1,'deletedBy' => Auth::id()]);
 
        echo "<i class=\"fa fa-check-circle-o  text-danger\"></i>"; 
  }

//------------------------------------------------------------------------------------------------------------------------------------------


  public function restoreClientContact(Request $request)
   {
      $id = $request->id;

      Contact::where('id',$id)->update(['deleted' => 0,'deletedBy' => '']);
 
        echo "<i class=\"fa fa-check-circle-o  text-success\"></i>"; 
  }

//------------------------------------------------------------------------------------------------------------------------------------------


public function edit($clientId,$contactId)
    {
        $designations = DB::table('designations')->orderBy('position')->get();  

        $contact = Contact::select('contacts.*','designations.position AS desig') 
                           ->leftjoin('designations','contacts.position', '=', 'designations.id')
                           ->where('contacts.id',base64_decode($contactId) ) 
                           ->first();

        return view('clients.editContact',compact('clientId','contactId','designations','contact'));
    }

//--------------------------------------------------------------------------------------------------


   public function contactEditCheck(Request $request)
    {
          
          $name = $request->get('name'); 
          $clientId = $request->get('clientId'); 
          $contactId = $request->get('contactId'); 

          $count =Contact::whereRAW("name LIKE '%".$name."%'")->where('client',$clientId)->where('id','!=',$contactId)
                            ->count();
            

        if($count)
        return response()->json(['valid' => 'false', 'message' => 'Similar Name exists in the database. Make sure you are not repeating','available'=>'false']);

        else
        return response()->json(['valid' => 'true', 'message' => ' ','available'=>'true']);
         
    }  

    //------------------------------------------------------------------------------------------------------------------------------------------

 
    public function editProcess($clientId,$contactId,Request $request)
    {
        $this->validate($request, [
        'name' => 'required', 
        'position' => 'required',
        'mobile' => 'required|numeric',
        'phone' => 'numeric',
        'phone2' => 'numeric',
        'fileToUpload'=>'image|max:615|mimes:jpeg,jpg',]); 

        $clientId =  base64_decode($clientId);
        $contactId =  base64_decode($contactId);

        $contact = Contact::where('id',$contactId)->first();
 
         $contact->name = ucwords(strtolower($request->name));
         $contact->position = $request->position;
         $contact->mobile = $request->mobile;
         $contact->phone = $request->phone;
         $contact->phone2 = $request->phone2;
         $contact->email = $request->email;
         $contact->notes = $request->notes;

         $contact->save();

         if($request->file('fileToUpload') && $contactId)
                {
                     if (File::exists(base_path().'/public/uploads/contactPics/'.$contactId.'.jpg'))
                         File::delete(base_path().'/public/uploads/contactPics/'.$contactId.'.jpg');

                 $imageName = $contactId.'.jpg';  
                 Image::make($request->file('fileToUpload'))->save(base_path().'/public/uploads/contactPics/'.$imageName); 
                } 

        return redirect()->action('ClientsController@profile',base64_encode($clientId))->with('status', 'Contact Editted!');        
    }   

  //--------------------------------------------------------------------------------------------------



}
