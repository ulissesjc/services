document.addEventListener('DOMContentLoaded', function() {
    const modalDescription = document.getElementById('modalDescription');

    if (modalDescription) {
        modalDescription.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const description = button.getAttribute('data-description');
            const modalBody = modalDescription.querySelector('#description');

            if (modalBody) {
                modalBody.textContent = description;
            }
        });
    }
});


