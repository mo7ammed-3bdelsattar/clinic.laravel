@if (session()->has('errors'))
    <div class="alert alert-danger text-center">
        {{ session('errors') }}
    </div>
@endif