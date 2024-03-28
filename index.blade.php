@extends('layout.default')
@section('title')
               {{ trans('Questions')}}
<a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">{{ __('Create New') }}</a>
@endsection
@section('content')

<x-alert />

@foreach ($questions as $question )
<div class="card mb-3">
  <div class="card-body">
      <h5 class="card-title"><a style="text-decoration: none;" href="{{ route('questions.show', $question->id)}}">{{ $question->title }}</a></h5>
        <div class="text-muted mb-4">
            Asked Since : {{ $question->created_at->format('d/m/y H:i A ')  }} ,
           {{ __('Question Status') }} : {{ $question->status }}  ,
            Answers : {{ $question->answers_count }}
           <br>
           @lang('by') : <a href="{{ route('show.user',$question->user->id) }}" style="text-decoration: none;"> {{ $question->user->email }} </a>,</div>

             <div class="text-muted mb-3" >Updated Since : {{ $question->updated_at->diffForHumans()  }} </div>
             {{ __(' tags ')}} :
           @foreach ( $question->tags as $tag )
                  {{ $tag->name }}
             @endforeach




        <p class="card-text">description :  {{ $question->description }}</p>


  </div>
                @if ($question->img != null)
                  <div class="card-body ">
                      <img src="{{ asset("images/$question->img") }}" width="100%">
                 </div>
                @endif

  @auth

   @if ($question->user->id === Auth::id() || Auth::user()->type == 'admin')



      <div class="card-footer">
           <div class="d-flex justify-content-between">
               <div>
                   <a href="{{ route('questions.edit',$question->id) }}" class="btn btn-outline-dark"> @lang('Edit') </a>
               </div>
                   <form method="post" action="{{ route('questions.destroy',$question->id) }}" class="delete-form">
                       @csrf
                       @method('delete')
                       <button type="submit" class="btn btn-sm btn-danger">@lang('Delete')</button>
                   </form>
            </div>

       </div>
        @endif
       @endauth

</div>

@endforeach
{{ $questions->withQueryString()->links() }}


    <x-jq />
@endsection

