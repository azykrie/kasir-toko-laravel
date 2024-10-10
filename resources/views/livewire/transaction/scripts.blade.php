@section('scripts')
<script>
    Livewire.on('success', data => {
        Swal.fire({
            title: 'Success!!!',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Close'
        })
    });

    document.addEventListener('livewire:load', function () {
            // Listener untuk event 'invoiceGenerated'
            Livewire.on('invoiceGenerated', invoiceUrl => {
                // Membuat link sementara untuk mengunduh file
                const link = document.createElement('a');
                link.href = invoiceUrl;
                link.download = 'invoice.pdf'; // Nama file yang akan diunduh
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
</script>
@endsection