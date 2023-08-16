<?php

namespace App\DataTables;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompaniesDataTable extends DataTable
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
            ->addColumn('company_name', fn (Company $company) => $company->company_name)
            ->addColumn('company_address', fn (Company $company) => $company->company_address)
            ->addColumn('company_logo', function (Company $company) {
                if ($company->company_logo) return "<img src='" . $company->company_logo . "'/>";
                return "No Logo available";
            })->addColumn(
                'created_at',
                fn ($company) => $company->created_at->format('Y-m-d H:i')
            )->addColumn('action', function (Company $company) {
                $routeParamter = ['company' => $company->id];
                $btn =
                    '<div class="action-wrapper">
                        <a class="btn-action" href=' . route('companies.edit', $routeParamter) . '>
                        <i class="fa fa-edit icon icon-edit"></i>
                        </a>
                    <form method="POST" action="' . route('companies.destroy', $routeParamter) . '"}}>
                        ' . method_field('DELETE') . '
                        ' . csrf_field() . '
                            <button class="btn-action" onclick="return confirm(\'هل انت متاكد؟\')">
                                <i class="fa fa-trash icon icon-delete"></i>
                        </button>
                    </form>
                </div>';
                return $btn;
            })->rawColumns(['company_logo', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Company $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('companies-table')
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
            Column::make('DT_RowId')->title('num')->name('id'),
            Column::make('company_name'),
            Column::make('company_address'),
            Column::make('company_logo'),
            Column::make('created_at'),
            Column::make('action'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Companies_' . date('YmdHis');
    }
}
