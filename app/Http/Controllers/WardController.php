<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ward;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WardController extends Controller
{
    public function allWard()
    {
		$users = User::where('users.is_active',1)->where('users.role_id',2)->join('categories','categories.id','users.category_id')->orderBy('users.name','ASC')->select('users.*','categories.name as category_name')->get();
		$datas=Ward::orderBy('id','DESC')->get();
		
    	return view('ward.all',compact('users'))->with('datas',$datas);
    }

    public function addWardPage($id)
    {
    	$data=Ward::find($id);
		$users = User::where('users.is_active',1)->where('users.role_id',2)->join('categories','categories.id','users.category_id')->orderBy('users.name','ASC')->select('users.*','categories.name as category_name')->get();
    	return view('ward.add',compact('users'))->with('data',$data);
    }

    public function addWard(Request $request)
    {
    	$data=new Ward();
    	$data->name=$request->ward_name;
    	$data->ward_number=$request->ward_number;
    	$data->user_id=$request->user_id;
    	$data->save();

		$notification = array(
            'message' => 'Ward Added Successfully !',
            'alert-type' => 'success'
        );

    	return redirect()->back()->with($notification);
    }

    public function deleteWard($id)
    {
        if(auth()->user()->role_id==1)
        {
            $data=Ward::find($id)->delete();
        	$notification = array(
                'message' => 'Ward Deleted Successfully !',
                'alert-type' => 'success'
            );    
        }
        else
        $notification = array(
                'message' => "Don't have permission to delete !",
                'alert-type' => 'error'
            );    
    	

    	return redirect()->back()->with($notification);

    }

    public function updateWardData(Request $request)
    {
    	$data=Ward::find($request->id);
    	if($data)
    	{
    		$data->name=$request->name;
    		$data->user_id=$request->user_id;
    		$data->ward_number=$request->ward_number;
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
