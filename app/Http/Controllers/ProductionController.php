<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Machine;
use App\Models\Material;
use App\Models\MaterialDetail;
use App\Models\User;
use App\Models\Check;
use App\Models\ProductType;
use App\Models\ProductionDetail;
use App\Models\Production;
use Auth;
class ProductionController extends Controller
{
    public function getSearchEmployee(Request $request)
    {
        $data=User::where('name','like', '%' .$request->name. '%')->where('role_id',3)->get();            
        return $data;
    }
    public function allOrderData(){
        $order=Order::orderBy('order_id','DESC')->where('order_status',1)->where('product_type',1)->get();
        return view('production.all')->with('order',$order);
    }

    public function allProductionOrderData()
    {
        $production=ProductionDetail::with('order')->with('machine')->orderBy('production_id','DESC')->get();
        return view('production.all-data')->with('production',$production);   
    }
    public function editProductionPage($id)
    {
        $machine=Machine::all();
        $employee=User::where('role_id',3)->orderBy('name','ASC')->get();
        $order=Order::with('type')->where('order_id',$id)->first();
        $count=ProductionDetail::count();
        $product_type=ProductType::get();
        $material=Material::get();
        $material_details=MaterialDetail::where('material_id',$order->material)->get();
        return view('production.edit')->with('order',$order)->with('product_type',$product_type)->with('machine',$machine)->with('employee',$employee)->with('count',$count)->with('material',$material)->with('material_details',$material_details);
    }

    public function editProductionData(Request $request)
    {
        $production=new ProductionDetail();
        $production->machine_id=$request->machine_id;
        $production->customer_id=$request->id;
        $production->operator_name=$request->operator_name;
        $production->job_card=$request->job_card;
        $production->save();
        $order=Order::where('order_id',$request->id)->first();
        $order->order_status=2;
        $order->save();
        $data=new Production();
        $data->production_id=$production->production_id;
        $data->customer_id=$request->id;
        $data->operator_name=$request->operator_name;
        $data->save();
        return redirect('production/all-data');
        
    }

    public function viewProductionDetailPage($id)
    {
        
        $production=ProductionDetail::where('production_id',$id)->with('order')->with('machine')->first();
        // dd($production);
        return view('production.view')->with('production',$production);
    }

    public function allProductionData($id)
    {
        $detail=ProductionDetail::where('production_id',$id)->with('order')->with('machine')->first();
        $data=Production::where('production_id',$id)->orderBy('id','ASC')->get();
        $user=User::where('role_id',3)->orderBy('name','ASC')->get();
        return view('production-details.all')->with('data',$data)->with('detail',$detail)->with('user',$user);
    }

    public function addProductionData(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $data=ProductionDetail::where('production_id',$request->production_id)->first();

        $final_rolls=Order::where('order_id',$data->customer_id)->first();
        $production=Production::where('production_id',$request->production_id)->get()->last();
        if($data)
        {
        $pro=new Production();
        $pro->production_id=$data->production_id;
        $pro->customer_id=$data->customer_id;
        $pro->check_roll=$request->check_roll;
        $pro->ok_roll=$request->ok_roll;
        $pro->final_roll=$request->ok_roll;
        $pro->total_roll=$production->total_roll+$request->ok_roll+$request->check_roll;
        $pro->operator_name=$request->operator_name;
        $pro->created_at=date('Y-m-d H:i:s');
        $pro->save();

        if($final_rolls->rolls==$pro->total_roll)
        {
            $data->production_roll=$pro->total_roll;
            $data->save();
        }
        else if($pro->total_roll>$final_rolls->rolls)
        {
            $data->production_roll=$final_rolls->rolls;
            $data->stock_roll=$pro->total_roll-$final_rolls->rolls;
            $data->save();
        }
        if($request->check_roll!=0)
        {
            $check=new Check();
            $check->production_id=$pro->id;
            $check->customer_id=$data->customer_id;
            $check->machine_id=$data->machine_id;
            $check->check_roll=$request->check_roll;
            $check->remaining_roll=$request->check_roll;
            $check->status=1;
            $check->check_time=date('Y-m-d H:i:s');
            $check->save();
        }
        }

        $token=User::where('role_id',4)->where('push_token','!=',Null)->get();
        foreach($token as $dataa)
        {
            $this->sendNotification($dataa,$request,$data);
        }
        // dd($list);
        // $request->push_token;
        
        return redirect()->back();
    }


}
