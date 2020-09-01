@extends('layouts.master')

@section('title', 'Главная')

@section('content')
<div class="row">
    <div class="col-sm-9 col-md-6 mx-auto">
        <div class="card card--custom card--dark">
            <h3>Отправка заявки</h3>
            <form method="POST" action="" class="mt-4" novalidate>

                <div class="form-group">
                    <label for="subject">Тема<span class="text-danger">*</span></label>
                    <input type="text"
                           name="subject" 
                           id="subject"
                           class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" 
                           value="{{ old('subject') ?: '' }}">

                    @if ($errors->has('subject'))
                        <div class="invalid-feedback">{{ $errors->first('subject') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="message">Сообщение<span class="text-danger">*</span></label>
                    <textarea rows="5"
                              name="message" 
                              id="message"
                              class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}">{{ old('message') ?: '' }}</textarea>

                    @if ($errors->has('message'))
                        <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-dark w-100 mb-2">Отправить <i class="fas fa-paper-plane ml-2"></i></button>

            </form>
        </div>
    </div>
</div>
@endsection