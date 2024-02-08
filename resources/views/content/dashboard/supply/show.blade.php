@extends('layouts/contentNavbarLayout')

@section('title', 'Supplier Details')

@section('content')
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Supplier Details</h5> <small class="text-muted float-end">Viewing Supplier</small>
      </div>
      <div class="card-body">
          <!-- Supplier Name -->
          <div class="mb-3">
            <label class="form-label"><strong>Name:</strong></label>
            <p>{{ $supplier->name }}</p>
          </div>

          <!-- Supplier Email -->
          <div class="mb-3">
            <label class="form-label"><strong>Email:</strong></label>
            <p>{{ $supplier->email }}</p>
          </div>

          <!-- Supplier Phone -->
          <div class="mb-3">
            <label class="form-label"><strong>Phone:</strong></label>
            <p>{{ $supplier->phone }}</p>
          </div>

          <!-- Additional details like 'category', 'commercial_register_number' should be added here -->

          <!-- Supplier Commercial Register Image -->
          <!-- Ensure you have a way to retrieve and display the image -->
          <div class="mb-3">
            <label class="form-label"><strong>Commercial Register Image:</strong></label>
            <div>
              <img src="http://localhost:8000/.{{$supplier->commercial_register_image}}" alt="">
            </div>
          </div>

          <!-- Supplier Company Image -->
          <!-- Ensure you have a way to retrieve and display the image -->
          <div class="mb-3">
            <label class="form-label"><strong>Company Image:</strong></label>
            <div>
            <img src="http://localhost:8000/.{{$supplier->company_image}}" alt="">
            </div>
          </div>

          <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-primary">Edit</a>
      </div>
    </div>
  </div>
@endsection
