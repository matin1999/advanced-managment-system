<!DOCTYPE html>

@extends('layouts.appAdmin')
@section('desktop')
    <html lang="en" style="min-height: 100%; background-color: #15140f">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body {
                background-color: #15140f;
            }
        </style>
    </head>
    <body>
       <h4> You are logged in successfully</h4>

    <div>
        <a class="btn btn-primary" href="{{ route('loginUser')}}">Logout</a>
    </div>
    </body>
    </html>
@endsection('desktop')
