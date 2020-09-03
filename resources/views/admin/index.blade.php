@extends('layouts.master')

@section('title', 'Сообщения')

@section('content')
<div class="row">
    <div class="col">
        <h2 class="text-center text-uppercase">Сообщения</h2>
        <nav class="mt-4">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Не просмотренные ({{ $unviewedFeedbacks->count() }})</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Просмотренные ({{ $viewedFeedbacks->count() }})</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Тема</th>
                            <th scope="col">Отправитель</th>
                            <th scope="col">Email</th>
                            <th scope="col">Файл</th>
                            <th scope="col">Дата отправки</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unviewedFeedbacks as $feedback)
                            <tr>
                                <th scope="row">{{ $feedback->id }}</th>
                                <td>{{ $feedback->subject }}</td>
                                <td>{{ $feedback->user->name }}</td>
                                <td>{{ $feedback->user->email }}</td>
                                <td><a href="{{ Storage::url($feedback->file) }}" download="message #{{ $feedback->id }}">cкачать</a></td>
                                <td>{{ $feedback->created_at }}</td>
                                <td>
                                    <div class="row no-gutters justify-content-center">
                                        <div class="col-auto mx-2">
                                            <a href="{{ route('feedback.show', $feedback) }}" role="button" class="btn btn-dark"><i class="far fa-eye"></i></a>
                                        </div>
                                        <div class="col-auto mx-2">
                                            <form method="POST" action="{{ route('feedback.view', $feedback) }}">
                                                @csrf

                                                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-auto mx-2">
                                            <form method="POST" action="{{ route('feedback.destroy', $feedback) }}">
                                                @csrf

                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table class="table mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Тема</th>
                            <th scope="col">Отправитель</th>
                            <th scope="col">Email</th>
                            <th scope="col">Файл</th>
                            <th scope="col">Дата отправки</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewedFeedbacks as $feedback)
                            <tr>
                                <th scope="row">{{ $feedback->id }}</th>
                                <td>{{ $feedback->subject }}</td>
                                <td>{{ $feedback->user->name }}</td>
                                <td>{{ $feedback->user->email }}</td>
                                <td><a href="{{ Storage::url($feedback->file) }}" download="message #{{ $feedback->id }}">cкачать</a></td>
                                <td>{{ $feedback->created_at }}</td>
                                <td>
                                    <div class="row no-gutters justify-content-center">
                                        <div class="col-auto mx-2">
                                            <a href="{{ route('feedback.show', $feedback) }}" role="button" class="btn btn-dark"><i class="far fa-eye"></i></a>
                                        </div>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection