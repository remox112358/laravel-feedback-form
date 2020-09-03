@extends('layouts.master')

@section('title', 'Сообщения')

@section('content')
<div class="row">
    <div class="col-lg-9 mx-auto">
        <h3>Сообщение #{{ $feedback->id }}</h3>
        <span>Отправитель: <b>{{ $feedback->user->name }}</b></span>
        <br/>
        <span>Email: <b>{{ $feedback->user->email }}</b></span>
        <br/>
        <span>Дата отправки: <b><time>{{ $feedback->created_at }}</time></b></span>
        <p class="mt-4">{{ $feedback->message }}</p>
        @if ($feedback->hasFile())
            <a href="{{ Storage::url($feedback->file) }}" class="btn btn-outline-dark mt-2" download="message #{{ $feedback->id }}">Скачать файл <i class="fas fa-file-download ml-2"></i></a>
        @endif
        <div class="row justify-content-center">
            @if (! $feedback->isViewed())
                <div class="col-auto mx-2">
                    <form method="POST" action="{{ route('feedback.view', $feedback) }}">
                        @csrf

                        <button type="submit" class="btn btn-outline-success">Отметить <i class="fas fa-check ml-2"></i></button>
                    </form>
                </div>
            @endif
            <div class="col-auto mx-2">
                <form method="POST" action="{{ route('feedback.destroy', $feedback) }}">
                    @csrf

                    <button type="submit" class="btn btn-outline-danger">Удалить <i class="fas fa-trash-alt ml-2"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection