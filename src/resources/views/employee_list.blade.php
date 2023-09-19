@extends('layouts.app')

@section('css')
<link rel='stylesheet' href='{{ asset("css/employee_list.css")}}'>
<link rel='stylesheet' href='{{ asset("css/app.css")}}'>
<link rel='stylesheet' href='{{ asset("css/bootstrap.min.css")}}'>
</head>
@endsection

@section('content')
<div class='search_employee'>
<div class='instruction_message'>
    <p>従業員氏名を選択ください！</p>
</div>
<div class='search_form'>
  <div>
  <form class="create-form" action="/employee/search" method="get">
  @csrf
    <div class="create-form__item">
      <select class="create-form__item-select" name="user_id">
        @foreach($employees_list as $user)
          <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>    
        @endforeach
      </select>
    </div>
    </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">検索</button>
    </div>
  </form>
</div>
</div>

@endsection