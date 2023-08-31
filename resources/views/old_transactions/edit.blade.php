<!DOCTYPE html>
@extends('layouts.appAdmin')
@section('desktop')
    <div class="container mt-2">
        @if($message = \Illuminate\Support\Facades\Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if($message = \Illuminate\Support\Facades\Session::get('error'))
            <div class="alert alert-error">
                <p>{{$message}}</p>
            </div>
        @endif
        <form action="{{ route('assets_update', $asset->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="balance" class="form-label">balance</label>
                        <input type="number" name="balance" class="form-control" value="{{$asset->balance}}">
                        @error('balance')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="average_price" class="form-label">average_price</label>
                        <input type="text" name="average_price" class="form-control" value="{{ $asset->average_price }}">
                        @error('average_price')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="identified_profit" class="form-label">identified_profit</label>
                        <input type="number" name="identified_profit" id="identified_profit" class="form-control" value="{{$asset->identified_profit}}">
                        @error('identified_profit')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="today_identified_profit" class="form-label">today_identified_profit</label>
                        <input type="number" name="today_identified_profit" id="today_identified_profit" class="form-control"
                               value="{{ $asset->today_identified_profit }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="last_identified_profit" class="form-label">last_identified_profit</label>
                        <input type="number" name="last_identified_profit" class="form-control" value="{{$asset->last_identified_profit}}">
                        @error('last_identified_profit')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="last_average_price" class="form-label">last_average_price</label>
                        <input type="number" name="last_average_price" class="form-control" value="{{$asset->last_average_price}}">
                        @error('last_average_price')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </form>
    </div>
@endsection('desktop')
