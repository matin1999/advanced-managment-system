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

        <form action="{{ route('assets_search') }}" method="GET" enctype="multipart/form-data">
            <div class="col-lg-12 margin-tb">
                <div>
                    <h4>جستجو : </h4>
                </div>
                <div class="pull-left mb-2">
                    <input type="text" name="user_id" placeholder="user_id" class="form-control"
                           style="border-style: solid; background-color: white">
                    @error('user_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="pull-left mb-2">
                    <input type="number" name="currency_id" placeholder="currency_id" class="form-control"
                           style="border-style: solid; background-color: white; margin-right: 3px">
                    @error('currency_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary ml-3" style="border: 12px; margin-right: 10px">جستجو
                </button>


            </div>

        </form>

            <div class="col-lg margin-tb">

                <table class="table table-bordered">
                    <tr>
                        <th>user_id</th>
                        <th>currency_id</th>
                        <th>balance</th>
                        <th>average_price</th>
                        <th>identified_profit</th>
                        <th>today_identified_profit</th>
                        <th>last_identified_profit</th>

                    </tr>
                    @foreach ($assets as $asset)
                        <tr>
                            <td>{{ $asset->user_id }}</td>
                            <td>{{ $asset->currency_id }}</td>
                            <td>{{ $asset->balance }}</td>
                            <td>{{ $asset->average_price }}</td>
                            <td>{{ $asset->identified_profit }}</td>
                            <td>{{ $asset->today_identified_profit }}</td>
                            <td>{{ $asset->last_identified_profit }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('assets_edit',$asset->id)}}"> ویرایش </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

    </div>

@endsection('desktop')