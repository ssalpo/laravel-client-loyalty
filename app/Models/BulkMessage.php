<?php

namespace App\Models;

use App\Models\Traits\DatesFormatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BulkMessage extends Model
{
    use HasFactory, SoftDeletes, DatesFormatable;

    protected $fillable = [
        'title',
        'content',
        'total_received',
        'status'
    ];

    protected $appends = [
        'created_at_formatted'
    ];

    public const STATUS_DRAFT = 1;
    public const STATUS_SENDING = 2;
    public const STATUS_SEND_ERROR = 3;
    public const STATUS_CANCELED = 4;

    public const STATUS_LABELS = [
        self::STATUS_DRAFT => 'Черновик',
        self::STATUS_SENDING => 'Отправляется',
        self::STATUS_SEND_ERROR => 'Ошибка отправки',
        self::STATUS_CANCELED => 'Отменен',
    ];

    public const STATUS_BADGE_COLORS = [
        self::STATUS_DRAFT => 'bg-azure',
        self::STATUS_SENDING => 'bg-success',
        self::STATUS_SEND_ERROR => 'bg-red',
        self::STATUS_CANCELED => 'bg-red',
    ];
}
