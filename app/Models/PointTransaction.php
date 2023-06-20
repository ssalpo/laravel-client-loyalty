<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointTransaction extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = [
        'client_id',
        'amount',
        'sell_amount'
    ];

    protected $appends = [
        'created_at_formatted'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
}
