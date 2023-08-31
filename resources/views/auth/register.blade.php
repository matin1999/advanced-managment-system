<!DOCTYPE html>
<html lang="en" style="min-height: 100%; background-color: #15140f">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title></title>
    <style>
        body{
            background-color: #15140f;
        }
    </style>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
            </div>
        </div>
    </div>
    @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <ul class="mt-3 list-disc list-inside text-sm text-red-600" style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{route('loginUser')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row" style="text-align: center">
            <div class="col-xs-12 col-sm-12 col-md-12" style="color: floralwhite">
                <div class="card-title">ورود به داشبورد</div>
                <br>
                <br>
                <form class="simple_form new_admin" id="new_admin" novalidate="novalidate" action="{{ route('loginUser') }}" accept-charset="UTF-8" method="POST">
                    <input name="utf8" type="hidden" value="✓">
                    @csrf
                    <div class="form-inputs">
                        <div class="form-group email optional admin_email">
                            <label class="form-control-label email optional" for="admin_email">آدرس رایانامه</label>
                            <input class="form-control string email optional ltr" autofocus="autofocus" type="email" value="{{old('email')}}" name="email" id="admin_email">
                        </div>
                        <div class="form-group email optional admin_email">
                            <label class="form-control-label email optional" for="admin_email">نام</label>
                            <input class="form-control string email optional ltr" autofocus="autofocus" type="email" value="{{old('first_name')}}" name="email" id="admin_email">
                        </div>
                        <div class="form-group email optional admin_email">
                            <label class="form-control-label email optional" for="admin_email">نام خانوادگی</label>
                            <input class="form-control string email optional ltr" autofocus="autofocus" type="email" value="{{old('last_name')}}" name="email" id="admin_email">
                        </div>
                        <div class="form-group password optional admin_password">
                            <label class="form-control-label password optional" for="admin_password">کلمهٔ رمز</label>
                            <input class="form-control password optional ltr" type="password" name="password" id="admin_password">
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" name="commit" value="ایجاد به حساب کاربری" class="btn btn btn-block btn-success mt-6" data-disable-with="ایجاد به حساب کاربری">
                    </div>
                    <br>
                    <div class="form-actions">
                        <a class="btn btn-block btn-danger" href="{{route('home')}}">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </form>
</div>
</body>
</html>
