<!DOCTYPE html>
@extends('layouts.appAdmin')
@section('desktop')

    <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @elseif($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="pull-left">
            <h1>مدیریت کاربران</h1>
            <br>
            <h2> تعداد کل پیامک های ارسال شده : {{ $sms_counts }}</h2>
            <h2> تعداد کل پیامک های ارسال شده از نوع ۱ : {{ $sms_1_counts }}</h2>
            <h2> تعداد کل پیامک های ارسال شده از نوع ۲ : {{ $sms_2_counts }}</h2>
            <h2> تعداد کل پیامک های ارسال شده از نوع ۳ : {{ $sms_3_counts }}</h2>
        </div>

        <form action="{{ route('user_index') }}" method="GET" enctype="multipart/form-data">
            {{--                @csrf--}}
            <div class="col-lg-12 margin-tb">
                <div>
                    <h4>جستجو : </h4>
                </div>
                <div class="pull-left mb-2">
                    <input type="text" name="cell_number" placeholder="شماره همراه " class="form-control"
                           style="border-style: solid; background-color: white">
                    @error('cell_number')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="pull-left mb-2">
                    <input type="text" name="user_id" placeholder="user_id" class="form-control"
                           style="border-style: solid; background-color: white; margin-right: 3px">
                    @error('user_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary ml-3" style="border: 12px; margin-right: 10px">جستجو
                </button>


            </div>

        </form>

    </div>

    <form method="POST">
        @csrf
        <div class="col-lg margin-tb">

            <table class="table table-bordered">
                <tr>
                    <th>user_id</th>
                    <th>state کنونی</th>
                    <th>اسم کوچک</th>
                    <th>تلفن همراه</th>
                    <th>ایمیل</th>
                    <th>مجموع sms های ارسال شده</th>
                    <th>تعداد sms ارسال شده نوع یک</th>
                    <th>تعداد sms ارسال شده نوع دو</th>
                    <th>تعداد sms ارسال شده نوع سه</th>

                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->state }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->cell_number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->total_sms_count }}</td>
                        <td>{{ $user->type_1_sms_count }}</td>
                        <td>{{ $user->type_2_sms_count }}</td>
                        <td>{{ $user->type_3_sms_count }}</td>
                    </tr>
                @endforeach
            </table>
            {!! $users->links() !!}
        </div>
    </form>

@endsection('desktop')

