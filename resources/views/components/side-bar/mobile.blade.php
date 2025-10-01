<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Gestão de Atendimentos</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <ul class="nav nav-pills flex-column mb-auto">
            @include('components.side-bar.pending-schools')

            <li class="nav-item">
                @include('components.side-bar.schools', ['id' => 'schoolsMenuMobile'])
                <div class="collapse" id="schoolsMenuMobile">
                    @include('components.side-bar.create-list-school')
                </div>
            </li>

            <li class="nav-item">
                @include('components.side-bar.services', ['id' => 'servicesMenuMobile'])
                <div class="collapse" id="servicesMenuMobile">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-4">
                        @include('components.side-bar.create-list-service')
                    </ul>
                </div>
            </li>

            @if(auth()->user()->isAdmin())
            <li class="nav-item">
                @include('components.side-bar.users', ['id' => 'usersMenuMobile'])
                <div class="collapse" id="usersMenuMobile">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-4">
                        @include('components.side-bar.create-list-user')
                    </ul>
                </div>
            </li>
            @endif
        </ul>
        @include('components.side-bar.user-menu')
    </div>
</div>
