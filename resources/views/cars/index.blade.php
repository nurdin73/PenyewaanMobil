@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <span>My Cars</span>
                <a href="{{ route('cars.create') }}" class="btn btn-primary">New Car</a>
              </div>
              <div class="card-body">
                <form action="{{ route('cars.index') }}" method="get">
                  <div class="row">
                    <div class="col-md-8">
                      <input type="text" placeholder="search" value="{{ $search }}" name="search" class="form-control">
                    </div>
                    <div class="col-md-2">
                      <select name="is_rent" id="" class="form-select">
                        <option value="">All</option>
                        <option value="true" @selected($isRent == 'true')>Available</option>
                        <option value="false" @selected($isRent == 'false')>Not Available</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <button class="btn d-block btn-primary w-100">Filter</button>
                    </div>
                  </div>
                </form>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Merk</th>
                      <th>Model</th>
                      <th>No Plat</th>
                      <th>Price Rent</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cars as $car)
                      <tr>
                        <td>{{ $car->merk }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->no_plat }}</td>
                        <td>{{ $car->price_rent_by_day }}</td>
                        <td>@if ($car->is_rent) Not Available @else Available @endif</td>
                        <td class="d-flex">
                          <a href="{{ route('cars.edit', ['car' => $car->id]) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                          <form action="{{ route('cars.destroy', ['car' => $car->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {!! $cars->links() !!}
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
