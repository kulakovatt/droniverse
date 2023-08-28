@extends('layouts.app')

@section('title-page')Droniverse | Личный кабинет@endsection
@section('other-style')
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <link href="{{ asset("css/cart_style.css") }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset("css/admin_style.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .cart_container .cart_items .h2_cont{
            width: 100%;
        }
        .cart_container .cart_items {
            width: 100%;
        }

        .bonus-div{
            display: flex;
            flex-direction: column-reverse;
            gap: 20px;
        }
        @media (max-width: 600px) {
            .bonus-div img{
                width: 90%;
            }
        }
        .div-orders{

            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .div-order{
            min-width: 28%;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
    </style>
@endsection
@section('content')
    @if($role == '1')
        @include('adminPanel')
    @elseif($role == '0')
        @include('userPanel')
    @elseif($role == '2')
        @include('orderManager')
    @endif
@endsection
@section('other-scripts')
    @if(session('alert'))
        <script>alert('{{session('alert')}}')</script>
    @endif
@endsection
