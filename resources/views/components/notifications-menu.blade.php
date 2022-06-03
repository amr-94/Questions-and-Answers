
<div class="ms-2 dropdown text-end">
                       <a href="" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                              <span class="badge bg-danger">  {{ $user->unreadnotifications()->count() }} </span> UnReadNotification
                         </a>

                    <ul class="dropdown-menu " aria-labelledby="notifications" >
                            @foreach ($notifications as $notifications )
                                   @if ($notifications->unread())
                                  <li><a class="dropdown-item" href="{{ $notifications->data['url'] }}?notify_id={{ $notifications->id }}" style="text-decoration: none;color: red">
                                      <h6 class="">{{ $notifications->data['title'] }}</h6>
                                       <p class="">{{ $notifications->data['body'] }}</p>
                                         <p class="text-muted">{{ $notifications->created_at->diffForhumans() }}</p></a></li>
                                                  @endif
                               @endforeach

                              <li>  <a  class="dropdown-item text-muted" href="{{ route('notifications') }}" style="text-decoration: none">All notifications</a></li>

                                @if ($user->unreadnotifications()->count()  == 0)
                                            <p class="" style="color: rgb(10, 97, 10)">no Unreaded notification </p>  @endif

      </ul>

</div>
