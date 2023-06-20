<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    private function transformCollection($items)
    {
        return $items->transform(fn($m) => [
            'id' => $m->id,
            'text' => $m->name
        ]);
    }
}
