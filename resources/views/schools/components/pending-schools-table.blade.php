<div class="table-responsive">
    <table class="table table-striped mt-2">
        <thead>
            <tr>
                <th>Nome da escola</th>
                <th>Município</th>
                <th>Último atendimento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schools as $school)
                <tr>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->city }}</td>
                    <td>{{ $school->last_service_date ? formateDate($school->last_service_date) : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
