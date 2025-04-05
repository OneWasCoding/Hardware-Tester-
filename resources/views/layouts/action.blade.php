<?php
?>

<div class="btn-group" role="group">
    @if ($delete_mark ==null)
        <a href="{{ route($routePrefix . '.edit', $id) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i> Edit
        </a>

        {{-- Delete Button --}}
        <form action="{{ route($routePrefix . '.destroy', $id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">
                <i class="fas fa-trash"></i> Delete
            </button>
        </form>
    @elseif ($delete_mark != null)
        {{-- View Button --}}
        {{-- Restore Button --}}
        <form action="{{ route($routePrefix . '.restore', $id) }}" method="get" style="display:inline;">
            <button type="submit" class="btn btn-sm btn-success">
                <i class="fas fa-undo"></i> Restore
            </button>
        </form>
    @endif
</div>  