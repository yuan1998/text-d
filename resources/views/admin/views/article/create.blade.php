@extends('admin/root')

@section('main-bar')

@include('admin/views/article/components/index',['isEdit' => false , 'data' => ''])

@endsection


