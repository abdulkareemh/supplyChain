@extends('layouts/contentNavbarLayout')

@section('title', 'ss ')

@section('content')


  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Basic Layout</h5> <small class="text-muted float-end">Client</small>
      </div>
      <div class="card-body">
        <form action="{{url('/clients')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" placeholder="John Doe" name="name" />
            </div>
          </div>
          <div class="mb-3 row">
          <label for="html5-date-input" class="col-md-2 col-form-label">Phone</label>
          <div class="col-md-10">
            <input class="form-control" type="string" id="html5-date-input" name="phone">
          </div>
        </div>
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" name="email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-default-email2" />
                <span class="input-group-text" id="basic-default-email2">@example.com</span>
              </div>
              <div class="form-text"> You can use letters, numbers & periods </div>
            </div>
          </div>
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">password</label>
            <div class="col-sm-10">
            <input type="pasword" id="basic-default-phone" name="password" class="form-control phone-mask"  />
         </div>
          </div>

          <div class="mb-3 row">
              <label for="html5-date-input" class="col-md-2 col-form-label">city</label>
              <div class="col-md-10">
                  <input class="form-control" type="string" id="html5-date-input" name="city">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="html5-date-input" class="col-md-2 col-form-label">regien</label>
                <div class="col-md-10">
                    <input class="form-control" type="string" id="html5-date-input" name="regien">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="html5-date-input" class="col-md-2 col-form-label">street</label>
                <div class="col-md-10">
                    <input class="form-control" type="string" id="html5-date-input" name="street">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="html5-date-input" class="col-md-2 col-form-label">description</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" id="html5-date-input" name="description">
                </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-sm-10">
                <input type="submit" class="btn btn-primary" value="submit"/>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection