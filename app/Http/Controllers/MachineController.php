<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
class MachineController extends Controller
{
    public function allMachineData()
    {
        $machine=Machine::all();
        return view('machine.all')->with('machine',$machine);
    }
    public function deleteMachineData($id)
    {
        $machine=Machine::find($id);
        $machine->delete();
        $notification = array(
            'message' => 'Machine Details Deleted Successfully !',
            'alert-type' => 'success'
        );
        return redirect('machine/all')->with($notification);
    }
    public function editMachinePage($id)
    {
        $machine=Machine::find($id);
        return view('machine.edit')->with('machine',$machine);
    }

    public function editMachineData(Request $request)
    {
        $machine=Machine::find($request->id);
        $machine->machine_id=$request->machine_id;
        $machine->machine_name=$request->machine_name;
        $machine->save();
        $notification = array(
            'message' => 'Machine Details Updated Successfully !',
            'alert-type' => 'success'
        );
        return redirect('machine/all')->with($notification);
    }

    public function addMachinePage()
    {
        return view('machine.add');
    }
    public function addMachineData(Request $request)
    {
        $machine=new Machine();
        $machine->machine_id=$request->machine_id;
        $machine->machine_name=$request->machine_name;
        $machine->save();
        $notification = array(
            'message' => 'Machine Details Added Successfully !',
            'alert-type' => 'success'
        );
        return redirect('machine/all')->with($notification);
    }
}
