@extends('layouts.app')
 
@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class='login'>
    <h3>ログイン</h3>
    <form class='login-form' method='post' action='/login'>
        @csrf
        <div class='email_input'>
            <input name='email' type='email' placeholder='メールアドレス', value="{{old('email')}}">
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
        <div class='password_input'>
            <input name='password' type='password' placeholder='パスワード'>  
        </div>
        <div class="form__error">          
        @error('password')
          {{ $message }}
        @enderror
        </div>
        <div>
            <button class='button_comment' type='submit'>ログイン</button>
        </div>
    </form>
    <div>
        <p class='comment'>アカウントをお持ちでない方はこちら</p>
        <a href='/register'>会員登録</a>
    </div>
</div>
@endsection