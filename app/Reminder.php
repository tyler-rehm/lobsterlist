<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = ['notes', 'date', 'time', 'contact_id'];

    public function status()
    {
        return $this->hasOne('App\ReminderStatus', 'id', 'reminder_status_id');
    }

}
