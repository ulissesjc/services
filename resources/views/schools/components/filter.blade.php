<div class="bg-white p-4 rounded shadow-sm border mt-3 mb-3">
    <h4 class="text-lg font-medium mb-3" style="color: ">Pesquisar</h4>

    <form action="{{ route('school-index') }}"  method="GET">
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <label for="city" class="form-label text-muted">Município</label>
                <select class="form-select" id="city" name="city" onchange="this.form.submit()">
                    <option value="" disabled {{ request('city') ? '' : 'selected' }}>
                        Selecione um município
                    </option>
                    <option value="Lagarto" {{ request('city') == 'Lagarto' ? 'selected' : '' }}>Lagarto</option>
                    <option value="Poço Verde" {{ request('city') == 'Poço Verde' ? 'selected' : '' }}>Poço Verde</option>
                    <option value="Riachão do Dantas" {{ request('city') == 'Riachão do Dantas' ? 'selected' : '' }}>Riachão do Dantas</option>
                    <option value="Simão Dias" {{ request('city') == 'Simão Dias' ? 'selected' : '' }}>Simão Dias</option>
                    <option value="Tobias Barreto" {{ request('city') == 'Tobias Barreto' ? 'selected' : '' }}>Tobias Barreto</option>
                </select>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('school-index') }}"
                class="btn btn-light"
            >
                Limpar
            </a>
        </div>
    </form>
</div>
