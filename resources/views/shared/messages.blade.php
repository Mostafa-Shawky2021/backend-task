@if (session()->has('message'))
    <div class="alert alert-{{ session('message')[0] }} alert-dismissible fade show" role="alert">
        {{ session('message')[1] }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
