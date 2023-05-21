<?php

namespace App\Notifications;

use App\Models\Exam;
use App\Models\ExamDateUser;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class UserGrantedAccess extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(bool $active, User $user, ExamDateUser $examDateUser)
    {
        $this->active = $active;
        $this->user = $user;
        $this->examDateUser = $examDateUser;
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
        $exam = Exam::find($this->examDateUser->exam_id);
        $status = match ($this->active) {
            false => '<span style="color:#b61010;font-weight: bold">został wyłączony</span>',
            default => '<span style="color:darkgreen;font-weight: bold">został włączony</span>',
        };

        return (new MailMessage)
            ->subject('Podkarpacki Oddział PTMSiZP - dostęp do kursu')
            ->greeting('Witaj '. $this->user->name.',')
            ->line(new HtmlString('Twój dostęp do kursu: ' . $exam->name . ' '.$status.'.<br><br>'))
            ->salutation(new HtmlString('<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation"><tr><td>'.Markdown::parse('To jest wiadomość automatyczna, nie odpowiadaj na tego maila. Jeśli masz jakiekolwiek pytania, napisz do nas: admin@zdrowiepubliczne-rzeszow.pl').'</td></tr></table>'));
    }
}
