@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Laptop</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Phone Brand</th>
                                    <th>Phone Model</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                            @foreach ($phones as $key=>$phone)
                                <tr>
                                    <td>{{$phone->brand}}</td>
                                    <td>{{$phone->model}}</td>
                                    <td>RM {{$phone->price}}</td>
                                    <td>
                                        <a href="{{route('store',$phone)}}" class="btn btn-primary" onclick="">Buy</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Price</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
    
                                </thead>
                                <tbody>
                                @foreach ($purchases as $key=>$purchase)
                                    <tr>
                                        <td>RM {{$purchase->price}}</td>
                                        <td>
                                            @if ($purchase->payment_status == 0)
                                                <a>Not Paid</a>
                                            @else
                                                <a>Paid</a>
                                            @endif
                                        </td>
                                        @if ($purchase->payment_status == 0)
                                        <td>
                                            <a href="{{route('showBill',$purchase)}}" class="btn btn-warning" onclick="">Buy</a>
                                        </td>
                                        @else
                                        <td>No Action</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <passport-token></passport-token>
</div>
@endsection
