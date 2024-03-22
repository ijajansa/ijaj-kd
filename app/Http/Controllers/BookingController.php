<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Report;
use App\Models\Bar;
use App\Models\HajeriShed;
use App\Models\Ward;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Config;
use DataTables;

class BookingController extends Controller
{
    public function getReportRecord(Request $request)
    {
        $data=Report::where('barcode_id',$request->barcode_id)->whereDate('created_at',date('Y-m-d'))->first();
        if($data)
        {
            return response()->json(['success'=>true,'message'=>'Found', 'report_details' => $data]);
        }
        else
        {
            return response()->json(['success'=>false,'message'=>'User Not Found']);
        }
    }
    
    public function getUserProfile(Request $request)
    {
        $data=Customer::where('id',$request->user_id)->first();
        if($data)
        {
            return response()->json(['success'=>true,'message'=>'success', 'data' => $data]);
        }
        else
        {
            return response()->json(['success'=>false,'message'=>'User Not Found']);
        }
    }
    public function getAllReports(Request $request)
    {
        $data=Report::with('user')->with('barcode')->orderBy('id','DESC');
        if($request->from_date!=null)
        {
            $data=$data->whereDate('created_at','>=',$request->from_date);
        }
        if($request->to_date!=null)
        {
            $data=$data->whereDate('created_at','<=',$request->to_date);
        }
        
        if($request->barcode_id!=null)
        {
            $data=$data->where('barcode_id',$request->barcode_id);
        }
        
        if($request->name!=null)
        {
            $user=Customer::where('name', 'like', '%' .$request->name. '%')->orWhere('mobile_number', 'like', '%' .$request->name. '%')->pluck('id');
            $data=$data->whereIn('customer_id',$user)->orWhereIn('inspector_id',$user);
        }
        
        if($request->area!=null)
        {
            $area=Bar::where('address','like','%'.$request->area.'%')->pluck('id');
            if($area)
            {
                $data=$data->whereIn('barcode_id',$area);   
            }
        }


        // if($request->shed!=null)
        // {
        //     $shed_id=HajeriShed::where('hajeri_shed','like','%'.$request->shed.'%')->where('is_active',1)->pluck('id');
        //     if($shed_id)
        //     {
        //         $area=Bar::whereIn('shed_id',$shed_id)->pluck('id');
        //         if($area)
        //         {
        //             $data=$data->whereIn('barcode_id',$area);   
        //         }   
        //     }
        // }

        if($request->ward!=null)
        {
            $ward_id=Ward::where('name','like','%'.$request->ward.'%')->where('is_active',1)->pluck('id');
            if($ward_id)
            {
                $area=Bar::whereIn('ward_id',$ward_id)->pluck('id');
                if($area)
                {
                    $data=$data->whereIn('barcode_id',$area);   
                }   
            }
        }
        
        $data=$data->get();
        
        return view('booking.all')->with('data',$data);
    }

