@extends('layouts.master')

@section('title', 'Регистрация')

@section('content')
<div class="row">
    <div class="col-sm-9 col-lg-6 col-xl-4 mx-auto">
        <div class="card card--custom card--dark">
            <h3>Регистрация</h3>
            <form method="POST" action="{{ route('auth.signup') }}" class="mt-4" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email">Email<span class="text-danger">*</span></label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           value="{{ old('email') ?: '' }}">

                    @if ($errors->has('email'))
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name">Имя фамилия<span class="text-danger">*</span></label>
                    <input type="text"
                           name="name" 
                           id="name"
                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                           value="{{ old('name') ?: '' }}">

                    @if ($errors->has('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Пароль<span class="text-danger">*</span></label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">

                    @if ($errors->has('password'))
                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    {!! NoCaptcha::display() !!}
                    {!! NoCaptcha::renderJs() !!}
                </div>
                
                <button type="submit" class="btn btn-dark w-100 mb-2">Зарегистрироваться <i class="fas fa-user-tie ml-2"></i></button>

                <span>Есть аккаунт ? <a href="{{ route('auth.signin') }}">Войти.</a></span>
            </form>
        </div>
    </div>
</div>
@endsection