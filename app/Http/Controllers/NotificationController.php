<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();



        // $note = Auth::user()
        // ->unreadNotifications
        // ->where('id', $request->get('id'))
        // ->first();

        // if ($note) {
        //     $note->markAsRead();
        // }



        return view('notifications', [
            'notifications' => $user->notifications,


        ]);
    }
    public function destroy($id)
    {
        $user = Auth::user();
        $notification = $user->notifications->find($id);
        $notification->destroy($id);
        return redirect(route('notifications'))->with('success', 'notifacations deleted');
    }
    public function destroyall()
    {
        $user = Auth::user();
        $notification = $user->notifications();
        $notification->delete();

        return redirect(route('notifications'))->with('success', 'All notifacations are deleted');
    }
}