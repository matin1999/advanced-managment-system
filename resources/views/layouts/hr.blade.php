@extends('layouts.desktop')

@section('sidebar')
    <div class="sidebar-top big-img">
        <div class="user-image cursor-pointer">
            <img src="{{ asset('img/logo-coin.png') }}" class="img-responsive img-circle flip animatex"
                 alt="friend 8">
        </div>
    </div>
    <ul class="nav nav-sidebar">


        <li>
            <a href="{{route('hr_panel.jobvacancy.list')}}">
                <i class="sidebar-icon flaticon-dashboard"></i>
                <span>موقعیت های شغلی</span>
            </a>
        </li>
        <li>
            <a href="{{route('hr_panel.jobtype.list')}}">
                <i class="sidebar-icon flaticon-dashboard"></i>
                <span>دسته بندی</span>
            </a>
        </li>

        <li>
            <a href="{{route('hr_panel.degree.list')}}">
                <i class="sidebar-icon flaticon-dashboard"></i>
                <span>مقاطع تحصیلی </span>
            </a>
        </li>

    </ul>
@endsection
