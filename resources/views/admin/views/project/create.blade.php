@extends('admin/root')

@section('main-bar')

@include('admin/views/project/components/index',['isEdit' => false , 'data' => ''])

@endsection


