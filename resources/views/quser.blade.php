@extends('layout.default')
@section('title', 'User Profile')
@section('content')
    <x-alert />



    <div class="row">
        <div class="col-md-3">
            @if ($quser->profile_photo_path)
                <img src="{{ asset("images/profile_photo/$quser->profile_photo_path") }}" width="100%">
            @else
            @endif

            <p><b> @lang('User Name') :</b>{{ $quser->name }} {{ $quser->last_name }}</p>
            <p><b>@lang('Email') :</b>{{ $quser->email }}</p>
            <p><b>@lang('city') :</b>{{ $quser->city }}</p>



            @auth
                @if ($quser->id === Auth::user()->id)
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('user.edit') }}" class="btn btn-outline-dark">@lang('Edit') </a>
                            </div>
                            <form method="post" action="{{ route('logout') }}" class="delete-form">
                                @csrf

                                <button type="submit" class="btn btn-sm btn-danger"> @lang('logout')</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth

        </div>





        <div class="col-md-9" style="text-align: center">

            @foreach ($quser->questions as $question)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Title :<a href="{{ route('questions.show', $question->id) }}"
                                style="text-decoration: none"> {{ $question->title }} </a></h5>
                        <div class="text-muted mb-4">Asked Since : {{ $question->created_at->format('d/m/y H:i A ') }} ,By
                            {{ $question->user->name }} , Answers : {{ $question->answers()->count() }} , Qusetion Status
                            : {{ $question->status }} to answer</div>

                        <p class="card-text"> description :{{ $question->description }}</p>
                        @if ($question->img != null)
                            <div class="card-body ">
                                <img src="{{ asset("images/$question->img") }}" width="100%">
                            </div>
                        @endif


                    </div>



                </div>
            @endforeach

        </div>

    </div>




    <x-jq />



@endsection
