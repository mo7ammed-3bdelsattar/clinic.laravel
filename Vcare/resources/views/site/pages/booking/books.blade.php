@extends('site.app')
@section('title','Bookings')
@section('content')
@include('site.layouts.header')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="{{route("home.index")}}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 details-card">
        <h2 class="text-center">Your Bookings</h2>
        @if($books->isEmpty())
            <p class="text-center">No book found.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">book Date</th>
                        <th scope="col">Time Slot</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            {{-- @dd($book) --}}
                            <td>{{ $book->doctor->user->name }}</td>
                            <td>{{ \App\Enums\DaysEnum::from($book->appointment->date)->label() }}</td>
                            <td>{{ $book->appointment->start_at }} - {{ $book->appointment->end_at }}</td>
                            <td>{{ $book->status }}</td>
                            <td>
                                <form action="{{ route('booking.cancel', $book->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif  
    </div>
</div>

@endsection