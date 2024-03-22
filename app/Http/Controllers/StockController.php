<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\StockProduct;
use App\Models\Message;
use Auth;
use Config;
class StockController extends Controller
{
    public function allOrder()
    {
        $data=ProductType::get();
        return view('stock.all')->with('data',$data); 
    }

    public function allDataOrder($id)
    {
        $values=StockProduct::where('product_type',$id)->with('product')->get();
        return view('stock.all-data')->with('values',$values)->with('product_type',$id);
    }
    public function addOrder($id)
    {
        return view('stock.add')->with('product_type',$id);
    }

    public function addOrderData(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $data=new StockProduct();
        $data->brand=$request->brand;
        $data->model=$request->model;
        $data->resolution=$request->resolution;
        $data->barcode_type=$request->barcode_type;
        $data->quantity=$request->quantity;
        $data->product_type=$request->id;
        $data->supplier_code=$request->supplier_product_code;
        $data->our_product_code=$request->our_product_code;
        $data->core=$request->core;
        $data->ink=$request->ink;
        $data->notch=$request->notch;
        $data->grade=$request->grade;
        $data->label_size1=$request->label_size1;
        $data->label_size2=$request->label_size2;
        $data->label_type1=$request->label_type1;
        $data->label_type2=$request->label_type2;
        $data->save();

        if($request->id==3 || $request->id==4)
        {
            $message="<b>".Auth::user()->name."</b> added <a href='' class='hrefClass'><u>".$data->brand." ".$data->model." ".$data->product->name."</u></a> in stock.";
        }
        else if($request->id==2)
        {
        $message="<b>".Auth::user()->name."</b> added <a href='' class='hrefClass'><u>".$data->product->name."</u></a> in stock.";            
        }

        $new=new Message();
        $new->user_id=Auth::user()->id;
        $new->product_id=$data->id;
        $new->message=$message;
        $new->save();
        $notification = array(
                'message' => 'New Product Added Successfully !',
                'alert-type' => 'success'
            );
        return redirect('stock/all-data/'.$request->id)->with($notification);
    }
}
