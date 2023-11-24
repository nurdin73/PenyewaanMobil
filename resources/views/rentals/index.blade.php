@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Car Rentals</h1>
    <form action="{{ route('rentals.index') }}" method="get" class="mb-4">
        <div class="row">
            <div class="col-md-5">
                <input type="date" name="start_date" value="{{ request()->get('start_date') }}" class="form-control">
            </div>
            <div class="col-md-5">
                <input type="date" name="end_date" value="{{ request()->get('end_date') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100 d-block">Search</button>
            </div>
        </div>
    </form>
    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        @foreach ($cars as $car)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3>{{ $car->merk }}</h3>
                    <p>{{ $car->model }}</p>
                    <p>{{ number_format($car->price_rent_by_day * ($total_day + 1)) }}</p>
                    <form action="{{ route('rentals.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="start_date" value="{{ request()->get('start_date') }}">
                        <input type="hidden" name="end_date" value="{{ request()->get('end_date') }}">
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <input type="hidden" name="amount" value="{{$car->price_rent_by_day * ($total_day + 1)}}">
                        <button type="submit" class="btn btn-primary w-100">Order</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
