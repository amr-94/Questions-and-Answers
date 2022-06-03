@extends('layout.default')
@section('title','notifications')
@section('content')
<x-alert />


<div>
    @foreach ($notifications as $notifications )
    <div class="card my-2">
        <div class="card-body">

         @if ($notifications->unread())
            <a href="{{ $notifications->data['url'] }}?notify_id={{ $notifications->id }}"  style="text-decoration: none;color: red"  >
        @endif
             <h4>{{ $notifications->data['title'] }}</h4> </a>
             <p>{{ $notifications->data['user'] }}</p>
             <p class="text-muted">{{ $notifications->created_at->diffForhumans() }}</p>

        </div>
        <form action="{{ route('notification.destroy',$notifications->id) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <button class="btn btn-danger" type="submit">Delete Notification</button>
                              </form>


    </div>



    @endforeach
</div>
                                  @if ($notifications->count()  !== 0)

                               <form action="{{ route('notification.destroyall') }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <button class="btn btn-primary" type="submit">Clear all Notifications</button>
                              </form>
                                                                @endif


 <x-jq />
@endsection
