
@extends('layout.default')
@section('title','Edit Tag')


@section('content')





        @include('tags._form',[
            'action' => '/tags/'. $tagid->id,
            // ----------------------------
            'update' => true
        ])
    </div>


@endsection
