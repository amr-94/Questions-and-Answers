@extends('layout.default')
@section('title'){{ $title . ':' }}
<a href="{{ route('tags.create') }}" class="btn btn-outline-dark btn-xs">
            ADD NEW
         </a>
@endsection
@section('content')

<x-alert />



        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>


            <tbody>
                            @foreach ($tags as $tag )

                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td>{{ $tag->created_at }}</td>
                     <td>{{ $tag->updated_at }}</td>
                     @auth
                       @if (Auth::user()->type === 'admin')



                     <td>
                         <button type="submit" class="btn btn-success btn-sm">
                         <a href="{{ route('tags.edit',$tag->id) }}" style="color: white ;text-decoration: none;">Edit </a></button>

                    </td>
                    <td>
                        <form action="{{ route('tags.delete',$tag->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" >Delete </button>
                    </form>
                    </td>
                     @endif


                     @endauth

                </tr>
                 @endforeach
            </tbody>

        </table>
            {{ $tags->links() }}

            <x-jq />

@endsection
