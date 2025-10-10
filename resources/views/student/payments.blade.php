@extends('layouts.app')

@section('title', 'Payments')
@section('page-title', 'Payment Invoices')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Payments</li>
@endsection

@section('sidebar')
    @include('student.partials.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-credit-card"></i> Payment History & Invoices</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr><th>Invoice</th><th>Description</th><th>Amount</th><th>Due Date</th><th>Status</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td><code>{{ $payment['invoice'] }}</code></td>
                            <td>{{ $payment['description'] }}</td>
                            <td>${{ $payment['amount'] }}</td>
                            <td>{{ $payment['due_date'] }}</td>
                            <td>
                                @if($payment['status'] == 'Paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if($payment['status'] == 'Pending')
                                    <button class="btn btn-sm btn-primary">Pay Now</button>
                                @else
                                    <button class="btn btn-sm btn-outline-secondary">Download</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection