@section('scripts')
<script>
    window.addEventListener('close-modal', (event) => {
        $('#createModal').modal('hide');
    });

    window.addEventListener('close-modal', (event) => {
        $('#editModal').modal('hide');
    });

    Livewire.on('success', data => {
        Swal.fire({
            title: 'Success!!!',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Close'
        })
    });

</script>
@endsection