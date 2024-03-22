<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ward;

class WardController extends Controller
{
    public function allWard()
    {
    	$datas=Ward::orderBy('id','DESC')->get();
    	return view('ward.all')->with('datas',$datas);
    }

    public function addWardPage($id)
    {
    	$data=Ward::find($id);
    	return view('ward.add')->with('data',$data);
    }

    public function addWard(Request $request)
    {
    	$data=new Ward();
    	$data->name=$request->ward_name;
    	$data->save();

		$notification = array(
            'message' => 'Ward Added Successfully !',
            'alert-type' => 'success'
        );

    	return redirect()->back()->with($notification);
    }

    public function deleteWard($id)
    {
    	$data=Ward::find($id)->delete();
    	$notification = array(
            'message' => 'Ward Deleted Successfully !',
            'alert-type' => 'success'
        );

    	return redirect()->back()->with($notification);

    }

    public function updateWardData(Request $request)
    {
    	$data=Ward::find($request->id);
    	if($data)
    	{
    		$data->name=$request->name;
    		$data->is_active=$request->status;
    		$data->save();

    		$notification = array(
            'message' => 'Ward Details Updated Successfully !',
            'alert-type' => 'success'
        );
    	return redirect('wards/all')->with($notification);


    	}
    	else
    	{
			$notification = array(
            'message' => 'Ward Details Not Found !',
            'alert-type' => 'error'
        	);
    	return redirect()->back()->with($notification);

    	}


    }
}
