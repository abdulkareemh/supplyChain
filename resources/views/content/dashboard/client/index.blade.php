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
<div class="">
<a class="btn btn-primary" href="/clients/create" style="color: white;">Create</a>
</div>
<div class="row">
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
    @endif
    <div class="card">
        <h5 class="card-header">Light Table head</h5>
        <!-- <form id="searchForm">
                <input type="text" id="searchInput" name="keyword" placeholder="Search keyword">
            </form> -->
        <div class="table-responsive text-nowrap">
            <table class="table  mb-5" id="clientsTable">
                <thead class="table-light">
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>number of orders</th>
                        <th>city</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($clients as $client)
                    <tr>

                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$client->name}}</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$client->email}}</strong></td>

                        <td>{{$client->phone}}</td>
                        <td>{{$client->number_of_orders}}</td>
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
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('clients/'.$client -> id.'/edit')}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="@if($client->status == 'ban'){{route('client.reActive',$client -> id)}} @else {{route('client.ban',$client -> id)}} @endif"><i class="bx bx-trash me-1"></i> @if($client->status == 'ban')Active @else Ban @endif</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            <div id="paginathion">
                <nav aria-label="Page navigation ">
                    <ul class="pagination">
                        {{ $clients->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection


<!-- <script>
    // jQuery script to change text on document ready
    function fetchClients(page = 1, keyword = '') {
        $.ajax({
            url: '/clients-search?page=' + page + '&keyword=' + keyword, // Replace with your route URL
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#clientsTable').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }$(document).ready(function() {
        // Initial load
        fetchClients();

        $('#searchInput').on('input', function() {
            var keyword = $(this).val();
            fetchClients(1, keyword); // Trigger search on input change with page 1
        });

        // Pagination click event
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var keyword = $('#searchInput').val();
            fetchClients(page, keyword); // Fetch results for the clicked page
        });
    });
</script> -->