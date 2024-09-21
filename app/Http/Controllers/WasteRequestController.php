<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\WasteRequest;
use Illuminate\Http\Request;
use App\Models\WasteRequestItem;

class WasteRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = WasteRequest::leftJoin('categories','categories.id','waste_requests.category_id')->where('waste_requests.status','!=',4)->select('waste_requests.*','categories.name as category_name')->get();
        return view('waste-requests.all',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data = WasteRequest::where('uuid',$uuid)->first();
        if($data)
        {
            $employees = Customer::get()->map(function($record) use ($data){
                $categories = explode(',',$record->category_id);
                if(in_array($data->category_id, $categories))
                {
                    return $record;
                }
            })->filter();
            $data['waste_items'] = WasteRequestItem::where('request_id',$data->id)->get();
        }
        return view('waste-requests.edit',compact('data','employees'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= WasteRequest::find($id);
        if($data)
        {
            $data->employee_id = $request->employee_id;
            $data->status = 2;
            $data->save();
        }

        $customer = User::where('contact_number',$data->contact_number)->first();
        if($customer && $customer->device_token!=null)
        {
            $msg = 'Employee assigned to your request, Soon they reach to your place for collection.';
            $this->sendNotification($customer->device_token,$msg);
        }
        $notification = array(
            'message' => 'Employee Assigned Successfully',
            'alert-type' => 'success'
        );
        return redirect('waste-requests')->with($notification);
    }

    public function sendNotification($token, $msg)
    {
        // dd($token);
        $url = "https://fcm.googleapis.com/fcm/send";

        $fields = array(
            "to" => $token,
            "notification" => array(
                "body" => $msg,
                "title" => "VITA MUNICIPAL COUNCIL, VITA",
                "icon" => "https://kdmc3.kdmcgvp.in/assets/images/vita-logo.png",
                "click_action" => ""
            )
        );

        $headers = array(
            'Authorization: key='.$_ENV['FCM_SERVER_KEY'],
            'Content-Type:application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
