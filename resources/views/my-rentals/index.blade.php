@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Rental Lists</h1>
    @if (session('status'))
      <div class="alert alert-info">
          {{ session('status') }}
      </div>
    @endif
    @if (session('error'))
      <div class="alert alert-error">
          {{ session('error') }}
      </div>
    @endif
    <div class="row">
      @foreach ($rents as $rent)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    @if ($rent->history?->status === 'RETURNED')
                    <div class="badge bg-success">{{ $rent->history?->status }}</div>
                    @else
                    <div class="badge bg-primary">{{ $rent->history?->status }}</div>
                    @endif
                    <h3>{{ $rent->car?->merk }}</h3>
                    <p>{{ $rent->car?->model }}</p>
                    <p>{{ \Carbon\Carbon::parse($rent->start_date)->format('Y-m-d') }} to {{ \Carbon\Carbon::parse($rent->end_date)->format('Y-m-d') }}</p>
                    <p>{{ number_format($rent->amount) }}</p>
                    @if ($rent->history?->status == 'RENT')
                      <form action="{{ route('my-rentals.update', ['my_rental' => $rent->id]) }}" method="post">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-success w-100">Return</button>
                      </form>
                    @endif
                </div>
            </div>
        </div>
      @endforeach
    </div>
</div>
@endsection
