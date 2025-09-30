<div class="row gx-3 gy-3 mb-3 mt-2">
    <div class="col-12 col-md-6">
        <label for="city" class="form-label">Município: <span class="text-danger">*</span></label>
        <select
            class="form-select"
            id="city"
            name="city"
            aria-label="Município"
            @if (isset($service)) disabled @endif
        >
            @if(!isset($service))
                <option value="" selected disabled>Selecione um município</option>
                @foreach ($cities as $city)
                    <option value="{{ $city }}" @selected(old('city') == $city)>
                        {{ $city }}
                    </option>
                @endforeach
            @else
                <option value="{{ $service->school->city }}" selected>{{ $service->school->city }}</option>
            @endif
        </select>

        @if(isset($service))
            <input type="hidden" name="city" value="{{ $service->school->city }}">
        @endif

        @error('city')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-6">
        <label for="schoolName" class="form-label">Escola: <span class="text-danger">*</span></label>
        <select
            class="form-select"
            id="schoolName"
            name="school_id"
            aria-label="Escola"
            @if(isset($service)) disabled @endif
        >
            @if(!isset($service))
                <option value="" selected disabled>Selecione uma escola</option>
            @else
                <option value="{{ $service->school_id }}" selected>{{ $service->school->name }}</option>
            @endif
        </select>

        @if(isset($service))
            <input type="hidden" name="school_id" value="{{ $service->school_id }}">
        @endif

        @error('school_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row gx-3 gy-3 mb-3">
    <div class="col-12">
        <label for="description" class="form-label">Descrição: <span class="text-danger">*</span></label>
        <textarea class="form-control" id="description" name="description" placeholder="Foi realizada a instalação de algumas impressoras" rows="4">{{ old('description', $service->description ?? '') }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row gx-3 gy-3 mb-3">

    <div class="col-12 col-md-4">
        <label for="glpi_number_call" class="form-label">N° do chamado GLPI: <span class="text-danger">*</span></label>
        <input
            type="text"
            class="form-control"
            id="glpi_number_call"
            name="glpi_number_call"
            value="{{ old('glpi_number_call', $service->glpi_number_call ?? '') }}"
            @isset($service) disabled @endisset
        >

        @if(isset($service))
            <input type="hidden" name="glpi_number_call" value="{{ $service->glpi_number_call }}">
        @endif

        @error('glpi_number_call')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-4">
        <label for="category" class="form-label">Categoria: <span class="text-danger">*</span></label>
        <select
            class="form-select"
            id="category" name="category"
            aria-label="Categoria"
        >
        <option value="" disabled @selected(!isset($service))>
            Selecione uma categoria
        </option>
        <option value="lab_review"
            @selected(old('category') === 'lab_review' || (isset($service) && $service->category === 'lab_review'))>
            Revisão de Laboratório
        </option>
        <option value="admin_review"
            @selected(old('category') === 'admin_review' || (isset($service) && $service->category === 'admin_review'))>
            Revisão de Administrativo
        </option>
        <option value="net_check"
            @selected(old('category') === 'net_check' || (isset($service) && $service->category === 'net_check'))>
            Verificação de Internet
        </option>
        <option value="others"
            @selected(old('category') === 'others' || (isset($service) && $service->category === 'others'))>
            Outros
        </option>
        </select>
    </div>

    <div class="col-12 col-md-4">
        <label for="date" class="form-label">Data: <span class="text-danger">*</span></label>
        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', isset($service) ? $service->date : now()->format('Y-m-d')) }}">
        @error('date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row gx-3 gy-3 mb-4">
    <label class="form-label">Forma: <span class="text-danger">*</span></label><br>
    <div class="d-flex flex-wrap gap-3 mt-2">
        <div class="form-check">
            <label class="form-check-label" for="in_person">Presencial</label>
            <input class="form-check-input" type="radio" id="in_person" name="mode" value="in_person" @checked(old('mode', $service->mode ?? 'in_person') == 'in_person')>
        </div>

        <div class="form-check">
            <label class="form-check-label" for="remote">Remota</label>
            <input class="form-check-input" type="radio" id="remote" name="mode" value="remote" @checked(old('mode', $service->mode ?? 'in_person') == 'remote')>
        </div>

        <div class="form-check">
            <label class="form-check-label" for="bench">Bancada</label>
            <input class="form-check-input" type="radio" id="bench" name="mode" value="bench" @checked(old('mode', $service->mode ?? 'in_person') == 'bench')>
        </div>
    </div>
</div>
