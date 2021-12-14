@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show text-center mb-0" role="alert">
        <strong>{{ session()->get('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show text-center mb-0" role="alert">
        <strong>{{ session()->get('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('success-info'))
    <script>
        $.notify("{{ session()->get('success-info') }}", "success");
    </script>
@endif
