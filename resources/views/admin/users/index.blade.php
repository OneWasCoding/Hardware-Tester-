@extends('layouts.base')

@section('content')
<div class="container">
    <h2>Users List</h2>
    {{ $dataTable->table() }}
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
