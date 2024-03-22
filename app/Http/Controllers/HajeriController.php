<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bar;
use App\Models\Ward;
use App\Models\HajeriShed;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Auth;
use Storage;
class HajeriController extends Controller
{

    public function printBarcode($id)
    {
        $data=Bar::where('id',$id)->first();
        return view('order.edit')->with('data',$data);
    }

    public function allShed()
    {
        $datas=HajeriShed::with('ward')->orderBy('id','DESC')->get();
        $wards=Ward::where('is_active',1)->get();
        return view('hajeri-shed.all')->with(['datas'=>$datas,'wards'=>$wards]);
    }

   

    public function deleteShed($id)
    {
        $data=HajeriShed::where('id',$id)->first();
        $data->delete();
        $notification = array(
            'message' => 'Record Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function addShed(Request $request)
    {
        $add=new HajeriShed();
        $add->hajeri_shed=$request->hajeri_shed;
        $add->ward_id=$request->ward_id;
        // $add->details=$request->details;
        // $add->barcode=$barcode;
        $add->save();
        $notification = array(
            'message' => 'Record Added Successfully !',
            'alert-type' => 'success'
        );
        return redirect('hajeri-shed/all')->with($notification);
    }    


    public function addShedPage($id)
    {
    	$data=HajeriShed::find($id);
    	$wards=Ward::where('is_active',1)->get();
    	return view('hajeri-shed.add')->with(['data'=>$data,'wards'=>$wards]);
    }

    public function updateShedData(Request $request)
    {
    	$data=HajeriShed::find($request->id);
    	$data->hajeri_shed=$request->hajeri_shed;
    	$data->ward_id=$request->ward_id;
    	$data->is_active=$request->status;
    	$data->save();
    	$notification = array(
            'message' => 'Record Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect('hajeri-shed/all')->with($notification);
    }
}
