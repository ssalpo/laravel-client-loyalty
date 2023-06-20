<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use App\Services\Toast;

class ClientController extends Controller
{
    public function __construct(
        public ClientService $clientService
    )
    {
    }

    public function index()
    {
        $clients = Client::orderBy('created_at', 'DESC')
            ->paginate()
            ->onEachSide(0);

        return inertia('Clients/Index', compact('clients'));
    }

    public function create()
    {
        return inertia('Clients/Edit');
    }

    public function store(ClientRequest $request)
    {
        $client = $this->clientService->store($request->validated());

        if($request->has('modal')) {
            return response()->json([
                'id' => $client->id,
                'name' => $client->name
            ]);
        }

        Toast::success('Клиент успешно добавлен.');

        return to_route('clients.index');
    }

    public function edit(int $id)
    {
        $client = Client::findOrFail($id);

        return inertia('Clients/Edit', compact('client'));
    }

    public function update(ClientRequest $request, int $id)
    {
        $this->clientService->update($id, $request->validated());

        Toast::success('Данные клиента успешно изменены.');

        return to_route('clients.index');
    }

    public function destroy(int $id)
    {
        $client = $this->clientService->delete($id);

        Toast::success(sprintf('"%s" успешно удален.', $client->name));

        return to_route('clients.index');
    }
}
