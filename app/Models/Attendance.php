<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
      protected $fillable = [
        'user_id',
        'event_id',
        'attendance_time',
    ];

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }


    public static function initializeAttendanceForEvent($eventId)
    {
        $users = User::all();

        foreach ($users as $user) {
            self::create([
                'user_id' => $user->id,
                'event_id' => $eventId,
                'attendance_time' => null,
            ]);
        }
    }
}
