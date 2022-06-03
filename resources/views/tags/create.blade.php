
@extends('layout.default')
@section('title')
            Create New Tag
       @endsection
@section('content')


        @include('tags._form',[
            'action' => '/tags ',
            'update' =>false
        ])


@endsection
