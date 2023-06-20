<?php

namespace App\Models\Traits;

trait DatesFormatable
{
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at?->format('d-m-Y H:i');
    }

    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at?->format('d-m-Y H:i');
    }
}
