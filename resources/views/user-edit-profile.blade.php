@extends('layout.default')
@section('title','Edit Profile')
@section('content')
 <x-alert />

         <div class="row">
             <div class="col-md-3">
                               <img src="{{ asset("images/profile_photo/$user->profile_photo_path") }}" class="img-fluid">
            </div>
            <div class="col-md-9">
<div class="col-md-9">
<form method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
    @method('put')
    @csrf
             <div class="form-group mb-3">
                   <label for="title">Name</label>
                      <div>
                         <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"   value="{{old('name',$user->name )}}">
                            @error('name')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                     </div>
              </div>


                         <select class="form-select" aria-label="Default select example" name="city">
                              <option selected>select country</option>
                              @foreach ( $citys as $city=> $name)
                            <option value="{{ $city }}" name="city"> {{ $name }}</option>
                            @endforeach
                        </select>



               <div class="form-group mb-3">
                   <label for="title">last_name</label>
                      <div>
                         <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"   value="{{old('last_name',$user->last_name )}}">
                            @error('last_name')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                     </div>
              </div>

              <div class="form-group mb-3">
                   <label for="title">Email</label>
                      <div>
                         <textarea type="text" class="form-control @error('email') is-invalid @enderror" name="email" >{{old('email',$user->email )}}</textarea>
                            @error('email')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                     </div>
              </div>
              <div class="form-group mb-3">
                   <label for="profile_photo">Photo</label>
                      <div>
                         <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" name="profile_photo"  >
                            @error('profile_photo')
                             <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                     </div>
              </div>




        <div class="form-group">
            <button type="submit" class="btn btn-primary mt-3"> Save Updated</button>
        </div>
</form>
</div>
 </div>
         </div>




@endsection
