<td>
    <a href="{{ route('asignaciones.edit', $id) }}" class="mx-1">
        <span class="material-icons">edit</span>
    </a>

    <a href="{{ route('asignacion.pdf', $id) }}" target="_blank" class="mx-1">
        <span class="material-icons">print</span>
    </a>

    <form action="{{ route('asignaciones.destroy', $id) }}" method="POST" class="d-inline delete-form">
        @csrf
        @method('DELETE')
        <button type="button" class="border-0 bg-transparent p-0 btn-delete">
            <span class="material-icons text-danger">delete</span>
        </button>
    </form>
</td>

<script src="{{ asset('js/sweetalert2.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.btn-delete').on('click', function (e) {
            e.preventDefault();

            let form = $(this).closest('form');

            Swal.fire({
                title: '¿Está seguro?',
                text: "El registro se eliminará permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0dac55',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
