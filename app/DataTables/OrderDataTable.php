<?php

namespace App\DataTables;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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
                return '<div class="btn-group" role="group">
                         <form action="'.route('orders.status', $row->ID).'" method="get" >
                            '.csrf_field().'
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="pending" '.($row->Status == 'pending' ? 'selected' : '').'>Pending</option>
                                <option value="shipped" '.($row->Status == 'shipped' ? 'selected' : '').'>Shipped</option>
                                <option value="completed" '.($row->Status == 'completed' ? 'selected' : '').'>Completed</option>

                        </div>';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Orders $model): QueryBuilder
    {
            return $model->newQuery()
                ->join('order_lines', 'orders.order_id', '=', 'order_lines.order_id')
                ->join('accounts', 'orders.account_id', '=', 'accounts.account_id')
                ->join('items', 'order_lines.item_id', '=', 'items.item_id')
                ->join('item_category', 'items.item_id', '=', 'item_category.item_id')
                ->join('category', 'item_category.category_id', '=', 'category.category_id')
                ->join('users', 'accounts.account_id', '=', 'users.account_id')
                ->select([
                    'orders.order_id AS ID', // Group by this column
                    \DB::raw('CONCAT(users.fname, " ", users.lname) AS Customer'),
                    'accounts.email AS Email',
                    'orders.created_at AS Order Placed',
                    \DB::raw('SUM(orders.total_amount) AS "Total Amount"'), // Aggregate total amount
                    'orders.order_status AS Status',
                ])
                ->groupBy('orders.order_id', 'users.fname', 'users.lname', 'accounts.email', 'orders.created_at', 'orders.order_status');

    }    
    

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('order-table')
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
            Column::make('ID')->title('ID')->width(30)->addClass('text-center'),
            Column::make('Customer')->title('Customer')->width(100)->addClass('text-center'),
            Column::make('Email')->title('Email')->width(100)->addClass('text-center'),
            Column::make('Order Placed')->title('Order Placed')->width(120)->addClass('text-center'),
            Column::make('Total Amount')->title('Total Amount')->width(50)->addClass('text-center'),
            Column::make('Status')->title('Status')->width(50)->addClass('text-center'),
            Column::computed('action')->width(120)->addClass('text-center')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center no-wrap'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
