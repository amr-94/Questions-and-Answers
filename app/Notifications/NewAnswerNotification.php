<?php

namespace App\Notifications;

use App\Models\Questions;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAnswerNotification extends Notification
{
    protected $questions;
    protected $user ;
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(questions $questions , User $user)
    {
        //
        $this->questions = $questions;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // notification channel : mail , database , nexmo (sms), brodcast
    public function via($notifiable)
    {
        $channels = ['database','mail'];
        // if (in_array('mail' , $notifiable->notification_options)){
        //     $channels[] = 'mail' ;
        // }
        // if (in_array('sms' , $notifiable->notification_options)){
        //     // $channel []= 'nexmo';

        // }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)

            ->subject('A New Answer Added ')
            ->from('example@test.com')
            ->greeting("hello {$notifiable->name}")
            ->from('example@test.com')
            ->line(__(':user has added answer to your questions ":questions"', [
                'user' => $this->user->name,
                'questions' => $this->questions->title
            ]))
            ->action('view Answer', url(route('questions.show', $this->questions->id)))
            ->line('Thank you for using our application!');


    }





    public function toDatabase($notifiable){
       return [
                 'title' => 'New Answer Added ',
                 'body'=>  __(':user has added answer to your questions ":questions"',[
                      'user' =>$this->user->name ,
                          'questions' => $this->questions->title,
                 ]),
                 'image'=>'',
                 'url' => route('questions.show',$this->questions->id),
                 'user'  =>  $this->user->name ,
       ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
