<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\WasteRequest;
use App\Models\WasteRequestItem;
use Illuminate\Http\Request;

class WasteRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = WasteRequest::leftJoin('users','users.id','waste_requests.customer_id')->select('waste_requests.*','users.name','users.contact_number')->orderBy('waste_requests.id','DESC')->get();
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
        $data = WasteRequest::where('waste_requests.uuid',$uuid)
        ->leftJoin('users','users.id','waste_requests.customer_id')
        ->select('waste_requests.*','users.name','users.contact_number')
        ->orderBy('waste_requests.id','DESC')->first();
        if($data)
        {
            $data['waste_items'] = WasteRequestItem::where('request_id',$data->id)->get();
        }
        return view('waste-requests.edit',compact('data'));

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
        //
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
