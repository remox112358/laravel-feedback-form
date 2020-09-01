@extends('layouts.master')

@section('title', 'Главная')

@section('content')
    @dump(request()->session()->all())
@endsection