    public function addReport(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $post = $request->all();
        $before_work = $post['before_work']??null;
        $after_work = $post['after_work']??null;
        $section_before_work = $post['section_before_work']??null;
        $section_after_work = $post['section_after_work']??null;
        $section1_before_work = $post['section1_before_work']??null;
        $section1_after_work = $post['section1_after_work']??null;


        if (!empty($before_work)) 
        {
            $image = base64_decode($request->before_work);
            $number = rand(1111111, 999999);
            $path = "report/" . $number . ".png";
            file_put_contents("storage/app/" . $path, $image);
        }
        else
        {
            $path=null;   
        }
        

        if (!empty($after_work)) 
        {
            $image1 = base64_decode($request->after_work);
            $number1 = rand(1111111, 999999);
            $path1 = "report/" . $number1 . ".png";
            file_put_contents("storage/app/" . $path1, $image1);
        }
        else
        {
            $path1=null;   
        }

        if (!empty($section_before_work)) 
        {
            $image2 = base64_decode($request->section_before_work);
            $number2 = rand(1111111, 999999);
            $path2 = "report/" . $number2 . ".png";
            file_put_contents("storage/app/" . $path2, $image2);
        }
        else
        {
            $path2=null;   
        }

        if (!empty($section_after_work)) 
        {
            $image3 = base64_decode($request->section_after_work);
            $number3 = rand(1111111, 999999);
            $path3 = "report/" . $number3 . ".png";
            file_put_contents("storage/app/" . $path3, $image3);
        }
        else
        {
            $path3=null;   
        }



        if (!empty($section1_before_work)) 
        {
            $image4 = base64_decode($request->section1_before_work);
            $number4 = rand(1111111, 999999);
            $path4 = "report/" . $number4 . ".png";
            file_put_contents("storage/app/" . $path4, $image4);
        }
        else
        {
            $path4=null;   
        }

        if (!empty($section1_after_work)) 
        {
            $image5 = base64_decode($request->section1_after_work);
            $number5 = rand(1111111, 999999);
            $path5 = "report/" . $number5 . ".png";
            file_put_contents("storage/app/" . $path5, $image5);
        }
        else
        {
            $path5=null;   
        }




        $check=Report::where('barcode_id',$request->barcode_id)->whereDate('created_at',date('Y-m-d'))->first();
        // $check=Report::where('customer_id',$request->customer_id)->where('barcode_id',$request->barcode_id)->first();
        if($check)
        {
            if($check->before_work==null)
            {
                $check->before_work=$path;
                $check->before_time=$request->before_time;
            }    
            if($request->before_latlng!=null)
            {
                $check->before_latlng=$request->before_latlng;
            }
            if($check->after_work==null)
            {
                $check->after_work=$path1;
                $check->after_time=$request->after_time;
            }
            if($request->after_latlng!=null)
            {
                $check->after_latlng=$request->after_latlng;
            }
            
            if($check->section_before_work==null)
            {
                $check->section_before_work=$path2;
                $check->section_before_time=$request->section_before_time;
            }
            if($request->section_before_latlng!=null)
            {
                $check->section_before_latlng=$request->section_before_latlng;
            }
            
            if($check->section_after_work==null)
            {
                $check->section_after_work=$path3;
                $check->section_after_time=$request->section_after_time;
            }
            if($request->section_after_latlng!=null)
            {
                $check->section_after_latlng=$request->section_after_latlng;
            }
            if($check->section1_before_work==null)
            {
                $check->section1_before_work=$path4;
                $check->section1_before_time=$request->section1_before_time;
            }
            if($request->section1_before_latlng!=null)
            {
                $check->section1_before_latlng=$request->section1_before_latlng;
            }
             
            if($check->section1_after_work==null)
            {
                $check->section1_after_work=$path5;
                $check->section1_after_time=$request->section1_after_time;
            }
            if($request->section1_after_latlng!=null)
            {
                $check->section1_after_latlng=$request->section1_after_latlng;
            }
            
           
            
            
            $check->save();   
            return response()->json(['success'=>true,'message'=>'success', 'data' => $check]);
            
            // if($check->before_work!=null && $check->after_work!=null && $check->section_before_work!=null && $check->section_after_work!=null && $check->section1_before_work!=null && $check->section1_after_work!=null)
            // {
            //     $data=new Report();
            //     $data->before_work=$path;
            //     $data->after_work=$path1;
            //     $data->section_before_work=$path2;
            //     $data->section_after_work=$path3;
            //     $data->section_before_latlng=$request->section_before_latlng;
            //     $data->section_after_latlng=$request->section_after_latlng;
            //     $data->before_latlng=$request->before_latlng;
            //     $data->after_latlng=$request->after_latlng;

            //     $data->section1_before_work=$path4;
            //     $data->section1_after_work=$path5;
            //     $data->section1_before_latlng=$request->section1_before_latlng;
            //     $data->section1_after_latlng=$request->section1_after_latlng;

            //     $data->barcode_id=$request->barcode_id;
            //     $data->customer_id=$request->customer_id;
            //     $data->save();
            //     return response()->json(['success'=>true,'message'=>'success', 'data' => $data]);
            // }
        }
        else
        {
            $data=new Report();
            $data->before_work=$path;
            $data->after_work=$path1;
            $data->before_latlng=$request->before_latlng;
            $data->after_latlng=$request->after_latlng;
            
            $data->before_time=$request->before_time;
            $data->after_time=$request->after_time;
            
            $data->section_before_work=$path2;
            $data->section_after_work=$path3;
            $data->section_before_latlng=$request->section_before_latlng;
            $data->section_after_latlng=$request->section_after_latlng;
            
            
            $data->section_before_time=$request->section_before_time;
            $data->section_after_time=$request->section_after_time;



            $data->section1_before_work=$path4;
            $data->section1_after_work=$path5;
            $data->section1_before_latlng=$request->section1_before_latlng;
            $data->section1_after_latlng=$request->section1_after_latlng;
            
            
            $data->section1_before_time=$request->section1_before_time;
            $data->section1_after_time=$request->section1_after_time;


            $data->barcode_id=$request->barcode_id ?? 0;
            $data->customer_id=$request->customer_id ?? 0;
            $data->inspector_id=$request->inspector_id ?? 0;
            
            $data->save();
            return response()->json(['success'=>true,'message'=>'success', 'data' => $data]);  
        }    

    }
    
    
    public function updateRemark(Request $request) {
       
       $sql = Report::where('barcode_id', $request->barcode_id)->whereDate('created_at',date('Y-m-d'))->first(); 
    //   $sql = Report::where('barcode_id', $request->barcode_id)->where('customer_id', $request->customer_id)->first();
       if($sql) {
           if($request->remark !=null) {
       $sql->remark=$request->remark;
           } else if($request->section_remark !=null) {
       $sql->section_remark=$request->section_remark;
           } else if($request->section1_remark !=null) {
       $sql->section1_remark=$request->section1_remark;
           }
       $sql->save();
       if($sql) {
       return response(['success'=>'true' , 'message' => 'Reamrk Added']);
       } else {
           return response(['success'=>'false' , 'message' => 'Remark fail to upload']);
       }
       
       } else {
           return response(['success'=>'false' , 'message' => 'Please upload work images']);
       }
        
    }


