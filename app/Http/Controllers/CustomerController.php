<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bar;
use App\Models\User;
use App\Models\Ward;
use App\Models\Report;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Recycle;


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
        $data['barcode_count'] =Bar::where('is_delete',0)->count();
        $data['todays_report'] =Report::whereDate('created_at',date('Y-m-d'))->count();
        $data['month_report'] =Report::whereMonth('created_at',date('m'))->count();
        
        //CD Waste
        $data['total_cd_collection'] = 0;
        
        $records = WasteRequest::leftJoin('categories','categories.id','waste_requests.category_id')
        ->where('categories.type',2)
        ->where('categories.id',10)
        ->where('waste_requests.status',4)->select('waste_requests.*','categories.name as category_name')->withSum('request_cd_items','actual_qty')->get();
        foreach($records as $record)
        {
            $data['total_cd_collection'] += $record->request_cd_items_sum_actual_qty;
        }
        
        $data['total_cd_processed'] = Recycle::where('type',1)->sum('weight');
        
        //E-Waste
        $data['total_e_collection'] = 0;
        
        $records = WasteRequest::leftJoin('categories','categories.id','waste_requests.category_id')
        ->where('categories.type',2)
        ->where('categories.id',11)
        ->where('waste_requests.status',4)->select('waste_requests.*','categories.name as category_name')->withSum('request_e_items','actual_qty')->get();
        foreach($records as $record)
        {
            $data['total_e_collection'] += $record->request_e_items_sum_actual_qty;
        }
        
        $data['total_e_processed'] = Recycle::where('type',2)->sum('weight');

        return view('home',compact('data'));
    }

    public function postLogin(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');

        $user = Customer::where(function($q) use($email){
            $q->where('email', '=', $email)->orWhere('mobile_number', '=', $email);
        })
        // ->where('category_id',$request->category_id)
        ->first();
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
            'device_token' => 'required'
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
            })
            // ->where('category_id',$request->category_id)
            ->where('is_active',1)->first();

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
        if($user)
        {
            $user->device_token = $request->device_token;
            $user->save();
        }
        return response()->json(['success'=>true,'message'=>'success', 'user' => $user]);
    }
    public function uploadRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'request_id' => 'required',
            'employee_image' => 'required',
            'employee_remark' => 'nullable',
            'request_items.*.waste_category_id' => 'required',
            'request_items.*.actual_qty' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }

        $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->employee_image));
        $filename = 'wastes/'.uniqid() . '.png';
        file_put_contents(storage_path('app/' . $filename), $image_data);

        $data = WasteRequest::find($request->request_id);
        $data->employee_image= $filename;
        $data->employee_remark= $request->employee_remark ?? null;
        $data->status= 4;
        $data->save();
        if($data)
        {
            if(count($request->request_items))
            {
                foreach($request->request_items as $record)
                {
                    $item = WasteRequestItem::find($record['waste_category_id']);
                    $item->actual_qty = $record['actual_qty'];
                    $item->save();
                }

                return response()->json(['success'=>true,'message'=>'success', 'waste_request' => $data]);
            }
        }
        return response()->json(['success'=>false,'message'=>'something went wrong']);
    }

    public function sendRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'device_token' => 'required',
            'ward' => 'required',
            'area' => 'required',
            'name' => 'required',
            'email' => 'nullable',
            'contact_number' => 'required',
            'address' => 'required',
            'image' => 'nullable',
            'request_items' => 'required|array'
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }
        if($request->image!=null)
        {
            $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
            $filename = 'wastes/'.uniqid() . '.png';
            file_put_contents(storage_path('app/' . $filename), $image_data);     
        // $filename = $request->file('image')->store('wastes');
        }


        $user = User::where('contact_number',$request->contact_number)->first();
        if($user!=null)
        {
            $user->device_token = $request->device_token;
        }
        else
        {
            $user= new User();
            $user->role_id = 3;
            $user->contact_number = $request->contact_number;
            $user->device_token = $request->device_token;
            $user->password = Hash::make("#$%ERTYU");
            $user->name = "Demo";
        }
        $user->save();

        $data = new WasteRequest();
        $data->category_id= $request->type;
        $data->area= $request->area;
        $data->ward= $request->ward;
        $data->name= $request->name;
        $data->email= $request->email;
        $data->contact_number= $request->contact_number;
        $data->address= $request->address;
        $data->image= $filename ?? null;
        $data->uuid = Str::uuid();
        $data->save();
        if(count($request->request_items))
        {
            foreach($request->request_items as $record)
            {
                $item = new WasteRequestItem();
                $item->request_id = $data->id;
                $item->category_id = $record['waste_category_id'];
                $item->name = WasteCategory::where('id',$record['waste_category_id'])->first()->name ?? null;
                $item->uuid = Str::uuid();
                $item->qty = $record['qty'];
                $item->save();
            }

        return response()->json(['success'=>true,'message'=>'Request raised successfully', 'waste_request' => $data]);

        }
        return response()->json(['success'=>false,'message'=>'something went wrong']);

    }

    public function allRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'customer_id' => 'required_if:type,2',
            'employee_id' => 'required_if:type,1',
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }
        $data = WasteRequest::leftJoin('users','users.id','waste_requests.customer_id')
        ->leftJoin('customers','customers.id','waste_requests.employee_id')
        ->leftJoin('categories','categories.id','waste_requests.category_id')
        ->with('request_items');
        if($request->type==2)
        $data = $data->where('waste_requests.customer_id',$request->customer_id);
        else if($request->type==1)
        $data = $data->where('waste_requests.employee_id',$request->employee_id);
        
        $data = $data->select('waste_requests.*','users.name as customer_name','customers.name as employee_name','categories.name as category_name')->get()->map(function($data){
            if($data->status==1)
            $data['status'] = 'New';
            else if($data->status==2)
            $data['status'] = 'Employee Assigned';
            else if($data->status==3)
            $data['status'] = 'Processing';
            else if($data->status==4)
            $data['status'] = 'Completed';
            else if($data->status==5)
            $data['status'] = 'Rejected';
            return $data;
        });
        return response()->json(['success'=>true,'message'=>'success', 'waste_request_list' => $data]);
    }

    public function getCustomerCategories(Request $request)
    {
        $categories = Category::where('is_active',1)->orderBy('name','ASC')->where('type',2)->get();
        if($categories)
        {
            return response()->json(['success'=>true,'message'=>'Found', 'categories' => $categories]);
        }
        else
        {
            return response()->json(['success'=>false,'message'=>'Not Found']);
        }
    }

    public function getWasteCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }
        $categories = WasteCategory::where('type',$request->category_id)->where('is_active',1)->get();
        return response()->json(['success'=>true,'message'=>'success', 'categories' => $categories]);
    }
    public function requestDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'request_id' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'message'=>$validator->errors()->first()],200);
        }
        $data = WasteRequest::where('waste_requests.id',$request->request_id)
        ->leftJoin('categories','categories.id','waste_requests.category_id')
        ->with('request_items')
        ->select('waste_requests.*','categories.name as category_name')
        ->first();
        if($data)
        {
            if($data->status==1)
            $data['status'] = 'New';
            else if($data->status==2)
            $data['status'] = 'Employee Assigned';
            else if($data->status==3)
            $data['status'] = 'Processing';
            else if($data->status==4)
            $data['status'] = 'Completed';
            else if($data->status==5)
            $data['status'] = 'Rejected';
        }
        return response()->json(['success'=>true,'message'=>'success', 'waste_request_details' => $data]);
    }

    public function addCustomerPage()
    {
        $user = User::where('is_active',1)->where('role_id',2)->orderBy('name','ASC')->get();
        $wards=Ward::where('is_active',1)->get();
        $categories = Category::where('is_active',1)->get();
        return view('customer.add',compact('user','categories'))->with('wards',$wards);
    }

    public function addCustomerData(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'designation'=>'required',
            'email'=>'required|unique:customers,email',
            'contact_number'=>'required|unique:customers,mobile_number|numeric|digits:10',
            'category_id'=>'required',
            'password'=>'required|min:8',
        ],[
            'category_id.required' => 'The category field is required.'
        ]);
        $category = User::where('id',$request->user_id)->first();

        // $check_email=Customer::where('email',$request->email)->where('email','!=',null)->where('user_id',$request->user_id)->first();
        // if($check_email)
        // {
        //     $notification = array(
        //     'message' => 'Email ID Already Taken !',
        //     'alert-type' => 'error'
        // );
        // return redirect()->back()->with($notification);

        // }
        // $check_mobile=Customer::where('mobile_number',$request->mobile_number)->where('user_id',$request->user_id)->first();
        // if($check_mobile)
        // {
        //     $notification = array(
        //     'message' => 'Mobile Number Already Taken !',
        //     'alert-type' => 'error'
        // );
        // return redirect()->back()->with($notification);
        // }
        $data=new Customer();
        $data->name=$request->name;
        $data->email=$request->email ?? null;
        $data->mobile_number=$request->contact_number;
        $data->address=$request->address;
        $data->designation = $request->designation ?? null;
        $data->category_id = implode(',',$request->category_id) ?? null;
        // $data->ward_id=implode(',',$request->ward_id);
        $data->user_id=$request->user_id;
        // $data->area_id=implode(',',$request->area_id);
        $data->password=Hash::make($request->password);
        $data->save();
        $notification = array(
            'message' => 'HOD Registered Successfully !',
            'alert-type' => 'success'
        );
        return redirect('user/all')->with($notification);
    }

    public function allCustomerData(Request $request)
    {
        $user=Customer::orderBy('customers.id','DESC');

        $user = $user->where('customers.role_id',1)->join('categories','categories.id','customers.category_id')->select('customers.*','categories.name as category_name')->get();
        return view('customer.all')->with('user',$user);
    }

    public function editCustomerPage($id)
    {
        $categories = Category::where('is_active',1)->get();
        $user=Customer::find($id);
        if($user){
            $cat = explode(',',$user->category_id);
            if($cat!=null)
            {
                foreach($categories as $category)
                {
                    $category['is_present'] = 0;
                    foreach($cat as $id)
                    {
                        if($category->id==$id)
                        {
                            $category['is_present'] = 1;        
                        }
                    }
                }
            }
            
        }
        return view('customer.edit',compact('user','categories'));
        // $users = User::where('users.is_active',1)->where('users.role_id',2)->join('categories','categories.id','users.category_id')->orderBy('users.name','ASC')->select('users.*','categories.name as category_name')->get();
        // $wards=Ward::where('is_active',1)->where('user_id',$data->user_id)->get();
        // foreach ($wards as $key => $value) {
        //     $value['is_present']=0;
        //     if($data->ward_id!=null)
        //     {
        //         $hajeri=explode(',',$data->ward_id);
        //         foreach ($hajeri as $key1 => $value1) {
        //             if($value1==$value->id)
        //             {
        //                 $value['is_present']=1;
        //             }            
        //         }                
        //     }
        // }

        // $areas=Bar::where('ward_id',$data->ward_id)->get();
        // foreach ($areas as $key => $area) {
        //     $area['is_present']=0;
        //     if($data->area_id!=null)
        //     {
        //         $area_ids=explode(',',$data->area_id);
        //         foreach ($area_ids as $key1=> $value1) {
        //             if($value1==$area->id)
        //             {
        //                 $area['is_present']=1;
        //             }            
        //         }                
        //     }
        // }
        // return view('customer.edit')->with(['data'=>$data,'wards'=>$wards,'areas'=>$areas,'users'=>$users]);
    }
    public function deleteCustomerData($id)
    {
        if(auth()->user()->role_id!=1)
        {
            $notification = array(
            'message' => "Don't have permission to delete !",
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);    
        }
        
        $data=Customer::find($id);
        $data->delete();

        $notification = array(
            'message' => 'HOD Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function updateCustomerData(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'designation'=>'required',
            'email'=>'required|unique:customers,email,'.$id.'',
            'contact_number'=>'required|unique:customers,contact_number,'.$id.',|numeric|digits:10',
            'category_id'=>'required',
            'password'=>'nullable|min:8',
        ],[
            'category_id.required' => 'The category field is required.'
        ]);

        $data=Customer::find($request->id);
        $data->name=$request->name;
        $data->email=$request->email ?? null;
        $data->mobile_number=$request->contact_number;
        $data->address=$request->address;
        $data->is_active=$request->is_active;
        // $data->ward_id=implode(',', $request->ward_id);
        $data->user_id=$request->user_id;
        $data->category_id=implode(',',$request->category_id) ?? null;
        // $data->area_id=implode(',', $request->area_id);
        $data->save();
        $notification = array(
            'message' => 'HOD Details Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect('user/all')->with($notification);
    }

    public function getArea(Request $request)
    {
        $html="";
        $html.='<option value="">Select Area</option>';
        $datas=Bar::whereIn('ward_id',$request->ward_id)->where('is_delete',0)->get();
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
        $check_email=Customer::where('email',$request->email)->where('email','!=',null)->where('user_id',$request->user_id)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->where('user_id',$request->user_id)->first();
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
        $data->designation=$request->designation ?? null;
        $data->inspector_id=$request->inspector_id;
        $data->role_id=2;
        $data->mobile_number=$request->mobile_number;
        // $data->address=$request->address;
        $data->user_id=$request->user_id;
        $data->category_id=implode(',',$request->category_id) ?? 0;
        $data->password=Hash::make($request->password);
        $data->save();
        $notification = array(
            'message' => 'Supervisor Added Successfully !',
            'alert-type' => 'success'
        );
        return redirect('employee/all')->with($notification);
    }


    public function addEmployeePage()
    {
        $inspectors=Customer::where('role_id',1);
        $inspectors=$inspectors->where('is_active',1)->get();
        $categories = Category::where('is_active',1)->get();

        return view('employee.add',compact('categories'))->with('inspectors',$inspectors);
    }

    public function allEmployeeData(Request $request)
    {
        $user=Customer::orderBy('id','DESC');

        $user = $user->where('role_id',2);
        if($request->inspector_id!=null)
        $user->where('inspector_id',$request->inspector_id);
        $user = $user->get();

        $inspectors=Customer::where('role_id',1);
        $inspectors=$inspectors->where('is_active',1)->get();

        $users = User::where('users.is_active',1)->where('users.role_id',2)->join('categories','categories.id','users.category_id')->orderBy('users.name','ASC')->select('users.*','categories.name as category_name')->get();


        return view('employee.all',compact('inspectors','users'))->with('user',$user);
    }

    public function deleteEmployeeData($id)
    {
        if(auth()->user()->role_id!=1)
        {
            $notification = array(
            'message' => "Don't have permission to delete !",
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
        
        }
        $data=Customer::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Supervisor Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function editEmployeePage($id)
    {
        $categories = Category::where('is_active',1)->get();
        $user=Customer::find($id);
        if($user){
            $cat = explode(',',$user->category_id);
            if($cat!=null)
            {
                foreach($categories as $category)
                {
                    $category['is_present'] = 0;
                    foreach($cat as $id)
                    {
                        if($category->id==$id)
                        {
                            $category['is_present'] = 1;        
                        }
                    }
                }
            }
            
        }
        $inspectors=Customer::where('role_id',1)->where('is_active',1)->get();
        return view('employee.edit',compact('user','categories','inspectors'));
    }

    public function updateEmployeeData(Request $request)
    {
        $category = User::where('id',$request->user_id)->first();
        $check_email=Customer::where('email',$request->email)->where('id','!=',$request->id)->where('email','!=',null)->where('user_id',$request->user_id)->first();
        if($check_email)
        {
            $notification = array(
            'message' => 'Email ID Already Taken !',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

        }
        $check_mobile=Customer::where('mobile_number',$request->mobile_number)->where('id','!=',$request->id)->where('user_id',$request->user_id)->first();
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
        $data->designation=$request->designation;
        $data->mobile_number=$request->mobile_number;
        $data->address=$request->address;
        $data->is_active=$request->status;
        $data->inspector_id=$request->inspector_id;
        // $data->user_id=$request->user_id;
        $data->category_id=implode(',',$request->category_id) ?? 0;
        $data->save();
        $notification = array(
            'message' => 'Supervisor Details Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect('employee/all')->with($notification);
    }

}
