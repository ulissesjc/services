<div class="table-responsive">
    <table class="table table-striped mt-2">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Username</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->type === 'admin' ? 'Administrador' : 'Comum'  }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <x-buttons.edit :route="route('user-edit', $user)" />
                            <x-buttons.delete :route="route('user-destroy', $user)" />
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
