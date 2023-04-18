<?php

namespace App\Notifications;

use App\Models\Exam;
use App\Models\ExamDate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CourseRegisterNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Exam $exam, ExamDate $examDate, User $user)
    {
        $this->exam = $exam;
        $this->examDate = $examDate;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('Podkarpacki Oddział PTMSiZP - potwierdzenie zapisu na kurs')
            ->greeting('Witaj '. $this->user->name.',')
            ->line(new HtmlString('poniżej przesyłamy potwierdzenie zapisu na kurs: <b>' . $this->exam->name . '</b>.<br>'))
            ->line(new HtmlString('<table class="table"><tr><td>Nazwa kursu:</td><td>'.$this->exam->name.'</td></tr><tr><td>Data rozpoczęcia:</td><td>'.$this->examDate->start.'</td></tr><tr><td>Data zakończenia:</td><td>'.$this->examDate->end.'</td></tr></table>'))
            ->salutation(new HtmlString('<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation"><tr><td>'.Markdown::parse('To jest wiadomość automatyczna, nie odpowiadaj na tego maila. Jeśli masz jakiekolwiek pytania napisz do nas: admin@zdrowiepubliczne-rzeszow.pl').'</td></tr></table>'));
    }
}
