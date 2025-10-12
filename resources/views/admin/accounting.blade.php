@extends('layouts.app')

@section('title', 'Accounting Management')
@section('page-title', 'Accounting Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Accounting</li>
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-calculator"></i> Financial Transactions</h5>
            <button class="btn btn-primary"><i class="fas fa-plus"></i> Add Transaction</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr><th>Type</th><th>Description</th><th>Amount</th><th>Date</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                @if($transaction['type'] == 'Income')
                                    <span class="badge bg-success"><i class="fas fa-arrow-up"></i> Income</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-arrow-down"></i> Expense</span>
                                @endif
                            </td>
                            <td>{{ $transaction['description'] }}</td>
                            <td>${{ number_format($transaction['amount']) }}</td>
                            <td>{{ $transaction['date'] }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection