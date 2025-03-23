<?php

namespace App\DataTables;
use Illuminate\Support\Carbon;
use App\Models\user;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class userDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('created_at', function ($row) {
            return Carbon::parse($row->created_at)->format('d M Y, h:i A'); 
        })
        ->addColumn('updated_at', function ($row) {
            return Carbon::parse($row->updated_at)->format('d M Y, h:i A');
        })
        ->addColumn('action', function ($row) {
            return '<div class="btn-group" role="group">
                        <a href="' . route("user.edit", $row->account_id) . '" class="btn btn-primary btn-xl mx-1">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="' . route("user.destroy", $row->account_id) . '" class="btn btn-danger btn-xl mx-1">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>';
        })->setRowId('account_id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(user $model): QueryBuilder
    {
        return $model->newQuery();
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
                  Column::make('user_id')->width(150)->addClass('text-center'),
                  Column::make('fname')->width(150)->addClass('text-center'),
                  Column::make('lname')->width(150)->addClass('text-center'),
                  Column::make('created_at')->width(200)->addClass('text-center'),
                  Column::make('updated_at')->width(200)->addClass('text-center'),
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
