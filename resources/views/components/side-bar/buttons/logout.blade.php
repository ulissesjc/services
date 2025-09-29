<form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button
            type="submit"
            class="btn btn-link p-0 border-0 ms-2"
            style="background: none; color: white"
        >
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </button>
</form>

