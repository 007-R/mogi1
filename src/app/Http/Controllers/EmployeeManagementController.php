<?php

namespace App\Http\Controllers;
use App\Models\worktime;
use App\Models\resttime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class EmployeeManagementController extends Controller
{
    public function date_list(Request $request)
    {
        /*対象日付リストの作成*/
        $date_info = worktime::selectRaw('DATE_FORMAT(start, "%Y-%m-%d") AS date')->groupBy('date')->orderBy('date');

        /*日付のページネーション*/
        $datelist = $date_info->get('date')->toArray();
        $date_paging = $date_info->simplePaginate(1, ["*"], 'date-page')->appends(["time-page" => $request->input('time-page')]);

        /*表示中日付の取得*/
        $current_page = $date_paging ->currentPage();
        $date_paging->appends($datelist);
        $displayed_date = $datelist[$current_page -1]['date'];

        /*表示中日付のデータの表示*/
        $contents = worktime::with('user')->whereDate('start', $displayed_date)->paginate(5, ["*"], 'time-page')->appends(["date-page" => $request->input('date-page')]);

        /*表示中日付のworktime_id*/
        $worktime_id = worktime::whereDate('start', $displayed_date)->groupBy('id')->get('id')->toArray();

        /*表示中日付のデータの休憩時間算出*/
        $resttimes = resttime::whereDate('start', $displayed_date)->select('worktime_id')->select(DB::raw(' *, end - start AS resttime'));

        /*表示中workidの勤務・休憩時間算出*/
        $rest_time = [];
        $work_time =[];
        $end_time = [];
        foreach($worktime_id as $s){
            $rtime = 0;
            $resttime = resttime::where('worktime_id', $s['id'])->get();
            if (isset($resttime)){
                foreach ($resttime as $r) {
                    $start = strtotime($r['start']);
                    $end = strtotime($r['end']);
                    $rtime_p = $end - $start;
                    $rtime = $rtime + $rtime_p;
                }
            }
            $rest_time[$s['id']] = gmdate("H:i:s", $rtime);

            $worktime = worktime::where('id', $s['id'])->get();
            $start = strtotime($worktime[0]['start']);
            $end = strtotime($worktime[0]['end']);
            $sdate = date('md', $start);
            $edate = date('md', $end);

            if ($sdate==$edate){
                $wtime = $end - $start - $rtime;
                $work_time[$s['id']] = gmdate("H:i:s", $wtime);
                $end_time[$s['id']] = date('H:i:s', $end);
            }else{
                $start_date = new DateTime($worktime[0]['start']);
                $start_date->modify("+1 day");
                $end = strtotime($start_date->format('y-m-d'));

                /*$end = new DateTime($start_date->format('y-m-d'));
                $end = $end->format('U');*/
        
                $wtime = $end - $start - $rtime;
                $work_time[$s['id']] = gmdate("H:i:s", $wtime);
                $end_time[$s['id']] = date("H:i:s", $end);
            }
            
        }

        $time_list = [];
        
        $time_list['worktime'] = $work_time;
        $time_list['resttime'] = $rest_time;
        $time_list['endtime'] = $end_time;

        /*->whereDate('created_at', $displayed_date);*/
        /*->select(DB::raw(' *, end - start AS 


        foreach ($sample as $id){
            $rest = restime::where('worktime_id', $id)->select(DB::raw(' *, end - start AS resttime'))->get();
         
        }

        /*$hash = array(
                        'date'=> $date_paging,
                        'time'=> $contents
                    );
        webでは->with $hashとしていたがなくても大丈夫？*/

       /*$contents->groupBy(function ($item, $key) {
           return Carbon::parse($item['created_at'])->day;
       });*/

        return view('attendance_list', compact('date_paging', 'displayed_date', 'contents'))->with('time_list', $time_list);
    }

    public function employee_list(Request $request)
    {
        $employees_list = User::all();
        return view("employee_list", compact('employees_list'));
    }

    public function employee_search(Request $request)
    {
        $user_name = User::where('id', $request->user_id)->get();
        $info = worktime::TargetSearch($request->user_id);
        $work_info = $info ->paginate(5, ['*'], 'employee-page')->appends(['user_id' => $request -> user_id]);

        $rest_time = [];
        $work_time = [];
        $end_time = [];

        $worktime_id = worktime::TargetSearch($request->user_id)->select('id')->get()->toArray();

        foreach ($worktime_id as $s) {
            $rtime = 0;
            $resttime = resttime::where('worktime_id', $s['id'])->get();
            if (isset($resttime)) {
                foreach ($resttime as $r) {
                    $start = strtotime($r['start']);
                    $end = strtotime($r['end']);
                    $rtime_p = $end - $start;
                    $rtime = $rtime + $rtime_p;
                }
            }
            $rest_time[$s['id']] = gmdate("H:i:s", $rtime);

            $worktime = worktime::where('id', $s['id'])->get();
            $start = strtotime($worktime[0]['start']);
            $end = strtotime($worktime[0]['end']);
            $sdate = date('md', $start);
            $edate = date('md', $end);

            if ($sdate == $edate) {
                $wtime = $end - $start - $rtime;
                $work_time[$s['id']] = gmdate("H:i:s", $wtime);
                $end_time[$s['id']] = date('H:i:s', $end);
            } else {
                $start_date = new DateTime($worktime[0]['start']);
                $start_date->modify("+1 day");
                $end = strtotime($start_date->format('y-m-d'));

                /*$end = new DateTime($start_date->format('y-m-d'));
                $end = $end->format('U');*/

                $wtime = $end - $start - $rtime;
                $work_time[$s['id']] = gmdate("H:i:s", $wtime);
                $end_time[$s['id']] = date("H:i:s", $end);
            }

        }

        $time_list = [];
        $time_list['user_name'] = $user_name;
        $time_list['worktime'] = $work_time;
        $time_list['resttime'] = $rest_time;
        $time_list['endtime'] = $end_time;


        return view("employee_search", compact('work_info')) ->with('time_list', $time_list);
    }
}

