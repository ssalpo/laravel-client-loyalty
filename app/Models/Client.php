<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory, Notifiable, DatesFormatable, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'birthday',
        'total_points'
    ];

    protected $casts = [
        'birthday' => 'date',
        'total_points' => 'double'
    ];

    protected $appends = [
        'birthday_formatted',
        'created_at_formatted'
    ];

    public function scopeHasTodayBirthday($q): void
    {
        $date = Carbon::now();

        $q->whereMonth('birthday', $date->format('m'))
            ->whereDay('birthday', $date->format('d'));
    }

    public function getBirthdayFormattedAttribute()
    {
        return $this->birthday?->format('d-m-Y');
    }

    public function points(): HasMany
    {
        return $this->hasMany(Point::class);
    }

    public function pointTransactions(): HasMany
    {
        return $this->hasMany(PointTransaction::class);
    }
}
