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
    <div class="excel_import">
        <form action="{{ route('item.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="file">Select Excel File:</label>
                <input type="file" name="file" required>
            </div>
        
            <br>
        
            <button type="submit">Import Items</button>
        </form>
    </div>
    <h2 class="mb-4  " id='user_header' style="color:rgb(100, 100, 224)">Item List</h2>
    
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
