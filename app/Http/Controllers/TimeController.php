<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\Time;
use Illuminate\Support\Carbon;


class TimeController extends Controller
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
        $data = Time::orderBy('id','DESC')->paginate(10);
        return view('times.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('times.create', compact('user'));
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
            'entry' => '',
            'exit' => '',
            'missed' => '',
            'ip' => '',
            'timeType' => 'required'
        ]);
        
        $time = Time::create($request->all());
        $time->user_id = $user->id;
        $time->user = $user->name;
        $time->ip = $request->ip();
        //dd($request->all());
        if ($request->timeType == 'Entry')
        {
            $time->entry = Carbon::now()->toDateTimeString();
            $time->exit = null;
        }
        /*else if ($request->timeType == 'Exit')
        {
            $times->exit = Carbon::now()->toDateTimeString();
        }*/

        $time->save();

        return redirect()->route('times.index')
                        ->with('success','Time Recorded Successfully!')->withInput();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::find($id);
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
        $time = Time::find($id);

        return view('times.edit', compact('time'));
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
            'entry' => '',
            'exit' => '',
            'missed' => '',
            'ip' => '',
            'timeType' => 'required'
        ]);

        $time = Time::find($id);

        if ($request->timeType == 'Exit')
        {
            $time->exit = Carbon::now()->toDateTimeString();
        }

        $time->update($request->all());
    
        return redirect()->route('times.index')
                        ->with('success','Exit Time Recorded Successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Time::find($id)->delete();
        return redirect()->route('times.index')
                        ->with('success','Entry/Exit Record Deleted Successfully!');
    }
}
