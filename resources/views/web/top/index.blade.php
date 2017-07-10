@extends('web.common.base')

@section('title', '首页')

@section('css')

@endsection

@section('content')
    <div class="top-right links">
        @if (Auth::check())
            <a href="{{ url('/home') }}">Home</a>
            <a href="{{ url('/logout') }}">Logout</a>
        @else
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        @endif
    </div>
@endsection
