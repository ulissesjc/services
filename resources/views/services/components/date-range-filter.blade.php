<div class="bg-white p-4 rounded shadow-sm border mb-3">
    <h4 class="text-lg font-medium mb-3" style="color: ">Pesquisar</h4>

    <form action="{{ route('service-index') }}"  method="GET">
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <label for="city" class="form-label text-muted">Município</label>
                <select class="form-select" id="city" name="city">
                    <option value="" disabled {{!$city ? 'selected' : ''}}>
                        Selecione um município
                    </option>
                    @foreach ($cities as $c)
                        <option value="{{ $c }}" {{ $city == $c ? 'selected' : '' }}>
                            {{ $c }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="schoolName" class="form-label text-muted">Escola</label>
                <select
                    class="form-select"
                    id="schoolName"
                    name="schoolName"
                    data-selected-school-id="{{ request('schoolName') }}"
                >
                    <option value="" disabled {{ !request('schoolName') ? 'selected' : '' }}>
                        Selecione uma escola
                    </option>
                </select>
            </div>
        </div>
        <div class="row g-3 mt-1">
            <div class="col-12 col-md-6">
                <label for="user" class="form-label text-muted">Usuário</label>
                <select class="form-select" id="user" name="user">
                    <option value="" disabled {{!$user ? 'selected' : ''}}>
                        Selecione um usuário
                    </option>
                    @foreach ($users as $u)
                        <option value="{{ $u }}" {{ $user == $u ? 'selected' : '' }}>
                            {{ $u }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-2">
                    <label for="category" class="form-label text-muted">Categoria</label>
                    <select class="form-select" id="category" name="category">
                        <option value="" disabled {{ request('category') == null ? 'selected' : '' }}>Selecione uma categoria de atendimento</option>
                        <option value="lab_review" {{ request('category') == 'lab_review' ? 'selected' : '' }}>Revisão de Laboratório</option>
                        <option value="admin_review" {{ request('category') == 'admin_review' ? 'selected' : '' }}>Revisão de Administrativo</option>
                        <option value="net_check" {{ request('category') == 'net_check' ? 'selected' : '' }}>Verificação de Internet</option>
                        <option value="others" {{ request('category') == 'others' ? 'selected' : '' }}>Outros</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row g-3 mt-1">
            <div class="col-12 col-md-4">
                <label for="type" class="form-label text-muted">Tipo</label>
                <select class="form-select" id="type" name="type">
                    <option value="" disabled {{ request('type') == null ? 'selected' : '' }}>Selecione um tipo de atendimento</option>
                    <option value="in_person" {{ request('type') == 'in_person' ? 'selected' : '' }}>Presencial</option>
                    <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Remoto</option>
                    <option value="bench" {{ request('type') == 'bench' ? 'selected' : '' }}>Bancada</option>
                </select>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-2">
                    <label for="start_date" class="form-label text-muted">Data inicial </label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $start_date }}">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-2">
                    <label for="end_date" class="form-label text-muted">Data final </label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $end_date }}">
                </div>
            </div>
            <div class="d-flex gap-3 mt-3">
                <button
                    type="submit"
                    class="btn btn-primary d-flex align-items-center gap-2"
                >
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Pesquisar
                </button>
                <a href="{{ route('service-index') }}"
                    class="btn btn-light"
                >
                    Limpar
                </a>
            </div>
        </div>
    </form>
</div>
