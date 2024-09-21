<?php

namespace App\Http\Controllers;
use App\Models\WasteRequest;
use App\Models\Recycle;
use Pdf;
use Config;
use Illuminate\Http\Request;

class CDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = WasteRequest::leftJoin('categories','categories.id','waste_requests.category_id')
        ->where('categories.type',2)
        ->where('categories.id',10)
        ->where('waste_requests.status',4)->select('waste_requests.*','categories.name as category_name')->withSum('request_cd_items','actual_qty')->get();
        return view('cd-collections.all',compact('data'));
    }
    public function index2()
    {
        $data = Recycle::where('type',1)->get();
        return view('cd-collections.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = WasteRequest::leftJoin('categories','categories.id','waste_requests.category_id')
        ->where('categories.type',2)
        ->where('categories.id',10)
        ->where('waste_requests.status',4)->select('waste_requests.*','categories.name as category_name')->withSum('request_cd_items','actual_qty')->get();
        
        $total = 0;
        $main_total = 0;
        foreach($data as $record)
        {
            $total += $record->request_cd_items_sum_actual_qty;
            $main_total += $record->request_cd_items_sum_actual_qty;
        }
        
        $recycle = Recycle::where('type',1)->sum('weight');
        $total -= $recycle;
        
        return view('cd-collections.add',compact('total','main_total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'date' =>'required',
            'mobile_number' =>'required|digits:10',
            'ward' =>'required',
            'address' =>'required',
            'weight' =>'required|numeric',
            'category' =>'required',
            'payment' =>'nullable',
            'receipt' =>'nullable|mimes:jpg,png,svg,jpeg,pdf',
            ]);
            if($request->weight > $request->total_qty)
            {
                return redirect()->back()->withErrors(['weight' => 'Weight should be less than total collection'])->withInput();            
            }

            $data = $request->all();
            unset($data['token']);
            $data['added_date'] = $request->date;
            if($request->receipt!=null)
            {
                $data['receipt'] = $request->file('receipt')->store('receipts');
            }
            if(!isset($data['payment']))
            {
                $data['payment'] = 0;
            }
            $is_created = Recycle::create($data);
            if($is_created)
            {
                $is_created->total_collection = $request->main_total;
                $is_created->save();
            }
            $notification = array(
            'message' => 'Collection processed successfully !',
            'alert-type' => 'success'
        );
            return redirect('cd-processed')->with($notification);
    }

    public function exportExcel(Request $request)
    {
        $html='<table border="1">
        <tr>
        <th colspan="14"><h3>VITA MUNICIPAL COUNCIL | C&D Processed Report Data</h3></th>
        </tr>
        <tr>
    		<th rowspan="2" style="text-align:center;align-content: center;">Sr No.</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">Date</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">Name of Person/Party</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">Ward</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">Address</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">Mobile Number</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">Category</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">C&D Collected in MT</th>
    		<th colspan="3" style="text-align:center;align-content: center;">Utilization</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">% of Utilization</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">Payment</th>
    		<th rowspan="2" style="text-align:center;align-content: center;">Photo/Receipt</th>
    	</tr>
    	<tr>
    	    <th style="text-align:center;align-content: center;">Sale</th>
    	    <th style="text-align:center;align-content: center;">Reuse</th>
    	    <th style="text-align:center;align-content: center;">Total</th>
    	</tr>';
        $records=Recycle::orderBy('created_at','ASC')->where('type',1)->get();
        foreach ($records as $key=>$record) 
        {
            $html .= '<tr>
            <td>'.++$key.'</td>
            <td>'.$record->added_date.'</td>
            <td>'.$record->name.'</td>';

            $html.='<td>'.$record->ward.'</td>';
            $html.='<td>'.$record->address.'</td>';
            $html.='<td>'.$record->mobile_number.'</td>';
            $html.='<td>'.$record->category.'</td>';
            $html.='<td>'.$record->total_collection.'</td>';
            
            if($record->category =='sale')
            $html.='<td>'.$record->weight.'</td>';
            else
            $html.='<td>0</td>';
            if($record->category =='reuse')
            $html.='<td>'.$record->weight.'</td>';
            else
            $html.='<td>0</td>';
            $html.='<td>'.$record->weight.'</td>';
            $html.='<td>'.number_format(($record->weight/$record->total_collection) * 100,2).'%</td>';
            $html.='<td>'.$record->payment.'</td>';
            
            $html.='
            <td><a href='.Config::get("app.baseURL")."/storage/app/".$record->receipt.'>'.$record->receipt.'</a></td>
            </tr>';
        }
        $html.='</table>';
        
        $filename = "cd_processed_report_".date('Ymdhis');

        header("Content-type: application/xls");  
        header("Content-Disposition: attachment; filename=".$filename.".xls");  
        echo $html;

    }
    
    public function exportPDF(Request $request)
    {
        dd("In Working");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
