@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Supplier')

@section('content')
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Supplier</h5> <small class="text-muted float-end">Supplier</small>
      </div>
      <div class="card-body">
        <form action="{{ url('/suppliers/' . $supplier->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>

            <!-- Name -->
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="name">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $supplier->name) }}" required maxlength="55" />
              </div>
            </div>

            <!-- Email -->
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="email">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $supplier->email) }}" required maxlength="55" />
              </div>
            </div>

            <!-- Phone -->
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="phone">Phone</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}" required />
              </div>
            </div>

            <!-- Additional fields like 'category', 'commercial_register_number' etc., should be added here -->

            <!-- Commercial Register Image -->
            <!-- <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="commercial_register_image">Commercial Register Image</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" id="commercial_register_image" name="commercial_register_image" required />
              </div>
            </div>

            
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="company_image">Company Image</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" id="company_image" name="company_image" />
              </div>
            </div> -->

            <div class="row justify-content-end">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
