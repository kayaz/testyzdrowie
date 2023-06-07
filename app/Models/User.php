<?php

namespace App\Models;

use App\Notifications\PasswordResetNotification;
use App\Notifications\UserChangeStatusNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'degree',
        'specialization',
        'practice',
        'pesel',
        'postcode',
        'city',
        'address',
        'phone',
        'email',
        'password',
        'active',
        'type',
        'exam_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function exams()
    {
        return $this->hasManyThrough(
            Exam::class,
            ExamDateUser::class,
            'user_id', // Foreign key on the exam_date_users table
            'id', // Local key on the exams table
            'id', // Local key on the users table
            'exam_date_id' // Foreign key on the exam_date_users table
        );
    }

    public function examDates()
    {
        return $this->hasManyThrough(
            ExamDate::class,
            ExamDateUser::class,
            'user_id', // Foreign key on the exam_date_users table
            'id', // Local key on the exam_dates table
            'id', // Local key on the users table
            'exam_date_id' // Foreign key on the exam_date_users table
        );
    }

    public function examDateUsers()
    {
        return $this->hasMany('App\Models\ExamDateUser', 'user_id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new PasswordResetNotification($token));
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($model) {
            if ($model->isDirty('active')) {
                $active = $model->active;
                $user = User::find($model->id);
                $user->notify(new UserChangeStatusNotification($active, $user));
            }
        });
    }
}
