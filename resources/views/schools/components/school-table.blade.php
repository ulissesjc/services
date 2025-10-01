<div class="table-responsive">
    <table class="table table-striped mt-2">
        <thead>
            <tr>
                <th>Município</th>
                <th>Nome</th>
                <th>Código MEC</th>
                <th>Possui laboratório?</th>
                <th>Possui sala de recursos?</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schools as $school)
                <tr>
                    <td>{{ $school->city }}</td>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->inep }}</td>
                    <td>{{ $school->has_lab ? 'Sim' : 'Não' }}</td>
                    <td>{{ $school->has_resource_room ? 'Sim' : 'Não' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            @include('schools.components.buttons.show')

                            @can('update', $school)
                                <x-buttons.edit :route="route('school-edit', $school)" />
                            @endcan

                            @can('delete', $school)
                                <x-buttons.delete :route="route('school-destroy', $school)" />
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
