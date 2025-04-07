<?php

namespace App\DataTables;
use Illuminate\Support\Carbon;
use App\Models\user;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        
        ->addColumn('Status', function($row){
            return '<div class="btn-group" role="group">
            <form action="'. route('user.status', $row->account_id) .'" method="get">
                <select name="status" onchange="this.form.submit()" class="form-select">
                    <option value="active" '.($row->status == 'active' ? 'selected' : '').'>Active</option>
                    <option value="inactive" '.($row->status == 'inactive' ? 'selected' : '').'>Inactive</option>
                </select>
            </form>
            </div>';
        })
        ->addColumn('action', function ($row) {
            return '<div class="btn-group" role="group">
                        <a href="' . route("user.edit", $row->account_id) . '" class="btn btn-primary btn-xl mx-1">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="' . route("user.destroy", $row->account_id) . '" method="POST" style="display:inline;">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger btn-xl mx-1" onclick="return confirm(\'Are you sure you want to delete this user?\')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>';
        })
        ->rawColumns(['Status', 'action']) // Specify columns to render as raw HTML
        ->setRowId('account_id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(user $model): QueryBuilder
    {
        return $model->newQuery()
        ->join('accounts', 'users.account_id', '=', 'accounts.account_id')
        ->select([
            'accounts.status AS status',
            'users.account_id AS account_id',
            \DB::raw('CONCAT(users.fname, " ", users.lname) AS Name'),
            'accounts.username AS Username',
            'accounts.email AS Email',
            'accounts.role as Role',
        ]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
                  Column::make('Name')->width(150)->addClass('text-center'),
                  Column::make('Username')->width(200)->addClass('text-center'),
                  Column::make('Email')->width(200)->addClass('text-center'),
                  Column::make('Role')->width(200)->addClass('text-center'),
                  Column::computed('Status')->width(100)->addClass('text-center'),
                    Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center no-wrap'), // Apply nowrap CSS
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'user_' . date('YmdHis');
    }
}
