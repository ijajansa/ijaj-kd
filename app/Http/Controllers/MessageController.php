<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Auth;
use Config;
class MessageController extends Controller
{
    public function allData()
    {
        $data=Message::orderBy('created_at','ASC')->get();
        return view('message.all')->with('messages',$data);
    }

    public function addData(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $new=new Message();
        $new->user_id=Auth::user()->id;
        $new->message=$request->name;
        $new->save();
        $token=User::where('id','!=',Auth::user()->id)->where('push_token','!=',Null)->where('is_enabled',1)->get();
        foreach($token as $dataa)
        {
            $this->sendNotification($dataa,$new,1);
        }
        return 1;
    }

    public function deleteData(Request $request)
    {
        if($request->ans==0)
        {
            $add=Message::find($request->id);
            $message="<i>This message was deleted</i>";
            $add->message=$message;
            $add->save();            
        }
        else
        {
           $add=Message::find($request->id);
           $add->delete();
        }

        return 1;
    }

    public function changeMode(Request $request)
    {
        $data=User::where('id',Auth::user()->id)->first();
        $data->is_enabled=$request->notification;
        $data->save();
        return 1;
    }


    public function sendNotification($token,$request,$type)
{
    // dd($token);
    $url ="https://fcm.googleapis.com/fcm/send";
    if($type==1)
    {
        $fields=array(
            "to"=>$token->push_token,
            "notification"=>array(
                "body"=>"".$request->message,
                "title"=>$request->user->name." messaged in chat",
                "icon"=>"https://dsptechnologies.co.in/assets/title.png",
                "click_action"=>"http://localhost:84/backend/"
            )
        );
    }
    else
    {
        $fields=array(
            "to"=>$token->push_token,
            "notification"=>array(
                "body"=>"Photo",
                "title"=>$request->user->name." send image in chat",
                "icon"=>"https://dsptechnologies.co.in/assets/title.png",
                "click_action"=>"http://localhost:84/backend/"
            )
        );
    }
       
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

public function uploadImages(Request $request)
{
        date_default_timezone_set("Asia/Calcutta");

        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('images');
        $message="<img src='".config('app.baseURL')."/storage/app/".$path."' style='width:200px;margin:0;padding:0' onclick='getImage(this.src)'>";
        $new=new Message();
        $new->user_id=Auth::user()->id;
        $new->message=$message;
        $new->save();

        $token=User::where('id','!=',Auth::user()->id)->where('push_token','!=',Null)->where('is_enabled',1)->get();
        foreach($token as $dataa)
        {
            $this->sendNotification($dataa,$new,0);
        }
        return 1;
}
}
