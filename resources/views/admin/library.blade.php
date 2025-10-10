@extends('layouts.app')

@section('title', 'Library Management')
@section('page-title', 'Library Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Library</li>
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-book-open"></i> Library Books</h5>
            <button class="btn btn-primary"><i class="fas fa-plus"></i> Add New Book</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr><th>ID</th><th>Book Title</th><th>Author</th><th>ISBN</th><th>Available</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $book['id'] }}</td>
                            <td><i class="fas fa-book text-success me-2"></i>{{ $book['title'] }}</td>
                            <td>{{ $book['author'] }}</td>
                            <td><code>{{ $book['isbn'] }}</code></td>
                            <td><span class="badge bg-info">{{ $book['available'] }} copies</span></td>
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