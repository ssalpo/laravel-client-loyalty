<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Services\Toast;
use Illuminate\Http\Request;
use Appstract\Options\Option;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Option::pluck('value', 'key');

        return inertia('Settings/Edit', compact('setting'));
    }

    public function update(SettingRequest $request)
    {
        option($request->validated());

        Toast::success('Настройки успешно обновлены.');

        return back();
    }
}
