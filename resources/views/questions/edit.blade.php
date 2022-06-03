@extends('layout.default')
@section('title','Edit Question')
@section('content')

<form method="post" action="{{ route('questions.update',$question->id) }}" enctype="multipart/form-data">
    @method('put')
    @csrf
             <div class="form-group">
                   <label for="title">Title</label>
                      <div>
                         <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"   value="{{old('title',$question->title )}}">
                            @error('title')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                     </div>
              </div>

              <div class="form-group">
                   <label for="title">Description</label>
                      <div>
                         <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" >{{old('description',$question->description )}}</textarea>
                            @error('description')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                     </div>
              </div>


              <select class="form-select" aria-label="Default select example" name="status" >
                              <option selected>select status</option>
                            <option value="open" > open</option>
                            <option value="close" > close</option>
                </select>



           <div class="form-group">
                   <label for="title">img</label>
                      <div>
                         <input type="file" class="form-control @error('q_img') is-invalid @enderror" name="q_img">
                            @error('q_img')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                     </div>
              </div>

              <label for=""> Select Tags
                   @foreach ($tags as $tags )
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $tags->id }}" name="tags[]" id="{{ $tags->id }}" @if (in_array($tags->id, $question_tag))checked @endif>
                           @error('tags')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

                    <label class="form-check-label" for="{{ $tags->id }}">{{ $tags->name }} </label>
                </div>

                @endforeach
               </label>

        <div class="form-group">
            <button type="submit" class="btn btn-primary mt-3"> Save </button>
        </div>
</form>
@endsection
