@extends('web.common.base')

@section('title', '首页')

@section('css')
@endsection

@section('contents')
    <div class="flex-center position-ref full-height">
        {{--@if (Route::has('login'))--}}
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/logout') }}">Logout</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
                <a href="{{ url('/password/reset') }}">Reset</a>
            @endif
        </div>
        {{--@endif--}}

        <div class="content">
            首页{{ !is_null(Auth::user()) ? Auth::user()->name : ''  }}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function(){
            alert(1111);
        })
    </script>
@endsection
