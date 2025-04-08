@extends('layouts.base')
 
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">User Management</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush