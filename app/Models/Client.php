<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, DatesFormatable, SoftDeletes;

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

    public function getBirthdayFormattedAttribute()
    {
        return $this->birthday?->format('d-m-Y');
    }

    public function points(): HasMany
    {
        return $this->hasMany(Point::class);
    }
}
