<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>N° do chamado GLPI</th>
                <th>Data</th>
                <th>Categoria</th>
                <th>Tipo</th>
                <th>Município</th>
                <th>Escola</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->user->name }}</td>
                    <td>{{ $service->glpi_number_call }}</td>
                    <td>{{ formateDate($service->date) }}</td>
                    <td>{{ $service->category_label }}</td>
                    <td>{{ $service->type_label }}</td>
                    <td>{{ $service->school->city }}</td>
                    <td>{{ $service->school->name }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            @include('services.components.buttons.description')
                            <x-buttons.edit :route="route('service-edit', $service)" />
                            <x-buttons.delete :route="route('service-destroy', $service)" />
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
