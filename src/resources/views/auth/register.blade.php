@extends('layouts.app')
 
@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection


@section('content')
<div class='register-form'>
    <h3>会員登録</h3>
    <form class='login-info' method='post' action='/register'>
        @csrf
        <div class='name_input'>
            <input name='name' type='text' placeholder='名前' value="{{ old('name')}}">
        </div>
        <div class="form__error">
            @error('name')
                {{ $message }}
            @enderror
        </div>
        <div class='email_input'>
            <input name='email' type='email' placeholder='メールアドレス' value="{{ old('email')}}">
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
        <div class='password_confirmation_input'>
            <input name='password_confirmation' type='password' placeholder='確認用パスワード'>
        </div>
        <div class="form_error">
            @error('password_confirmation')
                {{ $message }}
            @enderror
        </div> 
        <div>
            <button type='submit'>会員登録</button>
        </div>        
    </form>
    <div>
        <p>アカウントをお持ちの方はこちら</p>
        <a href='/login'>ログイン</a>
    </div>
</div>
@endsection