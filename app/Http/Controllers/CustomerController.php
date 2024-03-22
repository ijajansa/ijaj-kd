<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bar;
use App\Models\Report;
use App\Models\Ward;
use App\Models\HajeriShed;
use Carbon\Carbon;


use Hash;
class CustomerController extends Controller
{

    public function getDashboard()
    {
        date_default_timezone_set('Asia/Kolkata');
        $barcode=Bar::count();
        $todays_report=Report::whereDate('created_at',date('Y-m-d'))->count();
        $month_report=Report::whereMonth('created_at',date('m'))->count();
        $year_report=Report::whereYear('created_at',date('Y'))->count();

        $week_report = Report::select('*')
                        ->whereBetween('created_at', 
                            [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
                        )
                        ->count();

        return view('home')->with('barcode',$barcode)->with('todays_report',$todays_report)->with('month_report',$month_report)->with('year_report',$year_report)->with('week_report',$week_report);
    }

    public function postLogin(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');

        $user = Customer::where('email', '=', $email)->orWhere('mobile_number', '=', $email)->first();
        if (!$user) {
            return response()->json(['success'=>false, 'message' => 'Invalid Email Address']);
        }
        if (!Hash::check($password, $user->password)) {
            return response()->json(['success'=>false, 'message' => 'Invalid Password']);
        }
        return response()->json(['success'=>true,'message'=>'success', 'user' => $user]);

    }

    public function addCustomerPage()
    {
        $wards=Ward::where('is_active',1)->get();
        return view('customer.add')->with('wards',$wards);
    }

    public function addCustomerData(Request $request)
    {
        $check_email=Customer::where('email',$request->email)->where('email','!=',null)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->first();
        if($check_mobile)
        {
            $notification = array(
            'message' => 'Mobile Number Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
        }

        $data=new Customer();
        $data->name=$request->name;
        $data->email=$request->email ?? null;
        $data->mobile_number=$request->mobile_number;
        $data->address=$request->address;
        $data->ward_id=$request->ward_id;
        // $data->shed_id=implode(',',$request->shed_id);
        $data->area_id=implode(',',$request->area_id);
        $data->password=Hash::make($request->password);
        $data->save();
        $notification = array(
            'message' => 'User Registered Successfully !',
            'alert-type' => 'success'
        );
        return redirect('user/all')->with($notification);
    }

    public function allCustomerData(Request $request)
    {
        $user=Customer::orderBy('id','DESC')->where('role_id',1)->get();
        return view('customer.all')->with('user',$user);
    }

    public function editCustomerPage($id)
    {
        $data=Customer::find($id);
        $wards=Ward::where('is_active',1)->get();
        // $sheds=HajeriShed::where('ward_id',$data->ward_id)->get();
        // foreach ($sheds as $key => $value) {
        //     $value['is_present']=0;
        //     if($data->shed_id!=null)
        //     {
        //         $hajeri=explode(',',$data->shed_id);
        //         foreach ($hajeri as $key1 => $value1) {
        //             if($value1==$value->id)
        //             {
        //                 $value['is_present']=1;
        //             }            
        //         }                
        //     }
        // }

        $areas=Bar::where('ward_id',$data->ward_id)->get();
        foreach ($areas as $key => $area) {
            $area['is_present']=0;
            if($data->area_id!=null)
            {
                $area_ids=explode(',',$data->area_id);
                foreach ($area_ids as $key1=> $value1) {
                    if($value1==$area->id)
                    {
                        $area['is_present']=1;
                    }            
                }                
            }
        }
        return view('customer.edit')->with(['data'=>$data,'wards'=>$wards,'areas'=>$areas]);
    }
    public function deleteCustomerData($id)
    {
        $data=Customer::find($id);
        $data->delete();

        $notification = array(
            'message' => 'User Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function updateCustomerData(Request $request)
    {
        $check_email=Customer::where('email',$request->email)->where('id','!=',$request->id)->where('email','!=',null)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->where('id','!=',$request->id)->first();
        if($check_mobile)
        {
            $notification = array(
            'message' => 'Mobile Number Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
        }
        $data=Customer::find($request->id);
        $data->name=$request->name;
        $data->email=$request->email ?? null;
        $data->mobile_number=$request->mobile_number;
        $data->address=$request->address;
        $data->is_active=$request->status;
        $data->ward_id=$request->ward_id;
        // $data->shed_id=implode(',', $request->shed_id);
        $data->area_id=implode(',', $request->area_id);
        $data->save();
        $notification = array(
            'message' => 'User Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect('user/all')->with($notification);
    }

    public function getArea(Request $request)
    {
        $html="";
        $html.='<option value="">Select Area</option>';
        $datas=Bar::where('ward_id',$request->ward_id)->get();
        if($datas)
        {
            foreach ($datas as $key => $data) {
                $html.='<option value="'.$data->id.'">'.$data->address.'</option>';
            }
        }
        return $html;
    }
 





// ALL EMPLOYEE DETAILS

public function addEmployeeData(Request $request)
    {
        $check_email=Customer::where('email',$request->email)->where('email','!=',null)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->first();
        if($check_mobile)
        {
            $notification = array(
            'message' => 'Mobile Number Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
        }

        $data=new Customer();
        $data->name=$request->name;
        $data->email=$request->email ?? null;
        $data->inspector_id=$request->inspector_id;
        $data->role_id=2;
        $data->mobile_number=$request->mobile_number;
        $data->address=$request->address;
        // $data->ward_id=$request->ward_id;
        // $data->shed_id=implode(',',$request->shed_id);
        // $data->area_id=implode(',',$request->area_id);
        $data->password=Hash::make($request->password);
        $data->save();
        $notification = array(
            'message' => 'Employee Added Successfully !',
            'alert-type' => 'success'
        );
        return redirect('employee/all')->with($notification);
    }


    public function addEmployeePage()
    {
        $inspectors=Customer::where('role_id',1)->where('is_active',1)->get();
        return view('employee.add')->with('inspectors',$inspectors);
    }

    public function allEmployeeData(Request $request)
    {
        $user=Customer::orderBy('id','DESC')->where('role_id',2)->get();
        return view('employee.all')->with('user',$user);
    }

    public function deleteEmployeeData($id)
    {
        $data=Customer::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Employee Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function editEmployeePage($id)
    {
        $data=Customer::find($id);
        $inspectors=Customer::where('role_id',1)->where('is_active',1)->get();
        return view('employee.edit')->with(['data'=>$data,'inspectors'=>$inspectors]);
    }

    public function updateEmployeeData(Request $request)
    {
        $check_email=Customer::where('email',$request->email)->where('id','!=',$request->id)->where('email','!=',null)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->where('id','!=',$request->id)->first();
        if($check_mobile)
        {
            $notification = array(
            'message' => 'Mobile Number Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
        }


        $data=Customer::find($request->id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->mobile_number=$request->mobile_number;
        $data->address=$request->address;
        $data->is_active=$request->status;
        $data->inspector_id=$request->inspector_id;
        $data->save();
        $notification = array(
            'message' => 'Employee Details Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect('employee/all')->with($notification);
    }

}
