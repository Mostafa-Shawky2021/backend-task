<?php

namespace App\DataTables;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('employee_name', fn ($employee) => $employee->employee_name)
            ->addColumn('employee_email', fn ($employee) => $employee->employee_email)
            ->addColumn('employee_company', fn ($employee) => $employee->company->company_name)
            ->addColumn('employee_image', function ($employee) {
                if ($employee->employee_image) return "<img src='" . $employee->employee_image . "'/>";
                return "No Image available";
            })->rawColumns(['employee_image'])
            ->addColumn('created_at', fn ($employee) => $employee->created_at->format('Y-m-d H:i'));
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Employee $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('employees-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->parameters([
                'order' => [0, 'desc']
            ])
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('employee_name'),
            Column::make('employee_email'),
            Column::make('employee_image'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Employees_' . date('YmdHis');
    }
}
