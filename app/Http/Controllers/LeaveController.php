<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Leave;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:leave-list', ['only' => ['index','create'. 'store', 'show']]);
         $this->middleware('permission:leave-create', ['only' => ['create','store']]);
         $this->middleware('permission:leave-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:leave-delete', ['only' => ['destroy']]);
         
         /*|leave-create|leave-edit|leave-delete*/
    }

    public function index(Request $request)
    {
        $data = Leave::orderBy('id','DESC')->paginate(5);
        return view('leaves.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leave = Auth::user();
        return view('leaves.create', compact('leave'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'user_id' => '',
            'user' => '',
            'detail' => 'required',
            'req_time' => 'required'
        ]);
        
        $leave = Leave::create($request->all());
        $leave->user_id = $user->id;
        $leave->user = $user->name;

        $leave->save();

        return redirect()->route('leaves.index')
                        ->with('success','Leave Requested Successfully!')->withInput();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $leave = Leave::find($id);

        return view('leaves.edit',compact('leave'));
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
        $this->validate($request, [
            'user_id' => '',
            'user' => '',
            'detail' => 'required',
            'req_time' => 'required'
        ]);

        $user = Auth::user();
        $leave = Leave::find($id);
        $leave->status = "Approved by $user->name, ID-$user->id";
        $leave->update($request->all());
    
        return redirect()->route('leaves.index')
                        ->with('success','Request Approved Successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Leave::find($id)->delete();
        return redirect()->route('leaves.index')
                        ->with('success','Leave Request Deleted Successfully');
    }
}
