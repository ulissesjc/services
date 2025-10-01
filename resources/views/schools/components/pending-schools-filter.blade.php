<div class="bg-white p-4 rounded shadow-sm border mb-4">
    <h4 className="text-lg font-medium mb-3" style="color: #0d6efd">Pesquisar</h4>

    <form action="{{ route('schools-pending') }}" method="GET">
        <div class="row">
            <div class="col-6 col-md-4">
                <label for="months" class="form-label text-muted mt-2">Meses</label>
                <select class="form-select" id="months" name="months" onchange="this.form.submit()">
                    <option value="" disabled {{ request('months') == null ? 'selected' : '' }}>Selecione a quantidade de meses</option>
                    <option value="3" {{ request('months', '3') == '3' ? 'selected' : '' }}>3 meses</option>
                    <option value="6" {{ request('months') == '6' ? 'selected' : '' }}>6 meses</option>
                    <option value="9" {{ request('months') == '9' ? 'selected' : '' }}>9 meses</option>
                    <option value="12" {{ request('months') == '12' ? 'selected' : '' }}>12 meses</option>
                </select>
            </div>
        </div>
    </form>
</div>
