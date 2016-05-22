<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class SettingsController extends Controller
{
    
    public function industries()
    {
        $industries = DB::table('industries')->orderBy('name')->get();  
        return view('settings.industries',compact('industries'));
    }

//-------------------------------------------------------------------------------------------------------------------------------------------

    public function industryAddCheck(Request $request)
    {
        $name = $request->get('name'); 

        $count = DB::table('industries')->whereRAW("name LIKE '%".$name."%'")
                            ->count();
            

        if($count)
        return response()->json(['valid' => 'false', 'message' => 'Name exists in the database. Make sure you are not repeating','available'=>'false']);

        else
        return response()->json(['valid' => 'true', 'message' => ' ','available'=>'true']);
    }

//-------------------------------------------------------------------------------------------------------------------------------------------

public function saveIndustry(Request $request)
    {
           $this->validate($request, [
        'name' => 'required', ]); 

           DB::table('industries')->insert(['name' => $request->name]);
           $status = $request->name. " industry added!";
 
               return redirect()->action('SettingsController@industries')->with('status', $status);
    }
//-------------------------------------------------------------------------------------------------------------------------------------------

public function positions()
    {
        $positions = DB::table('designations')->orderBy('position')->get();  
        return view('settings.positions',compact('positions'));
    }

//-------------------------------------------------------------------------------------------------------------------------------------------

    public function positionAddCheck(Request $request)
    {
        $name = $request->get('name'); 

        $count = DB::table('designations')->whereRAW("position LIKE '%".$name."%'")
                            ->count();
            

        if($count)
        return response()->json(['valid' => 'false', 'message' => 'Name exists in the database. Make sure you are not repeating','available'=>'false']);

        else
        return response()->json(['valid' => 'true', 'message' => ' ','available'=>'true']);
    }

//-------------------------------------------------------------------------------------------------------------------------------------------

public function savePosition(Request $request)
    {
           $this->validate($request, [
        'name' => 'required', ]); 

           DB::table('designations')->insert(['position' => $request->name]);
           $status = $request->name. " position added!";
 
               return redirect()->action('SettingsController@positions')->with('status', $status);               

         
    }  
    
}
