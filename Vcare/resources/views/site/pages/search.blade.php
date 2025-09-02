@extends('site.app')
@section('title','Search')

@section('content')
@include('site.layouts.header')

<div class="container my-4">
  <div class="position-relative" id="search-wrapper">
    <input type="text" id="search" class="form-control" placeholder="search...">
    <ul id="suggestions" 
        class="list-group position-absolute w-100 d-none" 
        style="top:100%; left:0; max-height:260px; overflow:auto; z-index:1050;">
    </ul>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('search').addEventListener('input', function () {
    let q = this.value;
    if (q.length < 2) { 
        document.getElementById('suggestions').innerHTML = ""; 
        document.getElementById('suggestions').classList.add('d-none'); 
        return; 
    }

    fetch(`{{ route('search.suggestions') }}?query=${encodeURIComponent(q)}`)
        .then(res => res.json())
        .then(data => {
            let sug = document.getElementById('suggestions');
            sug.innerHTML = "";
            data.forEach(item => sug.innerHTML += `<a href='{{ route('doctors.show','') }}/${item.id}' class="list-group-item">${item.name}</a>`);
            sug.classList.remove('d-none');
        });
});
</script>
@endpush

