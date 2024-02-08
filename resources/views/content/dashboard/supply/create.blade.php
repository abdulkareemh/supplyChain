@extends('layouts/contentNavbarLayout')

@section('title', 'Supplier Registration')

@section('content')
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Supplier Registration</h5> <small class="text-muted float-end">Supplier</small>
      </div>
      <div class="card-body">
        <form action="{{ url('/suppliers') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>

          <!-- Name -->
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" placeholder="Name" name="name" />
            </div>
          </div>

          <!-- Email -->
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="basic-default-email" placeholder="Email" name="email" />
            </div>
          </div>

          <!-- Phone -->
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-phone">Phone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-phone" placeholder="Phone" name="phone" />
            </div>
          </div>

          <!-- Category -->
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-category">Category</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-category" placeholder="Category" name="category" />
            </div>
          </div>

          <!-- Commercial Register Number -->
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-cr-number">Commercial Register Number</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-cr-number" placeholder="Commercial Register Number" name="commercial_register_number" />
            </div>
          </div>

          <!-- Password -->
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-password">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="basic-default-password" placeholder="Password" name="password" />
            </div>
          </div>

          <!-- Commercial Register Image -->
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-cr-image">Commercial Register Image</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="basic-default-cr-image" name="commercial_register_image" />
            </div>
          </div>

          <!-- Company Image -->
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company-image">Company Image</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="basic-default-company-image" name="company_image" />
            </div>
          </div>

          <!-- Submit Button -->
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
