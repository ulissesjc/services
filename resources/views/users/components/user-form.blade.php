<div class="row gx-3 gy-3 mb-3 mt-1">
    <div class="col-12 col-md-4">
        <label for="name" class="form-label">Nome: <span class="text-danger">*</span></label>
        <input type="text"
            class="form-control"
            id="name"
            name="name"
            placeholder="Digite aqui seu nome"
            value="{{old('name', $user->name ?? '')}}"
        >
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-4">
        <label for="username" class="form-label">Username: <span class="text-danger">*</span></label>
        <input type="text"
            class="form-control"
            id="username"
            name="username"
            placeholder="Digite aqui seu usuário"
            value="{{old('username', $user->username ?? '')}}"
        >
        @error('username')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-4">
        @if(auth()->user()->isAdmin())
            <label class="form-label">Tipo: <span class="text-danger">*</span></label><br>
            <div class="d-flex flex-wrap gap-3 mt-2">
                <div class="form-check">
                    <label class="form-check-label" for="admin">Administrador</label>
                    <input class="form-check-input" type="radio" id="admin" name="type" value="admin" @checked(old('type', $user->type ?? 'admin') == 'admin')>
                </div>

                <div class="form-check">
                    <label class="form-check-label" for="common">Comum</label>
                    <input class="form-check-input" type="radio" id="common" name="type" value="common" @checked(old('type', $user->type ?? 'common') == 'common')>
                </div>
            </div>
        @else
            <input type="hidden" name="type" value="{{ $user->type }}">
        @endif
    </div>
</div>

<div class="row gx-3 gy-3 mb-3">
    <div class="col-12 col-md-6">
        <label for="password" class="form-label">Senha: <span class="text-danger">*</span></label>
        <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Digite aqui sua melhor senha"
            value="{{ old('password') }}"
        >
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-6">
        <label for="password_check" class="form-label">Confirmar senha: <span class="text-danger">*</span></label>
        <input type="password"
            class="form-control"
            id="password_check"
            name="password_check"
            placeholder="Digite novamente sua senha"
        >
        @error('password_check')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
