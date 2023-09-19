<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atte_worktime_management</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <span>Atte</span>
        </div>
        <div class='menu'>
            @if (Auth::check())
            <ul class="header-nav-list">
                <li class="header-nav-item"><a class=header-text  href="/">ホーム</a></li>
                <li class="header-nav-item"><a class=header-text href="/date">日付一覧</a></li>
                <li class="header-nav-item"><a class=header-text href="/employeeList">従業員別一覧</a></li>
                <form class='form' action='/logout' method='post'>
                @csrf
                <button class="header-nav-item" type='submit'><a>ログアウト</a></button></form>
            </ul>
            @endif
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    <footter>
        <div class='foot'>
            <span>Atte,inc.<span>
        <div>
    </footter>   
</body>

</html>