<script>
    function showToast(message, type) {

        const toastHTML = `
            <div class="toast align-items-center text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            `;

        const container = document.getElementById("toast-container");
        const tempDiv = document.createElement("div");
        tempDiv.innerHTML = toastHTML;
        const toastElement = tempDiv.firstElementChild;
        container.appendChild(toastElement);

        const bsToast = new bootstrap.Toast(toastElement);
        bsToast.show();

        toastElement.addEventListener('hidden.bs.toast', () => {
            toastElement.remove();
        });
    }

    @if(session('success') || session('error'))
        document.addEventListener("DOMContentLoaded", function() {
            const message = @json(session('success') ?? session('error'));
            const type = "{{ session('success') ? 'success' : 'danger' }}";
            showToast(message, type);
        });
    @endif
</script>


