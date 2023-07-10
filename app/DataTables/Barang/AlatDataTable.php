<?php

namespace App\DataTables\Barang;

use App\Models\Alat;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AlatDataTable extends DataTable
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
                $show   = route('admin.alat.show', $data->id);
                $update = route('admin.alat.update', $data->id);
                $delete = route('admin.alat.destroy', $data->id);
                return "
                        <a onclick='handleEdit(this)' data-id='$data->id' data-url='$update' style='cursor: pointer;' class='text-warning mr-2'><i class='fas fa-edit'></i></a>
                        <a onclick='handleDelete(this)' data-url='$delete' style='cursor: pointer;' class='text-danger'><i class='fas fa-trash'></i></a>";
            })
            ->editColumn('tanggal_masuk', function($data) {
                return date('d-m-Y', strtotime($data->tanggal_masuk));
            })
            ->editColumn('foto', function($data) {
                return "<img src='" . asset($data->foto) . "' class='img-fluid'>";
            })
            ->rawColumns(['foto', 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Alat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Alat $model): QueryBuilder
    {
        if(!str_contains(url()->current(), 'admin')) {
            $asd = explode("/", url()->current());
            $asds = count($asd); 
            return $model->newQuery()->where('id_ruangan', $asd[$asds - 2]);
        }
        return $model->newQuery();
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
                    ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        if(str_contains(url()->current(), 'alat') && !str_contains(url()->current(), 'admin')) {
            return [
                Column::make('nama'),
                Column::make('foto')->width(200),
                Column::make('kode_alat'),
                Column::make('stok_jumlah')->width(150),
                Column::make('tanggal_masuk')->width(200),
            ];
        }
        return [
            Column::make('nama'),
            Column::make('foto')->width(200),
            Column::make('kode_alat'),
            Column::make('stok_jumlah')->width(150),
            Column::make('tanggal_masuk')->width(200),
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
    // protected function filename(): string
    // {
    //     return 'Alat_' . date('YmdHis');
    // }
}
