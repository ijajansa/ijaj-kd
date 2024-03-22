<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Machine;
use App\Models\User;
use App\Models\ProductType;
use App\Models\ProductionDetail;
use App\Models\CheckingDetail;
use App\Models\Production;
use App\Models\Check;
use Auth;
class CheckController extends Controller
{
    public function markAsCheck($id,Request $request)
    {
        $data=Check::where('id',$id)->first();
        $data->status=3;
        $data->save();

        $token=User::where('role_id',5)->where('push_token','!=',Null)->get();
        foreach($token as $dataa)
        {
            $this->sendNotification($dataa,$data);
        }

        return redirect()->back();
    }

    public function sendNotification($token,$data)
    {
        $url ="https://fcm.googleapis.com/fcm/send";
        $fields=array(
            "to"=>$token->push_token,
            "notification"=>array(
                "body"=>$data->check_roll." Rolls Done of ".$data->order->customer->customer_name,
                "title"=>"DSP Checking Department",
                "icon"=>"https://dsptechnologies.co.in/assets/title.png",
                "click_action"=>"http://localhost:84/backend/"
            )
        );

        $headers=array(
            'Authorization: key=AAAAhMqZQiw:APA91bEfIL_iV_MkBdpqEeekyl6T4e0WZPYN8gk-VbjRCJ3j6I_gpsAu3sJEWqBeWT9gTeQvEjvWjTesYvYdPsluceo5XPFx7EBhF13FEnaOWVucBAYUm6-XWINjtCBlUxr9Me6QXLW_',
            'Content-Type:application/json'
        );

        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
        $result=curl_exec($ch);
        // print_r($result);
        curl_close($ch);
    }
    public function getSearchEmployee(Request $request)
    {

        $data=User::where('name','like', '%' .$request->name. '%')->where('role_id',4)->get();            
        return $data;
    }

    public function allOrderData(){
        $order=Check::orderBy('id','DESC')->where('status',1)->with('order')->with('machine')->get();
        return view('checking.all')->with('order',$order);
    }

    public function acceptData(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $id=$request->checking_id;
        foreach ($id as $key => $value) {
            $data=Check::where('id',$value)->first();
            $data->status=2;
            $data->accepted_by=Auth::user()->id;
            $data->check_time=date('Y-m-d H:i:s');
            $data->save();

            $data1=new CheckingDetail();
            $data1->checking_id=$data->id;
            $data1->customer_id=$data->customer_id;
            $data1->check_roll=0;
            $data1->ok_roll=0;
            $data1->total_roll=0;
            $data1->operator_name=Auth::user()->id;
            $data1->check_date=date('Y-m-d H:i:s');
            $data1->save();
        }
    }

    public function allCheckOrderData()
    {
        $production=Check::with('order')->with('machine')->whereIn('status',[2,3])->orderBy('updated_at','DESC')->get();
        // dd($production);
        return view('checking.all-data')->with('production',$production);   
    }
    public function editProductionPage($id)
    {
        $machine=Machine::all();
        $order=Order::with('type')->where('order_id',$id)->first();
        $product_type=ProductType::where('id','!=',$order->product_type)->get();
        return view('checking.edit')->with('order',$order)->with('product_type',$product_type)->with('machine',$machine);
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
        return redirect('checking/all-data');
        
    }

    public function viewProductionDetailPage($id)
    {
        
        $production=ProductionDetail::where('production_id',$id)->with('order')->with('machine')->first();
        // dd($production);
        return view('checking.view')->with('production',$production);
    }

    public function allCheckingData($id)
    {
        $detail=Check::where('id',$id)->with('order')->with('machine')->first();
        $data=CheckingDetail::where('checking_id',$id)->orderBy('id','ASC')->get();
        // dd($data);
        return view('checking.view')->with('data',$data)->with('detail',$detail);
    }

    public function addCheckingData(Request $request)
    {
        $data=Check::where('id',$request->production_id)->first();
        $production=CheckingDetail::where('checking_id',$request->production_id)->get()->last();
        if($data)
        {
        $pro=new CheckingDetail();
        $pro->checking_id=$data->id;
        $pro->customer_id=$data->customer_id;
        $pro->check_roll=$request->check_roll;
        $pro->ok_roll=$request->ok_roll;
        if($production)
        {
        $pro->total_roll=$production->total_roll+$request->ok_roll;        
        }
        else
        {
        $pro->total_roll=0+$request->ok_roll;
        }
        $pro->operator_name=$request->operator_name;
        $pro->created_at=date('Y-m-d H:i:s');
        $pro->save();

        $data->remaining_roll=$data->remaining_roll-$request->ok_roll;
        $data->save();
        if($data->remaining_roll==0)
        {
            $data1=Check::where('id',$data->id)->first();
            $data1->status=3;
            $data1->save();

            $token=User::where('role_id',5)->where('push_token','!=',Null)->get();
            foreach($token as $dataa)
            {
                $this->sendNotification($dataa,$data1);
            }
        }
    }
        return redirect()->back();
    }

}
