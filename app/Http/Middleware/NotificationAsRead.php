<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $notify_id =$request->query('notify_id');
        if($notify_id && Auth::check()){
             $user = Auth::user();
            $notifications= $user->notifications()->find($notify_id);
           if($notifications && $notifications->unread()){
                $notifications->markAsread();

           }
        }
        return $next($request);
    }
}
