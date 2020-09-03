@extends('layouts.master')

@section('title', 'Сообщения')

@section('content')
<div class="row">
    <div class="col-lg-9 mx-auto">
        <h3>Сообщение #{{ $feedback->id }}</h3>
        <p class="mt-4">{{ $feedback->message }}</p>
        <a href="#" class="mt-2">скачать прикреплённый файл</a>
        <div class="row justify-content-center">
            @if (! $feedback->isViewed())
                <div class="col-auto mx-2">
                    <form method="POST" action="{{ route('feedback.view', $feedback) }}">
                        @csrf

                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                    </form>
                </div>
            @endif
            <div class="col-auto mx-2">
                <form method="POST" action="{{ route('feedback.destroy', $feedback) }}">
                    @csrf

                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection