<?php

namespace App\Models\Traits;

trait CurrentUser
{
    public function scopeMy($q, $field = 'user_id')
    {
        return $q->where($field, auth()->id());
    }

    public function scopeMyCompany($q, $field = 'company_id')
    {
        return $q->where($field, auth()->user()->company_id);
    }
}
