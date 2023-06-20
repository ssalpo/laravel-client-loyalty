<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = [
        'client_id',
        'amount',
        'sell_amount',
        'percent',
    ];

    protected $casts = [
        'amount' => 'double',
        'sell_amount' => 'double',
        'percent' => 'double',
    ];

    protected $appends = [
        'created_at_formatted'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
}
