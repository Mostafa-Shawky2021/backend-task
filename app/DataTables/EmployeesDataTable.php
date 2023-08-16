<?php

namespace App\DataTables;

use App\Models\Company;
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
            ->addColumn('employee_name', fn (Employee $employee) => $employee->employee_name)
            ->addColumn('employee_email', fn (Employee $employee) => $employee->employee_email)
            ->addColumn('employee_company', fn (Employee $employee) => $employee->company->company_name)
            ->addColumn('employee_image', function (Employee $employee) {
                if ($employee->employee_image) {
                    return "<img 
                                width='45'
                                height='45'
                                class='rounded' 
                                src='" . asset('storage/' . $employee->employee_image) . "'/>";
                }

                return "No Image available";
            })->addColumn('action', function (Employee $employee) {
                $routeParamter = ['employee' => $employee->id];
                $btn =
                    '<div class="action-wrapper">
                        <a class="btn-action" href=' . route('employees.edit', $routeParamter) . '>
                        <i class="fa fa-edit icon icon-edit"></i>
                        </a>
                    <form method="POST" action="' . route('employees.destroy', $routeParamter) . '"}}>
                        ' . method_field('DELETE') . '
                        ' . csrf_field() . '
                            <button class="btn-action" onclick="return confirm(\'هل انت متاكد؟\')">
                                <i class="fa fa-trash icon icon-delete"></i>
                        </button>
                    </form>
                </div>';
                return $btn;
            })->addColumn(
                'created_at',
                fn ($company) => $company->created_at->format('Y-m-d H:i')
            )->rawColumns(['employee_image', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Employee $model): QueryBuilder
    {
        if (request()->has('company')) {
            $categoryId = request()->query('company');
            $filter = $model->where('company_id', $categoryId);
            return $filter;
        }
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
            ->dom('rtip')
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
            Column::make('employee_company'),
            Column::make('employee_image'),
            Column::make('created_at'),
            Column::make('action'),

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
