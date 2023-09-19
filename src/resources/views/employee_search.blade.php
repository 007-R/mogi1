@extends('layouts.app')

@section('css')
<link rel='stylesheet' href='{{ asset("css/employee_search.css")}}'>
<link rel='stylesheet' href='{{ asset("css/app.css")}}'>
<link rel='stylesheet' href='{{ asset("css/bootstrap.min.css")}}'>
</head>
@endsection

@section('content')
<div class='attnedance_list'>
<div class = 'employee_title'>
  <p>{{ $time_list['user_name'][0]['name'] }}さんの勤務実績</p>
</div>
<table>
    <tr>
        <th>年月日</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
    <tr>
    @foreach ($work_info as $content)
    <tr>
        <td><?php echo(date('y-m-d', strtotime($content['start']))); ?></td>
        <?php $start = strtotime($content['start']); $start_time = date('H:i:s', $start);?>
        <td>{{$start_time}}</td>
        <?php $end = strtotime($content['end']);
        $end_time = date('H:i:s', $end);?>
        <td>{{ $time_list['endtime'][$content['id']] }}</td>
        <td>{{ $time_list['resttime'][$content['id']] }}</td>
        <td>{{ $time_list['worktime'][$content['id']] }}</td>

    </tr>
    @endforeach
</table>

<div class='paginate'>
    {{$work_info -> links() }} 
</div>

</div>

@endsection