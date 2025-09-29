<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Exibe todos os usuários cadastrados de forma paginada.
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Exibe a view de cadastro de um novo usuário.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('users.create', [
            'user' => new User()
        ]);
    }

    /**
     * Exibe a view de atualização de um usuário existente.
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Cadastra um novo usuário no banco de dados.
     * Utiliza transação para garantir integridade dos dados.
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);
        $request->validated();

        DB::beginTransaction();

        try {
            User::create([
                'type' => $request->type,
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);

            DB::commit();

            return redirect()->route('user-index')
                ->with('success', 'Usuário cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('user-index')
                ->with('error', 'Ocorreu um erro ao tentar cadastrar o usuário!');
        }
    }

    /**
     * Atualiza os dados de um usuário existente.
     * Utiliza transação para garantir integridade dos dados.
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $data = [
                'name' => $validated['name'],
                'username' => $validated['username'],
            ];

            if (Auth::user()->isAdmin() && isset($validated['type'])) {
                $data['type'] = $validated['type'];
            }

            if (!empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            $user->update($data);

            DB::commit();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('user-index')
                    ->with('success', 'Usuário atualizado com sucesso!');
            }

            return redirect()->route('schools-pending')
                ->with('success', 'Dados atualizados com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('user-index')
                    ->with('error', 'Ocorreu um erro ao tentar atualizar os dados!');
            }

            return redirect()->route('schools-pending')
                ->with('error', 'Ocorreu um erro ao tentar atualizar os dados!');
        }
    }

    /**
     * Remove um usuário específico do banco de dados.
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        try {
            $user->delete();
            return redirect()->route('user-index')
                ->with('success', 'Usuário removido com sucesso!');
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return redirect()->route('user-index')
                    ->with('error', 'O usuário não pode ser removido, pois existem atendimentos vinculados a ele!');
            }
            return redirect()->route('user-index')
                ->with('error', 'Ocorreu um erro ao tentar remover o usuário!');
        }
    }
}
