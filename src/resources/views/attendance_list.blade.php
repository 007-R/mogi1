@extends('layouts.app')

@section('css')
<link rel='stylesheet' href='{{ asset("css/attendance_list.css")}}'>
<link rel='stylesheet' href='{{ asset("css/app.css")}}'>
<link rel='stylesheet' href='{{ asset("css/bootstrap.min.css")}}'>
</head>
@endsection

@section('content')
<div class='attnedance_list'>

<div  class='paginate'>
{{$date_paging -> links('vendor.pagination.simple-bootstrap-4') }}
</div>

<table>
    <tr>
        <th>名前</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
    <tr>
    @foreach ($contents as $content)
    <tr>

        <td>{{$content['user']['name']}}</td>
        <?php $start = strtotime($content['start']);
        $start_time = date('H:i:s', $start);?>
        <td>{{$start_time}}</td>
        <?php $end = strtotime($content['end']);
        $end_time = date('H:i:s', $end);?>
        <td>{{ $time_list['endtime'][$content['id']] }}</td>
        <td>{{ $time_list['resttime'][$content['id']] }}</td>
        <td>{{ $time_list['worktime'][$content['id']] }}</td>


    </tr>
    @endforeach

</table>
</div>
<div class='paginate'>
    {{$contents -> links() }} 
</div>
@endsection