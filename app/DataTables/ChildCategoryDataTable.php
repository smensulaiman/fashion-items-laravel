<?php

namespace App\DataTables;

use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ChildCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('category', fn($result) => $result->subCategory->category->name)
            ->addColumn('sub category', fn($result) => $result->subCategory->name)
            ->addColumn('status', function ($result) {
                $badge = $result->status === 1 ? 'badge-success' : 'badge-danger';
                $status = $result->status === 1 ? 'Active' : 'Inactive';
                return '<span class="badge ' . $badge . '">' . $status . '</span>';
            })
            ->addColumn('action', function ($result) {
                return '<div style="display: flex; justify-content: space-evenly">
                            <a class="btn btn-dark rounded-0 shadow-none" href="' . route('admin.child-category.edit', $result->id) . '"><i class="far fa-edit"></i></a>
                            <a class="btn btn-danger delete-sub-category-item rounded-0 shadow-none" href="' . route('admin.child-category.destroy', $result->id) . '"><i class="far fa-trash-alt"></i></a>
                        </div>';
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ChildCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('childcategory-table')
            ->addTableClass('table table-striped table-bordered')
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
            Column::make('id')->width(40)->addClass('text-center align-middle'),
            Column::make('category')->addClass('align-middle'),
            Column::make('sub category')->addClass('align-middle'),
            Column::make('name')->addClass('align-middle'),
            Column::make('status')->addClass('text-center align-middle'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ChildCategory_' . date('YmdHis');
    }
}
