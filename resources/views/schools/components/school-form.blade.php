<div class="row gx-3 gy-3 mb-3 mt-1">
    <div class="col-12 col-md-6">
        <label for="city" class="form-label">Município: <span class="text-danger">*</span></label>
        <select
            class="form-select"
            id="city" name="city"
            aria-label="Município"
            @if (isset($school) && $school->exists) disabled @endif
        >
            <option value="" disabled @selected(old('city') === null && empty($school->city) ?? true)>
                Selecione um município:
            </option>
            <option value="Lagarto" @selected(old('city') === 'Lagarto' || (!old('city') && ($school->city ?? '') === 'Lagarto'))>Lagarto</option>
            <option value="Poço Verde" @selected(old('city') === 'Poço Verde' || (!old('city') && ($school->city ?? '') === 'Poço Verde'))>Poço Verde</option>
            <option value="Riachão do Dantas" @selected(old('city') == 'Riachão do Dantas' || (!old('city') && ($school->city ?? '') === 'Riachão do Dantas'))>Riachão do Dantas</option>
            <option value="Simão Dias" @selected(old('city') === 'Simão Dias' || (!old('city') && ($school->city ?? '') === 'Simão Dias'))>Simão Dias</option>
            <option value="Tobias Barreto" @selected(old('city') === 'Tobias Barreto' || (!old('city') && ($school->city ?? '') === 'Tobias Barreto'))>Tobias Barreto</option>
        </select>

        @if (isset($school) && $school->exists)
            <input type="hidden" name="city" value="{{ old('city', $school->city) }}">
        @endif

        @error('city')
                <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-6">
        <label for="name" class="form-label">Nome: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Colégio Estadual Sílvio Romero" value="{{ old('name', $school->name ?? '')}}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row gx-3 gy-3 mb-3">
    <div class="col-12 col-md-6">
        <label for="inep" class="form-label">Código MEC: <span class="text-danger">*</span></label>
        <input
            type="text"
            class="form-control"
            id="inep"
            name="inep"
            placeholder="28011082"
            value="{{ old('inep', $school->inep ?? '') }}"
            @if($school->exists) disabled @endif
        >

        @if($school->exists)
            <input type="hidden" name="inep" value="{{ $school->inep }}">
        @endif

        @error('inep')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-6">
        <label for="cnpj" class="form-label">CNPJ: <span class="text-danger">*</span></label>
        <input
            type="text"
            class="form-control"
            id="cnpj"
            name="cnpj"
            placeholder="01.904.246/0001-50"
            value="{{ old('cnpj', $school->cnpj ?? '') }}"
            @if($school->exists && $school->cnpj) disabled @endif
        >

        @if($school->exists && $school->cnpj)
            <input type="hidden" name="cnpj" value="{{ $school->cnpj }}">
        @endif

        @error('cnpj')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row gx-3 gy-3 mb-3">
    <div class="col-12 col-md-6">
        <label for="email" class="form-label">E-mail: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="email" name="email" placeholder="cesr.seed@seduc.se.gov.br" value="{{ old('email', $school->email ?? '') }}">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-6">
        <label for="phone" class="form-label">Telefone: </label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="(79) 3631-4300" value="{{ old('phone', $school->phone) }}">
        @error('phone')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="col-12">
    <label for="address" class="form-label">Endereço: <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Av. Coronel Francisco Garcez" value="{{ old('address', $school->address ?? '') }}">
    @error('address')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="row gx-3 gy-3 mb-3 mt-1">
    <div class="col-12 col-md-6 mt-3 mb-3">
        <label class="form-label">Possui laboratório de informática? <span class="text-danger">*</span></label>

        <div class="d-flex gap-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" id="lab_yes" name="has_lab" value="1" @checked(old('has_lab', $school->has_lab ?? 1) == 1)>
                <label class="form-check-label" for="lab_yes">Sim</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" id="lab_no" name="has_lab" value="0" @checked(old('has_lab', $school->has_lab ?? 1) == 0)>
                <label class="form-check-label" for="lab_no">Não</label>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 mb-3">
        <label class="form-label">Possui sala de recursos? <span class="text-danger">*</span></label>

        <div class="d-flex gap-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" id="room_yes" name="has_resource_room" value="1" @checked(old('has_resource_room', $school->has_resource_room ?? 1) == 1)>
                <label class="form-check-label" for="room_yes">Sim</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" id="room_no" name="has_resource_room" value="0" @checked(old('has_resource_room', $school->has_resource_room ?? 1) == 0)>
                <label class="form-check-label" for="room_no">Não</label>
            </div>
        </div>
    </div>
</div>
