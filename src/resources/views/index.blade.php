@extends('layouts.app')
 
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


@section('content')
<div class='stamp-form'>
    <div class='mini-title'>
        @if (Auth::check())
        <h2 class ='index_message'>{{Auth::user()->name}}さんお疲れさまです！</h2>
        @endif
    </div>
    <div class=stamp>
        <div class='stamp-button'>
            <form action='/startwork' method='post'>
                @csrf
                <input type='hidden' name='user_id' value='{{ Auth::user()->id}}'>
                <button 
                <?php if($button['sw'] == 1){echo 'disabled';} ?> class='time-stamp' type='submit' id='b1'>勤務開始</button>
            </form>
        </div>
        <div class='satmp-button'>
            <form action='/finishwork' method='post'>
                @csrf
                 <input type='hidden' name='user_id' value='{{ Auth::user()->id}}' >
                <button <?php if($button['fw'] == 1){echo 'disabled';} ?> class='time-stamp' id='b2'>勤務終了</button>
            </form>
        </div>
    </div>
    <div class='stamp'>
        <div class='satmp-button'>
            <form action='/startrest' method='post'>    
                @csrf
                <input type='hidden' name='user_id' value='{{ Auth::user()->id}}' >
                <button <?php if($button['sr'] == 1){echo 'disabled';} ?> class='time-stamp' type='submit' id='b1' onclick='clickBtn1()'>休憩開始</button>
            </form>
        </div>
        <div class='satmp-button'>    
            <form action='/finishrest' method='post'>    
            @csrf
                <input type='hidden' name='user_id' value='{{ Auth::user()->id}}' >
                <button <?php if($button['fr'] == 1){echo 'disabled';} ?> class='time-stamp' type='submit' id='b1'>休憩終了</button>
            </form>            
        </div>
    </div>   
  



</div>
@endsection