<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Hash;
use Auth;
class PublicController extends Controller
{
    public function addTokenData(Request $request)
    {
            $data=User::where('id',Auth::user()->id)->first();
            if($data->push_token!=$request->token)
            {
                $data->push_token=$request->token;
                $data->save();
                return 1;
            }
    }
    public function allEmployeeData()
    {
        $user=User::where('role_id','!=',1)->with('role')->get();
        return view('employee.all')->with('user',$user);
    }
    public function addEmployeePage()
    {
        $role=Role::orderBy('name','ASC')->get();
        return view('employee.add')->with('role',$role);
    }
    public function addEmployeeData(Request $request)
    {
        if($request->password==$request->password1)
        {

        $user=User::where('mobile_number',$request->mobile)->exists();
        if(!$user)
        {
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->mobile_number=$request->mobile;
            $user->password=Hash::make($request->password);    
            $user->role_id=$request->role_id;
            $user->user_type=$request->select_type;
            $user->save();
        }
        
        $notification = array(
            'message' => 'Employee Details Added Successfully !',
            'alert-type' => 'success'
        );
        return redirect('employee/all')->with($notification);     
        }
        else
        {
        $notification = array(
            'message' => 'Employee Details Already Exists !',
            'alert-type' => 'error'
        );
        return redirect('employee/all')->with($notification);
        }
    }

    public function deleteEmployeeData($id)
    {
        $user=User::find($id);
        $user->delete();
        $notification = array(
            'message' => 'Employee Details Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect('employee/all')->with($notification); 
    }

    public function editEmployeePage($id)
    {
        $user=User::with('role')->find($id);
        $role=Role::where('role_id','!=',$user->role_id)->get();
        return view('employee.edit')->with('user',$user)->with('role',$role);
    }

    public function editEmployeeData(Request $request)
    {

        $user=User::find($request->id);
        $user->name=$request->name;
        if($request->select_type==0)
        {
            $user->email=Null;    
        }
        else
        {
            $user->email=$request->email;
        }
        
        $user->mobile_number=$request->mobile;
        if(isset($request->password))
        {
            if($request->password==$request->password1)
            {
                $user->password=Hash::make($request->password);        
            }
            else
            {
                return redirect()->back();
            }
        }   
        $user->role_id=$request->role_id;
        $user->user_type=$request->select_type;
        $user->save();  
        $notification = array(
            'message' => 'Employee Details Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect('employee/all')->with($notification); 
    }
}
