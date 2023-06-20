<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, DatesFormatable;

    protected $fillable = [
        'name',
        'phone',
        'birthday',
    ];

    protected $casts = [
        'birthday' => 'date'
    ];

    protected $appends = [
        'birthday_formatted',
        'created_at_formatted'
    ];

    public function getBirthdayFormattedAttribute()
    {
        return $this->birthday?->format('d-m-Y');
    }
}
