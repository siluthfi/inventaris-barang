<?php

namespace App\DataTables;

use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RuanganDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($data) {
                if(route('dashboard') == url()->current()) {
                    $show   = route('dashboard.ruangan', $data->id);
                    return "<a href='$show' class='text-primary mr-2'><i class='fas fa-eye'></i></a>";
                }
                $show   = route('admin.ruangan.show', $data->id);
                $update = route('admin.ruangan.update', $data->id);
                $delete = route('admin.ruangan.destroy', $data->id);
                return "
                        <a onclick='handleEditRuangan(this)' data-id='$data->id' data-url='$update' style='cursor: pointer;' class='text-warning mr-2'><i class='fas fa-edit'></i></a>
                        <a onclick='handleDelete(this)' data-url='$delete' style='cursor: pointer;' class='text-danger'><i class='fas fa-trash'></i></a>";
            })
            ->editColumn('foto', function($data) {
                return "<img src='" . asset($data->foto) . "' class='img-fluid'>";
            })
            ->editColumn('user.nama', function($data) {
                return $data->user ? $data->user->nama : '';
            })
            ->rawColumns(['action', 'foto'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Ruangan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ruangan $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('datatableserverside')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('nama_ruangan'),
            Column::make('gedung'),
            Column::make('foto')->width(200),
            Column::make('user.nama')->width(300)->title('Kepala Lab'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(80)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Ruangan_' . date('YmdHis');
    }
}
