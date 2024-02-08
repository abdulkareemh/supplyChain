@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
<div class="row">
<div class="card">
        <h5 class="card-header">Light Table head</h5>
        <div class="table-responsive text-nowrap">
            <table class="table  mb-5">
                <thead class="table-light">
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>city</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($clients as $client)
                    <tr class="clientRow{{$client -> id}}">

                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$client->name}}</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$client->email}}</strong></td>

                        <td>{{$client->phone}}</td>
                        <td>{{$client->city}}</td>
                        <td>
                            <span class="badge
                                    @if($client->status == 'active')
                                        bg-label-primary
                                    @elseif($client->status == 'pending')
                                        bg-label-warning
                                    @else
                                        bg-label-info
                                    @endif
                                    me-1">{{$client->status}}</span>
                        </td>
                        <td>
                        <button type="button" data-client-id="{{$client->id}}" class="active-button btn btn-success">active</button>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="result"></div>
@endsection


<script>
        // jQuery script to change text on document ready
        $(document).ready(function() {
            $('.active-button').on('click', function() {
                var clientId = $(this).data('client-id');
            $.ajax({
                url: '/active-client', // Replace with your route URL
                type: 'POST',
                dataType: 'json',
                data: {
                    id: clientId, // Add any data you want to send to the server
                    _token: '{{ csrf_token() }}' // Add CSRF token for security
                },
                success: function (response) {
                    // Handle the response
                    
                    if(response.status == true){
                        $('#result').text('Ajax request successful: ' + response.message);
                    }
                    $('.clientRow'+response.id).remove();
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });
        });
    </script>

