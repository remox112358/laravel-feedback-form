@extends('layouts.master')

@section('title', 'Главная')

@section('content')
<div class="row">
    <div class="col-sm-9 col-md-6 mx-auto">
        <div class="card card--custom card--dark">
            <h3>Форма обратной связи</h3>
            @if (Auth::user()->canSend())
                <form method="POST" action="{{ route('feedback.store') }}" class="mt-4" enctype="multipart/form-data" novalidate>
                    @csrf

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
                        <textarea name="message"
                                id="message"
                                class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}">{{ old('message') ?: '' }}</textarea>

                        @if ($errors->has('message'))
                            <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="file">Файл</label>
                        <input name="file"
                            type="file"
                            class="form-control-file {{ $errors->has('file') ? 'is-invalid' : '' }}"
                            id="file">

                        @if ($errors->has('file'))
                            <div class="invalid-feedback">{{ $errors->first('file') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Отправить <i class="fas fa-paper-plane ml-2"></i></button>

                </form>
            @else
                <p class="m-0 mt-2">Вы уже отправляли сообщение.<br/>В следующий раз это будет возможно в <b>{{ Auth::user()->getFeedbackSendEnableTime() }}.</b></p>
            @endif
        </div>
    </div>
</div>
@endsection