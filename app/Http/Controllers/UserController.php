<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Toast;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        public UserService $userService
    )
    {
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')
            ->get();

        return inertia('Users/Index', compact('users'));
    }

    public function create()
    {
        return inertia('Users/Edit');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->userService->store($request->validated());

        Toast::success('Пользователь успешно добавлен.');

        return to_route('users.index');
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return inertia('Users/Edit', compact('user'));
    }

    public function update(UserRequest $request, int $id)
    {
        $this->userService->update($id, $request->validated());

        Toast::success('Данные пользователя успешно обновлены.');

        return to_route('users.index');
    }

    public function destroy(int $id)
    {
        $user = $this->userService->delete($id);

        Toast::success(sprintf('Пользователь %s успешно удален.', $user->name));
    }
}
