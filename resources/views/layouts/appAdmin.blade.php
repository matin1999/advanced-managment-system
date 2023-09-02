@extends('layouts.desktop')

@section('sidebar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <div class="sidebar-top big-img">
        <div class="user-image cursor-pointer">
            <img src="{{ asset('img/logo-coin.png') }}" class="img-responsive img-circle flip animatex"
                 alt="friend 8">
        </div>
    </div>
    <ul class="nav nav-sidebar">
        <li>
            <a href="#"><i
                    class="sidebar-icon flaticon-dashboard"></i><span>داشبورد مدیر</span>
            </a>
        </li>
{{--        <li>--}}
{{--            <a href="{{route('index_mission')}}"><i class='bi bi-ui-checks'></i><span>مدیریت مأموریت ها</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('index_mission_type')}}"><i class='bi bi-ui-radios'></i><span>مدیریت انواع مأموریت ها</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('assets_search')}}"><i class="bi bi-search"></i><span>جست و جوی دارایی ها</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('index_user_action')}}"><i class="bi bi-cash-coin "></i><span>مدیریت گردش امتیازات</span>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li>--}}
{{--            <a href="{{route('failed_response.index')}}"><i class="bi bi-exclamation-octagon"></i><span>درخواست های ناموفق</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('banner.index')}}"><i class="bi bi-card-image"></i><span>مدیریت بنرها</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('action_types.index')}}"><i--}}
{{--                    class="bi bi-columns-gap"></i><span>رویدادها</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('reward_types.index')}}"><i--}}
{{--                    class="bi bi-award"></i><span>عنوان جایزه</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('rewards.index')}}"><i--}}
{{--                    class="bi bi-award"></i><span>جایزه ها</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('store_types.index')}}"><i--}}
{{--                    class="bi bi-shop-window"></i><span>انواع بازارچه</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('stores.index')}}"><i--}}
{{--                    class="bi bi-shop-window"></i><span>بازارچه ها</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="{{route('winspin.index')}}"><i--}}
{{--                    class="bi bi-fan"></i><span>گردونه ی شانس</span>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
@endsection
