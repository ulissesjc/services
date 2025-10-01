<div class="d-none d-md-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-5 fw-bold mb-1">Gestão de Atendimentos</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        @include('components.side-bar.pending-schools')

        <li class="nav-item">
            @include('components.side-bar.schools', ['id' => 'schoolsMenu'])
            <div class="collapse" id="schoolsMenu">
                @include('components.side-bar.create-list-school')
            </div>
        </li>

        <li class="nav-item">
            @include('components.side-bar.services', ['id' => 'servicesMenu'])
            <div class="collapse" id="servicesMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-4">
                    @include('components.side-bar.create-list-service')
                </ul>
            </div>
        </li>

        @if(auth()->user()->isAdmin())
        <li class="nav-item">
            @include('components.side-bar.users', ['id' => 'usersMenu'])
            <div class="collapse" id="usersMenu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-4">
                    @include('components.side-bar.create-list-user')
                </ul>
            </div>
        </li>
        @endif

    </ul>
    @include('components.side-bar.user-menu')

</div>
