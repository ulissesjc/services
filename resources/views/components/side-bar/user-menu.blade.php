<hr>
    <div class="text-white d-flex align-items-center">
        <i class="fa-solid fa-user me-2"></i>
        @auth
            <span class="me-auto">{{ Illuminate\Support\Str::limit(auth()->user()->username, 10) }}</span>
            @include('components.side-bar.buttons.config', ['user' => auth()->user()])
            @include('components.side-bar.buttons.logout')
        @endauth
    </div>
