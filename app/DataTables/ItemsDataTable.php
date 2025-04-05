<?php

namespace App\DataTables;

use App\Models\items;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class itemsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
       return (new EloquentDataTable($query))
       ->addColumn('action', function ($row) {
           return view('layouts.action', [
               'model' => $row,
               'routePrefix' => 'item', // Change this to match your resource
               'id'=>$row->id,
                'editRoute' => route('item.edit', $row->id),
               'isTrashed' => method_exists($row, 'trashed') ? $row->trashed() : false
           ]);
       })
       ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(items $model): QueryBuilder
    {
        return $model->newQuery()
        ->join('item_category', 'items.item_id', '=', 'item_category.item_id')
        ->join('category', 'item_category.category_id', '=', 'category.category_id')
        ->join('stocks', 'items.item_id', '=', 'stocks.item_id')
        ->select([
            'items.item_id AS id', // Add this to ensure the id column is available
            'items.item_name AS Item Name',
            'items.item_price AS Price',
            'category.category_name AS Category',
            'stocks.quantity AS Stock'
        ]);
    } // <-- Missing closing bracket added here

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('items-table')
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
            Column::make('Item Name')->width(150)->addClass('text-center'),
            Column::make('Price')->width(150)->addClass('text-center'),
            Column::make('Category')->width(150)->addClass('text-center'),
            Column::make('Stock')->width(200)->addClass('text-center'),
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
        return 'items_' . date('YmdHis');
    }
}