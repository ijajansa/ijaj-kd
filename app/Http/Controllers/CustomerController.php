<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bar;
use App\Models\User;
use App\Models\Ward;
use App\Models\Report;
use App\Models\Customer;
use App\Models\HajeriShed;


use Illuminate\Support\Str;
use App\Models\UserCategory;
use App\Models\WasteRequest;
use Illuminate\Http\Request;
use App\Models\WasteCategory;
use App\Models\WasteRequestItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        $user = Customer::where(function($q) use($email){
            $q->where('email', '=', $email)->orWhere('mobile_number', '=', $email);
        })->where('category_id',$request->category_id)->first();
        if (!$user) {
            return response()->json(['success'=>false, 'message' => 'User not found']);
        }
        if (!Hash::check($password, $user->password)) {
            return response()->json(['success'=>false, 'message' => 'Invalid password']);
        }
        return response()->json(['success'=>true,'message'=>'success', 'user' => $user]);

    }

    public function customerRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'contact_number' => 'required|unique:users,contact_number',
            'password' => 'required',
            'ward' => 'required',
            'area' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }
        $data = $request->all();
        $data['role_id'] =3;
        $data['password'] =Hash::make($request->password);
        $fillable = ['name', 'email', 'password', 'contact_number','password','area','ward','address','role_id'];
        $user = new User();
        $user->fillable($fillable);
        $user->fill($data);
        $user->save();
        return response()->json(['success'=>true,'message'=>'Customer registered successfully', 'user' => $user]);

    }

    public function customerLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'type' => 'required|in:1,2',
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }
        $email = $request->input('email');
        $password = $request->input('password');
        if($request->type==1)
        {
            $user = Customer::where(function($q) use($email){
            $q->where('email', '=', $email)->orWhere('mobile_number', '=', $email);
            })->where('category_id',$request->category_id)->where('is_active',1)->first();

        }
        else
        {       
            $user = User::where(function($q) use($email){
            $q->where('email', '=', $email)->orWhere('contact_number', '=', $email);
            })->where('role_id',3)->where('is_active',1)->first();
        }
        if (!$user) {
            return response()->json(['success'=>false, 'message' => 'Customer not found']);
        }
        if (!Hash::check($password, $user->password)) {
            return response()->json(['success'=>false, 'message' => 'Invalid password']);
        }
        return response()->json(['success'=>true,'message'=>'success', 'user' => $user]);
    }

    public function sendRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'type' => 'required|in:1,2',
            'ward' => 'required',
            'area' => 'required',
            'address' => 'required',
            'items' => 'required|array'
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }

        $data = new WasteRequest();
        $data->customer_id= $request->customer_id;
        $data->category_id= $request->type;
        $data->area= $request->area;
        $data->ward= $request->ward;
        $data->address= $request->address;
        $data->uuid = Str::uuid();
        $data->save();
        if(count($request->items))
        {
            foreach($request->items as $record)
            {
                $item = new WasteRequestItem();
                $item->request_id = $data->id;
                $item->category_id = $record['waste_category_id'];
                $item->name = WasteCategory::where('id',$record['waste_category_id'])->first()->name ?? null;
                $item->uuid = Str::uuid();
                $item->qty = $record['qty'];
                $item->customer_id = $request->customer_id;
                $item->save();
            }

        return response()->json(['success'=>true,'message'=>'success', 'waste_request' => $data]);

        }
        return response()->json(['success'=>false,'message'=>'something went wrong']);

    }

    public function allRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }
        $data = WasteRequest::where('customer_id',$request->customer_id)->with('request_items')->get();
        return response()->json(['success'=>true,'message'=>'success', 'waste_request_list' => $data]);
    }

    public function getWasteCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:1,2'
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }
        $categories = WasteCategory::where('type',$request->type)->where('is_active',1)->get();
        return response()->json(['success'=>true,'message'=>'success', 'categories' => $categories]);
    }
    public function requestDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'request_id' => 'required',
            'customer_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }
        $data = WasteRequest::where('customer_id',$request->customer_id)->where('id',$request->request_id)->with('request_items')->first();
        return response()->json(['success'=>true,'message'=>'success', 'waste_request_details' => $data]);
    }

    public function addCustomerPage()
    {
        $users = User::where('users.is_active',1)->where('users.role_id',2)->join('categories','categories.id','users.category_id')->orderBy('users.name','ASC')->select('users.*','categories.name as category_name')->get();
        $wards=Ward::where('is_active',1)->get();
        return view('customer.add',compact('users'))->with('wards',$wards);
    }

    public function addCustomerData(Request $request)
    {
        $category = User::where('id',$request->user_id)->first();

        $check_email=Customer::where('email',$request->email)->where('email','!=',null)->where('category_id',$category->category_id)->where('user_id',$request->user_id)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->where('category_id',$category->category_id)->where('user_id',$request->user_id)->first();
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
        $data->user_id=$request->user_id;
        // $data->shed_id=implode(',',$request->shed_id);
        $data->category_id=$category->category_id ?? 0;
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
        $user=Customer::orderBy('customers.id','DESC');
        if(auth()->user()->role_id!=1)
        $user = $user->where('user_id',auth()->user()->id);

        $user = $user->where('customers.role_id',1)->join('categories','categories.id','customers.category_id')->select('customers.*','categories.name as category_name')->get();
        return view('customer.all')->with('user',$user);
    }

    public function editCustomerPage($id)
    {
        $data=Customer::find($id);
        $users = User::where('users.is_active',1)->where('users.role_id',2)->join('categories','categories.id','users.category_id')->orderBy('users.name','ASC')->select('users.*','categories.name as category_name')->get();
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
        return view('customer.edit')->with(['data'=>$data,'wards'=>$wards,'areas'=>$areas,'users'=>$users]);
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
        $category = User::where('id',$request->user_id)->first();
        $check_email=Customer::where('email',$request->email)->where('id','!=',$request->id)->where('email','!=',null)->where('category_id',$category->category_id)->where('user_id',$request->user_id)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->where('id','!=',$request->id)->where('category_id',$category->category_id)->where('user_id',$request->user_id)->first();
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
        $data->user_id=$request->user_id;
        $data->category_id=$category->category_id ?? 0;
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

public function getInspectors(Request $request)
{
    $html="";
        $html.='<option value="">Select Inspector</option>';
        $datas=Customer::where('user_id',$request->id)->where('role_id',1)->where('is_active',1)->get();
        if($datas)
        {
            foreach ($datas as $key => $data) {
                $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
            }
        }
        return $html;
}

public function addEmployeeData(Request $request)
    {
        $category = User::where('id',$request->user_id)->first();
        $check_email=Customer::where('email',$request->email)->where('email','!=',null)->where('category_id',$category->category_id)->where('user_id',$request->user_id)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->where('category_id',$category->category_id)->where('user_id',$request->user_id)->first();
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
        $data->user_id=$request->user_id;
        $data->category_id=$category->category_id ?? 0;
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
        $inspectors=Customer::where('role_id',1);
        if(auth()->user()->role_id!=1)
        $inspectors=$inspectors->where('user_id',auth()->user()->id);
        $inspectors=$inspectors->where('is_active',1)->get();

        $users = User::where('users.is_active',1)->where('users.role_id',2)->join('categories','categories.id','users.category_id')->orderBy('users.name','ASC')->select('users.*','categories.name as category_name')->get();

        return view('employee.add',compact('users'))->with('inspectors',$inspectors);
    }

    public function allEmployeeData(Request $request)
    {
        $user=Customer::orderBy('id','DESC');
        if(auth()->user()->role_id!=1)
        $user = $user->where('user_id',auth()->user()->id);
        $user = $user->where('role_id',2);
        if($request->inspector_id!=null)
        $user->where('inspector_id',$request->inspector_id);
        $user = $user->get();

        $inspectors=Customer::where('role_id',1);
        if(auth()->user()->role_id!=1)
        $inspectors=$inspectors->where('user_id',auth()->user()->id);
        $inspectors=$inspectors->where('is_active',1)->get();

        $users = User::where('users.is_active',1)->where('users.role_id',2)->join('categories','categories.id','users.category_id')->orderBy('users.name','ASC')->select('users.*','categories.name as category_name')->get();


        return view('employee.all',compact('inspectors','users'))->with('user',$user);
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
        $users = User::where('users.is_active',1)->where('users.role_id',2)->join('categories','categories.id','users.category_id')->orderBy('users.name','ASC')->select('users.*','categories.name as category_name')->get();
        $inspectors=Customer::where('role_id',1)->where('is_active',1)->get();
        return view('employee.edit',compact('users'))->with(['data'=>$data,'inspectors'=>$inspectors]);
    }

    public function updateEmployeeData(Request $request)
    {
        $category = User::where('id',$request->user_id)->first();
        $check_email=Customer::where('email',$request->email)->where('id','!=',$request->id)->where('email','!=',null)->where('category_id',$category->category_id)->where('user_id',$request->user_id)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->where('id','!=',$request->id)->where('category_id',$category->category_id)->where('user_id',$request->user_id)->first();
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
        $data->user_id=$request->user_id;
        $data->category_id=$category->category_id ?? 0;
        $data->save();
        $notification = array(
            'message' => 'Employee Details Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect('employee/all')->with($notification);
    }

}
