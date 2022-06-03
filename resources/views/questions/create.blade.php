@extends('layout.default')
@section('title','Add New Question')
@section('content')

<form method="post" action="{{ route('questions.store') }}" enctype="multipart/form-data">
    @csrf
             <div class="form-group">
                   <label for="title">Title</label>
                      <div>
                         <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
                            @error('title')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                     </div>
              </div>

              <div class="form-group">
                   <label for="title">Description</label>
                      <div>
                         <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
                            @error('description')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                     </div>
              </div>


               <label for=""> Select Tags
                   @foreach ($tags as $tags )
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $tags->id }}" name="tags[]" id="{{ $tags->id }}">
                    <label class="form-check-label" for="tag-{{ $tags->id  }}">{{ $tags->name }} </label>
                </div>
                @endforeach
               </label>


        <div class="form-group">
            <button type="submit" class="btn btn-primary mt-3"> Add Qusetion</button> </div>
</form>
@endsection
