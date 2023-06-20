<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointTransactionRequest;
use App\Models\PointTransaction;
use App\Services\PointTransactionService;
use App\Services\Toast;
use Illuminate\Http\Request;

class PointTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pointTransactions = PointTransaction::with('client')
            ->orderBy('created_at', 'DESC')
            ->paginate();

        return inertia('PointTransactions/Index', compact('pointTransactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('PointTransactions/Edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PointTransactionRequest $request, PointTransactionService $service)
    {
        $service->store($request->validated());

        Toast::success('Бонусы успешно использованы.');

        return to_route('dashboard.index');
    }

    public function edit(string $id)
    {
        $pointTransaction = PointTransaction::findOrFail($id);

        return inertia('PointTransactions/Edit', compact('pointTransaction'));
    }

    public function update(PointTransactionRequest $request, string $id, PointTransactionService $service)
    {
        $service->update($id, $request->validated());

        Toast::success('Транзакция успешно изменена');

        return to_route('point-transactions.index');
    }

    public function destroy(string $id, PointTransactionService $service)
    {
        $service->destroy($id);

        Toast::success('Транзакция успешно удалена.');

        return to_route('point-transactions.index');
    }
}
