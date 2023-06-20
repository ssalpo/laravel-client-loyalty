<?php

namespace App\Http\Controllers;

use App\Models\Client;

class AutocompleteController extends Controller
{
    public function clients()
    {
        return Client::withSum('points', 'amount')->when(
            request('q'),
            static fn($q, $v) => $q->where('name', 'like', '%' . $v . '%')
                ->orWhere('phone', 'like', '%' . $v . '%')
        )->get()
            ->transform(
                fn($m) => [
                    'id' => $m->id,
                    'text' => sprintf('%s (%s б.)', $m->name, number_format($m->total_points, 2)),
                ]
            );
    }

    private function transformCollection($items)
    {
        return $items->transform(fn($m) => [
            'id' => $m->id,
            'text' => $m->name
        ]);
    }
}
