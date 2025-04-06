@extends('layouts.template')
<style>
    /* Make table cells equal width */

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }
    #user_header{
        color:#fff;
    }
</style>
@section('content')
<div class="content">
    <h2 class="mb-4" id='user_header' style="color:rgb(100, 100, 224)">Order List</h2>
    
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-striped table-bordered', 'style'=>'margin-bottom:30px;']) }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
