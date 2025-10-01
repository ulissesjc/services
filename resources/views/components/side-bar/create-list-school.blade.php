<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-4">
    @if(auth()->user()->isAdmin())
        <li>
            <a href="{{ route('school-create') }}" class="nav-link text-white">
                <i class="fa-solid fa-plus"></i>
                Cadastrar
            </a>
        </li>
    @endif
    <li>
        <a href="{{ route('school-index') }}" class="nav-link text-white">
            <i class="fa-solid fa-list"></i>
            Listar
        </a>
    </li>
</ul>
