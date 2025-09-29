<script>
    document.addEventListener('DOMContentLoaded', function () {
    var modalDelete = document.getElementById('modalDelete');

    modalDelete.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var url = button.getAttribute('data-action-url');

        var form = modalDelete.querySelector('#formDelete');
        form.action = url;
    });
});
</script>
