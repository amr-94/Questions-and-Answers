@extends('layout.default')
@section('title', "All User")
@section('content')

<x-alert />




        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>image</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>city</th>
                    <th>type</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>

             @foreach ($user as $user )

                <tr>
                    <td>{{ $user->id }}</td>
                    <td> <img src="{{ asset("images/profile_photo/$user->profile_photo_path") }}" width="50" height="50" class="rounded-circle"> </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ $user->type }}</td>
                    <td>{{ $user->created_at }}</td>
                     <td>{{ $user->updated_at }}</td>

                          <td>
                            <form method="post" action="{{ route('user.change',$user->id) }}">
                                @method('put')
                                @csrf
                          <select class="form-select" aria-label="Default select example" name="type">
                               <option selected>select type</option>
                            <option value="admin"> Admin </option>
                            <option value="user"> user </option>
                            <option value="super-admin"> super-admin </option>
                           </select>
                             <button type="submit" class="btn btn-primary mt-3"> Save </button>
                            </form>
                          </td>
                          {{-- --------------------------------------------------------------------------------------------- --}}


                   <td>   <form action="{{ route('user.delete',$user->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" >Delete </button>
                    </form>
                    </td>



                </tr>
                 @endforeach
            </tbody>

        </table>

            <x-jq />


@endsection
