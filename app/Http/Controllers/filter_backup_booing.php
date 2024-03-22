
    public function getAllReportsData(Request $request)
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
            $data=$data->whereIn('customer_id',$user);
        }
        
        if($request->area!=null)
        {
            $area=Bar::where('address','like','%'.$request->area.'%')->pluck('id');
            if($area)
            {
                $data=$data->whereIn('barcode_id',$area);   
            }
        }


        if($request->shed!=null)
        {
            $shed_id=HajeriShed::where('hajeri_shed','like','%'.$request->shed.'%')->where('is_active',1)->pluck('id');
            if($shed_id)
            {
                $area=Bar::whereIn('shed_id',$shed_id)->pluck('id');
                if($area)
                {
                    $data=$data->whereIn('barcode_id',$area);   
                }   
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
                    $data=$data->whereIn('barcode_id',$area);   
                }   
            }
        }
        
        $data=$data->get();
        
        foreach($data as $key=>$value)
        {
            $value['sr']=++$key;
            $value['enquiry']=date('Y-m-d', strtotime($value->created_at));
        }
        return DataTables::of($data)->make(true);
    }

   

