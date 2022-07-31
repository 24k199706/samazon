@extends('layouts.dashboard');

@section('content');
<div class='container'>
    <div class='crow justify-content-center'>
        <div class='col-md-5'>
            <h3 class='mt-3 mb-3'>ログイン</h3>
            @if (session('waring'))
                <div class="alert alert-danger">
                    {{session('waring')}}
                </div>
            @endif
            <hr>
            <form metohd="POST" action="{{route('dashboard.login')}}">
                @csrf
                <div class="form-group">
                    <input id='email' type='email' class='form-control' @error('email') 
                        is-invalid @enderror samuraimart-login-input name="email" value="{{ old('email') }}" required autocomplete="email" 
                        autofocus placeholder="メールアドレス">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>メールが正しくない可能性があります</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id='password' type='password' class='form-control' @error('password') 
                        is-invalid @enderror samuraimart-login-input name="password" 
                        required autocomplete="password" 
                        autofocus placeholder="パスワード">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>パスワードが正しくない可能性があります</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="mt-3 btn samuraimart-submit-button w-100">
                        ログイン
                    </button>
                </div>
            </form>
            <hr>
        </div>
    </div>
</div>



@endsection