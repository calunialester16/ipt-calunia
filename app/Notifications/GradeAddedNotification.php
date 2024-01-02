<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GradeAddedNotification extends Notification
{
    use Queueable;

    protected $student;
    protected $grade;

    /**
     * Create a new notification instance.
     */
    public function __construct($student, $grade)
    {
        $this->student = $student;
        $this->grade = $grade;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->line('A grade has been added for ' . $this->student->name)
        ->line('Subject: ' . $this->grade->subject)
        ->line('Score: ' . $this->grade->score)
        ->action('View Student', route('students.show', $this->student))
        ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
