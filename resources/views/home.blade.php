@extends('layouts.master')

@section('title', 'Главная')

@section('content')
    @dd(request()->session()->all())
@endsection