@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <form action="{{ route('cars.update', ['car' => $car->id]) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group mb-2">
                  <label for="merk" class="form-label">Merk</label>
                  <input type="text" name="merk" value="{{ old('merk') ?? $car->merk }}" class="form-control @error('merk') is-invalid @enderror">
                  @error('merk')
                      <span class="form-error text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mb-2">
                  <label for="model" class="form-label">Model</label>
                  <input type="text" name="model" value="{{ old('model') ?? $car->model }}" class="form-control @error('model') is-invalid @enderror">
                  @error('model')
                      <span class="form-error text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mb-2">
                  <label for="no_plat" class="form-label">Nomor Plat</label>
                  <input type="text" name="no_plat" value="{{ old('no_plat') ?? $car->no_plat }}" class="form-control @error('no_plat') is-invalid @enderror">
                  @error('no_plat')
                      <span class="form-error text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mb-2">
                  <label for="price_rent_by_day" class="form-label">Price Rent Per Day</label>
                  <input type="text" name="price_rent_by_day" value="{{ old('price_rent_by_day') ?? $car->price_rent_by_day }}" class="form-control @error('price_rent_by_day') is-invalid @enderror">
                  @error('price_rent_by_day')
                      <span class="form-error text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <button class="btn btn-primary" type="submit">Save Car</button>
                <a href="{{ route('cars.index') }}" class="btn btn-light">Cancel</a>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
