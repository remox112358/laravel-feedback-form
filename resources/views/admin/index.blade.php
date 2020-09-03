@extends('layouts.master')

@section('title', 'Сообщения')

@section('content')
<div class="row">
    <div class="col">
        <h2 class="text-center text-uppercase">Сообщения</h2>
        <nav class="mt-4">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Не прочитанные</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Прочитанные</a>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unviewedFeedbacks as $feedback)
                            <tr>
                                <th scope="row">{{ $feedback->id }}</th>
                                <td>{{ $feedback->subject }}</td>
                                <td>{{ $feedback->user->name }}</td>
                                <td>{{ $feedback->user->email }}</td>
                                <td><a href="#">cкачать</a></td>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewedFeedbacks as $feedback)
                            <tr>
                                <th scope="row">{{ $feedback->id }}</th>
                                <td>{{ $feedback->subject }}</td>
                                <td>{{ $feedback->user->name }}</td>
                                <td>{{ $feedback->user->email }}</td>
                                <td><a href="#">cкачать</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection