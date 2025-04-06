<?php

namespace App\DataTables;

use App\Models\Items; // Fixed model reference
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ItemsDataTable extends DataTable // Fixed class name capitalization
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return view('layouts.action', [
                    'delete_mark' => $row->deleted_at,
                    'model' => $row,
                    'routePrefix' => 'item',
                    'id' => $row->id,
                    'isTrashed' => (bool) $row->deleted_at
                ]);
            })
            ->setRowId('id');
    }

    public function query(Items $model): QueryBuilder
    {
        return $model->newQuery()
            ->withTrashed()
            ->join('item_category', 'items.item_id', '=', 'item_category.item_id')
            ->join('category', 'item_category.category_id', '=', 'category.category_id')
            ->join('stocks', 'items.item_id', '=', 'stocks.item_id')
            ->select([
                'items.item_id AS id',
                'items.item_name AS item_name',
                'items.item_price AS item_price',
                'category.category_name AS category_name',
                'stocks.quantity AS stock_quantity',
                'items.deleted_at AS deleted_at',
            ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('items-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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

    public function getColumns(): array
    {
        return [
            Column::make('item_name')->title('Item Name')->width(150)->addClass('text-center'),
            Column::make('item_price')->title('Price')->width(150)->addClass('text-center'),
            Column::make('category_name')->title('Category')->width(150)->addClass('text-center'),
            Column::make('stock_quantity')->title('Stock')->width(200)->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center no-wrap'),
        ];
    }

    protected function filename(): string
    {
        return 'items_' . date('YmdHis');
    }
}