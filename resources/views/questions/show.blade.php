@extends('layout.default')
@section('title')
    Questions <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">Create New</a>
@endsection
@section('content')
    <x-alert />

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $question->title }}</h5>
            <div class="text-muted mb-4">Asked Since : {{ $question->created_at->format('d/m/y H:i A ') }} ,
                <br>question Status : {{ $question->status }} to answer
                <br> By : <a href="{{ route('show.user', $question->user->id) }}"
                    style="text-decoration: none">{{ $question->user->name }} </a>
            </div>
            <p class="card-text">{{ $question->description }}</p>


            @if ($question->img != null)
                <div class="card-body ">
                    <img src="{{ asset("images/q_img/$question->img") }}" width="100%">
                </div>
            @endif

            <div class=""> Tags :
                <ul>
                    @foreach ($question->tags as $tags)
                        <li> {{ $tags->name }}</li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
    <section>
        <h3>{{ $answer->count() }} Answers</h3>


        @forelse  ($answer as $answer)
            <div class="card mb-3">
                <div class="card-body">
                    @if ($answer->best_answer == 1)
                        <div class="card-text" style="color: rgb(7, 224, 0)">
                            Best Answer
                        </div>
                    @endif

                    <p class="card-text">{{ $answer->description }}</p>
                    <div class="text-muted mb-4">Answered Since : {{ $answer->created_at->diffforhumans() }} , By : <a
                            href="{{ route('show.user', $answer->user->id) }}" style="text-decoration: none">
                            {{ $answer->user->name }}</a> </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        @if ($question->user == Auth::user())
                            <form action="{{ route('answers.best', $answer->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-success" type="submit">mark as best answer</button>
                            </form>
                        @endif
                        @auth

                            @if ($answer->user == Auth::user() || auth::user()->type == 'admin')
                                <form action="{{ route('answers.destroy', $answer->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Delete answer</button>
                                </form>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>

        @empty
            <p class="">No Answers ! </p>
        @endforelse
        @guest

            <div class=" md-3">
                <p class="">login or register to answer <a href="{{ route('login') }}"
                        style="text-decoration: none">login</a>
                    <a href="{{ route('register') }}" style="text-decoration: none">Register</a>
                </p>

            </div>
        @endguest



        @auth


            @if ($question->status === 'open')
                <div class="card mb-3">
                    <div class="card-body">

                        <h4> Send Your Answer</h4>
                        <form action="{{ route('answers.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <div class="form-group">
                                <div>
                                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
                                    @error('description')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-3 mb-2"> Add Answer</button>
                            </div>
                        </form>
            @endif

        @endauth
        </div>
        </div>
    </section>

    @auth

        @if ($question->user->id === Auth::id() || Auth::user()->type == 'admin')
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-outline-dark"> Edit </a>
                    </div>
                    <form method="post" action="{{ route('questions.destroy', $question->id) }}" class="delete-form">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger"> Delete</button>
                    </form>
                </div>

            </div>
        @endif
    @endauth


    <x-jq />
@endsection
