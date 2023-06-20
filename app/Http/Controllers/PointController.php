<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointRequest;
use App\Models\Point;
use App\Services\PointService;
use App\Services\Toast;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function index()
    {
        $points = Point::with('client')
            ->orderBy('created_at', 'DESC')
            ->paginate();

        return inertia('Points/Index', compact('points'));
    }

    public function create()
    {
        $defaultPercent = option('default_percent');

        return inertia('Points/Edit', compact('defaultPercent'));
    }

    public function store(PointRequest $request, PointService $pointService)
    {
        $pointService->store($request->validated());

        Toast::success('Бонус успешно начислен.');

        return to_route('dashboard.index');
    }

    public function edit(Point $point)
    {
        $defaultPercent = option('default_percent');

        return inertia('Points/Edit', compact('point', 'defaultPercent'));
    }

    public function update(int $id, PointRequest $request, PointService $pointService)
    {
        $pointService->update($id, $request->validated());

        Toast::success('Данные успешно обновлены.');

        return to_route('points.index');
    }

    public function destroy(int $id, PointService $pointService)
    {
        $pointService->destroy($id);

        Toast::success('Успешно удалено.');

        return back();
    }
}