    public function getReportDetails($id)
    {
        $checks=Report::where('id',$id)->with('barcode')->first();
        return view('booking.edit')->with('data',$checks);
    }

    public function exportExcel(Request $request)
    {
        $html='<table border="1">
        <tr>
        <th colspan="28"><h3>MANCHAR NAGARPANCHAYAT Report Data</h3></th>
        </tr>
        <tr>
        <th>Date</th>
        <th>Time</th>
        <th>QRCode ID</th>
        <th>Ward Name</th>
        <th>Area Name</th>
        <th>Incharge Person</th>
        <th>Mukadam Name</th>
        <th>Morning Before Work</th>
        <th>Morning Before Time</th>
        <th>Morning After Work</th>
        <th>Morning After Time</th>        
        <th>Morning Before Work Latitude & Longitude</th>
        <th>Morning After Work Latitude & Longitude</th>
        <th>Morning Remark</th>
        <th>Afternoon Before Work</th>
        <th>Afternoon Before Time</th>        
        <th>Afternoon After Work</th>
        <th>Afternoon After Time</th>        
        <th>Afternoon Before Work Latitude & Longitude</th>
        <th>Afternoon After Work Latitude & Longitude</th>
        <th>Afternoon Remark</th>
        <th>Evening Before Work</th>
        <th>Evening Before Time</th>        
        <th>Evening After Work</th>
        <th>Evening After Time</th>        
        <th>Evening Before Work Latitude & Longitude</th>
        <th>Evening After Work Latitude & Longitude</th>
        <th>Evening Remark</th>
        </tr>';
        $rto=Report::with('user:id,name')->with('mukadam:id,name')->with('barcode');
        if($request->from_date!=null)
        {
            $rto=$rto->whereDate('created_at','>=',$request->from_date);
        }
        if($request->to_date!=null)
        {
            $rto=$rto->whereDate('created_at','<=',$request->to_date);
        }
        
        if($request->barcode_id!=null)
        {
            $rto=$rto->where('barcode_id',$request->barcode_id);
        }
        
        
        if($request->name!=null)
        {
            $user=Customer::where('name', 'like', '%' .$request->name. '%')->orWhere('mobile_number', 'like', '%' .$request->name. '%')->pluck('id');
            $rto=$rto->whereIn('customer_id',$user)->orWhereIn('inspector_id',$user);
        }

        if($request->area!=null)
        {
            $area=Bar::where('address','like','%'.$request->area.'%')->pluck('id');
            if($area)
            {
                $rto=$rto->whereIn('barcode_id',$area);   
            }
        }


        if($request->ward!=null)
        {
            $ward_id=Ward::where('name','like','%'.$request->ward.'%')->where('is_active',1)->pluck('id');
            if($ward_id)
            {
                $area=Bar::whereIn('ward_id',$ward_id)->pluck('id');
                if($area)
                {
                    $rto=$rto->whereIn('barcode_id',$area);   
                }   
            }
        }
        
        
        $rto=$rto->orderBy('created_at','DESC')->get();
        foreach ($rto as $rtos) 
        {
            $html .= '<tr>
            <td>'.$rtos->created_at->format('Y-m-d').'</td>
            <td>'.$rtos->created_at->format('H:i').'</td>
            <td>'.$rtos->barcode_id.'</td>';
            
            if($rtos->barcode != null)
            {
                if($rtos->barcode->ward!=NULL)
                {
                    $html.='<td>'.$rtos->barcode->ward->name.'</td>';
                }
                else
                {
                    $html.='<td>-</td>';
                }
                
                $html.='<td>'.$rtos->barcode->address.'</td>';
            }
            else
            {
                $html .='<td>-</td>
                <td>-</td>
                <td>-</td>';
            }
            
            if($rtos->user !=null)
            $html.='<td>'.$rtos->user->name.'</td>';
            else
            $html.='<td>-</td>';
            if($rtos->mukadam !=null)
            $html.='<td>'.$rtos->mukadam->name.'</td>';
            else
            $html.='<td>-</td>';
            
            
            $html.='
            <td><a href='.Config::get("app.baseURL")."/storage/app/".$rtos->before_work.'>'.$rtos->before_work.'</a></td>
            <td>'.$rtos->before_time.'</td>
            <td><a href='.Config::get("app.baseURL")."/storage/app/".$rtos->after_work.'>'.$rtos->after_work.'</a></td>
            <td>'.$rtos->after_time.'</td>
            <td>'.$rtos->before_latlng.'</td>
            <td>'.$rtos->after_latlng.'</td>
            <td>'.$rtos->remark.'</td>
            <td><a href='.Config::get("app.baseURL")."/storage/app/".$rtos->section_before_work.'>'.$rtos->section_before_work.'</a></td>
            <td>'.$rtos->section_before_time.'</td>
            <td><a href='.Config::get("app.baseURL")."/storage/app/".$rtos->section_after_work.'>'.$rtos->section_after_work.'</a></td>
            <td>'.$rtos->section_after_time.'</td>
            <td>'.$rtos->section_before_latlng.'</td>
            <td>'.$rtos->section_after_latlng.'</td>
            <td>'.$rtos->section_remark.'</td>
            <td><a href='.Config::get("app.baseURL")."/storage/app/".$rtos->section1_before_work.'>'.$rtos->section1_before_work.'</a></td>
            <td>'.$rtos->section1_before_time.'</td>
            <td><a href='.Config::get("app.baseURL")."/storage/app/".$rtos->section1_after_work.'>'.$rtos->section1_after_work.'</a></td>
            <td>'.$rtos->section1_after_time.'</td>
            <td>'.$rtos->section1_before_latlng.'</td>
            <td>'.$rtos->section1_after_latlng.'</td>
            <td>'.$rtos->section1_remark.'</td>
            </tr>';
        }
        $html.='</table>';
        

        header("Content-type: application/xls");  
        header("Content-Disposition: attachment; filename=reports.xls");  
        echo $html;

    }


    public function checkProfile(Request $request)
    {
        if($request->inspector_id!=null)
        {
            $customer=Customer::where('id',$request->inspector_id)->first();
        }
        else
        {
            $customer=Customer::where('id',$request->customer_id)->first();
        }

            if($customer)
            {
                $array=explode(',',$customer->area_id);
                if(in_array($request->barcode_id, $array))
                {
                    return response(['success'=>true,'message'=>'Barcode Assigned']);
                }
                else
                {
                    return response(['success'=>false,'message'=>'Barcode Not Assigned To User']);
                }
            }
            else
            {
                return response(['success'=>false,'message'=>'User Not Found']);
            }
        
    }
}
