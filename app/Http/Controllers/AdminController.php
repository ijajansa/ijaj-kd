<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('users.role_id',2)->orderBy('users.name','ASC')->leftJoin('categories','categories.id','users.category_id')->select('users.*','categories.name as category_name')->get();
        return view('admin.all',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active',1)->get();
        return view('admin.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'contact_number'=>'required|unique:users,contact_number|numeric|digits:10',
            'password'=>'required|min:8',
        ],[
            'category_id.required' => 'The category field is required.'
        ]);
        $user = new User();
        $user->name = $request->name ?? null;
        $user->email = $request->email ?? null;
        $user->role_id = 2;
        $user->contact_number = $request->contact_number ?? null;
        $user->password = Hash::make($request->password);
        $user->save();
        $notification = array(
            'message' => 'Subadmin registered successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admins.index')->with($notification);
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
    public function edit($id)
    {
        $categories = Category::where('is_active',1)->get();
        $user = User::findOrFail($id);
        
        return view('admin.edit',compact('user','categories'));
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
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id.'',
            'contact_number'=>'required|unique:users,contact_number,'.$id.',|numeric|digits:10',
            'password'=>'nullable|min:8',
        ],[
            'category_id.required' => 'The category field is required.'
        ]);
        $user = User::find($id);
        $user->name = $request->name ?? null;
        $user->email = $request->email ?? null;
        $user->contact_number = $request->contact_number ?? null;
        $user->is_active = $request->is_active ?? null;
        if($request->password !=null)
        $user->password = Hash::make($request->password);
        $user->save();
        $notification = array(
            'message' => 'Subadmin details updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admins.index')->with($notification);
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
