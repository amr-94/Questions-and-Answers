
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $message)
        <li> {{ $message }}</li>

        @endforeach
    </ul>
</div>

@endif


 <form action="{{ $action }}" method="post">
     @csrf
     @if ($update)
      @method('put')
      @endif
            <div class="form-group mb-4">
                <label for="name">Tag name:</label>

                <div>

                    <input type="text" name="name" value= "{{old('name',$tagid->name )}} " class="form-control mt-3 @error('name')

                     is-invalid" @enderror>

                </div>

                @error('name')
                <P class="text-danger"> {{ $message }}</P>

                @enderror


            </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Save </button>
                </div>
        </form>
    </div>
