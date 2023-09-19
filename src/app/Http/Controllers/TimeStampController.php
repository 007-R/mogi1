<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\worktime;
use App\Models\resttime;


class TimeStampController extends Controller
{
    public function start_work (Request $request){
        $time = time();
        $start = date('y-m-d h:i:s', $time); 
        $input = $request->only(['user_id']);
        $input = $input + ['start' => $start];
        worktime::create($input);
        return view('index')->with('button', ['sw' => 1, 'fw' => 0, 'sr' => 0, 'fr' => 1]);
    }
    public function finish_work (Request $request){
        $time = time();
        $finish = date('y-m-d h:i:s', $time);
        $user_id = $request->only(['user_id']);
        $input = $user_id + ['end' => $finish];
        $finish = worktime::where('user_id', $request->user_id)->where('end', null)-> update($input);
        return view('index')->with('button', ['sw' => 0, 'fw' => 1, 'sr' => 1, 'fr' => 1]);
    }
    public function start_rest(Request $request)
    {
        $time = time();
        $start = date('y-m-d h:i:s', $time);
        $worktime_id = worktime::where('user_id', $request->user_id)->latest()->first(); 
        $input = ['worktime_id' => $worktime_id['id']] + ['start' => $start];
        resttime::create($input);
        return view('index')->with('button', ['sw' => 1, 'fw' => 1, 'sr' => 1, 'fr' => 0]);
    }
    public function finish_rest(Request $request)
    {
        $time = time();
        $finish = date('y-m-d h:i:s', $time);
        $worktime_id = worktime::where('user_id', $request->user_id)->latest()->first();
        $input = ['worktime_id' => $worktime_id['id']] + ['end' => $finish];
        resttime::where('worktime_id', $worktime_id['id']) ->  where('end', null) -> update($input);
        return view('index')->with('button', ['sw' => 1, 'fw' => 0, 'sr' => 0, 'fr' => 1]);
    }
}