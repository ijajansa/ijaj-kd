<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Material;
use App\Models\MaterialDetail;
class MaterialController extends Controller
{
    public function deleteAjaxMaterial(Request $request)
    {
        $data=MaterialDetail::where('id',$request->id)->first();
        $data->delete();
        return 1;
    }
    public function allMaterialData()
    {
        $material=Material::all();
        return view('material.all')->with('material',$material);
    }
    public function deleteMaterialData($id)
    {
        $material=Material::find($id);
        $material->delete();
        $notification = array(
                'message' => 'Material Deleted Successfully !',
                'alert-type' => 'success'
            );
        return redirect('material/all')->with($notification);
    }
    public function editMaterialPage($id)
    {
        $material=Material::where('id',$id)->with('all_material')->first();
        $select=Material::all();
        return view('material.edit')->with('material',$material)->with('select',$select);
    }

    public function editMaterialData(Request $request)
    {
        $material=Material::find($request->id);
        $material->supplier_product_code=$request->supplier_product_code;
        $material->product_description=$request->product_description;
        $material->our_product_code=$request->our_product_code;
        $material->label_stock_width=$request->width;
        $material->label_stock_height=$request->height;
        $material->roll_quantity=$request->roll_quantity;
        
        $material->save();
        $notification = array(
                'message' => 'Material Updated Successfully !',
                'alert-type' => 'success'
            );
        return redirect('material/all')->with($notification);
    }

    public function addMaterialPage()
    {
        return view('material.add');
    }
    public function addMaterialData(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        $chk=Material::where('our_product_code',$request->our_product_code)->first();
        if($chk)
        {
            $material_detail=new MaterialDetail();
            $material_detail->supplier_product_code=$request->supplier_product_code;
            $material_detail->product_description=$request->product_description;
            $material_detail->width=$request->width;
            $material_detail->height=$request->height;
            $material_detail->rolls=$request->rolls;
            $material_detail->feet=$request->feet;
            $material_detail->material_id=$chk->id;
            $material_detail->save();
        }
        else
        {
            $material=new Material();
            $material->our_product_code=$request->our_product_code;
            $material->supplier_product_code=$request->supplier_product_code;
            $material->product_description=$request->product_description;
            $material->save();       
            $material_detail=new MaterialDetail();
            $material_detail->supplier_product_code=$request->supplier_product_code;
            $material_detail->product_description=$request->product_description;
            $material_detail->width=$request->width;
            $material_detail->height=$request->height;
            $material_detail->rolls=$request->rolls;
            $material_detail->feet=$request->feet;
            $material_detail->material_id=$material->id;
            $material_detail->save();     
        }

        $notification = array(
                'message' => 'Material Added Successfully !',
                'alert-type' => 'success'
            );
        return redirect('material/all')->with($notification);
    }
}
