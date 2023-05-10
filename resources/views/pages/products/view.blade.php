@extends('layouts.app')

@section('content')
    <view-product :data="{{$data->toJson()}}"></view-product>
@endsection