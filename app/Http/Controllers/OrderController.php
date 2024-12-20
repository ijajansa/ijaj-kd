<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use App\Models\Bar;
use App\Models\User;
use App\Models\Ward;
use App\Models\Category;
use App\Models\HajeriShed;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;

class OrderController extends Controller
{

    public function printAllBarcode()
    {
        $data=Bar::where('is_delete',0)->get();
        return view('order.edit-page')->with('data',$data);
    }

    public function getHajeriShed(Request $request)
    {
        $html='';
        $data=HajeriShed::where('ward_id',$request->id)->where('is_active',1)->get();
        $html.='<option value="">Select</option>';
        foreach ($data as $key => $value) {
            $html.='<option value='.$value->id.'>'.$value->hajeri_shed.'</option>';
        }
        return $html;
    }
    public function getWards(Request $request)
    {
        $html='';
        $data=Ward::where('user_id',$request->id)->where('is_active',1)->get();
        $html.='<option value="">Select</option>';
        foreach ($data as $key => $value) {
            $html.='<option value='.$value->id.'>'.$value->name.'</option>';
        }
        return $html;
    }

    public function printBarcode($id)
    {
        $data=Bar::where('id',$id)->first();
        return view('order.edit')->with('data',$data);
    }

    public function allBarcode()
    {
        $data=Bar::with('category')->orderBy('id','DESC')->where('is_delete',0)->get();
        return view('order.all')->with('data',$data);
    }

    public function addBarcodePage()
    {
        $wards = Ward::where('is_active',1)->get();
        $categories = Category::where('is_active',1)->get();
        return view('order.add',compact('categories','wards'));
    }

    public function deleteBarcode($id)
    {
        if(auth()->user()->role_id==1)
        {
            $data=Bar::where('id',$id)->first();
            if($data)
            {
                $data->is_delete = 1;
                $data->save();
            }
            
            $notification = array(
                'message' => 'Record Deleted Successfully !',
                'alert-type' => 'success'
            );    
        }
        else
        $notification = array(
                'message' => "Don't have permission to delete !",
                'alert-type' => 'error'
            );    
        
        return redirect()->back()->with($notification);
    }

    public function addBarcode(Request $request)
    {
        // $generator = new BarcodeGeneratorPNG();
        // $barcode = '< img src="data:image/png;base64,' . base64_encode($generator->getBarcode($data, $generator::TYPE_CODE_128)) . '" >';

        // $generator = new BarcodeGeneratorPNG();
        // $barcode = '< img src="data:image/png;base64,' . base64_encode($generator->getBarcode($data, $generator::TYPE_CODE_128)) . '" >';

        if($request->category_id!=null)
        {
            foreach($request->category_id as $key=>$id)
            {                
                $add=new Bar();
                $add->address=$request->address[$key];
                $add->name=$request->name[$key];
                $add->ward_id=$request->ward_id;
                $add->category_id=Category::where('name',$id)->first()?->id;
                $add->user_id=$request->user_id;
                $add->shed_id=$request->shed_id;
                $add->save();
            }
        }
        $notification = array(
            'message' => 'Record Added Successfully !',
            'alert-type' => 'success'
        );
        return redirect('barcode/all');
    }    
}
