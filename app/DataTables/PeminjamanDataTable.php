<?php

namespace App\DataTables;

use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PeminjamanDataTable extends DataTable
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
            ->addColumn('action', 'peminjaman.action')
            ->editColumn('waktu_peminjaman_ambil', function($data) {
                return date('d-m-Y', strtotime($data->waktu_peminjaman_ambil));
            })
            ->editColumn('waktu_peminjaman_kembali', function($data) {
                return date('d-m-Y', strtotime($data->waktu_peminjaman_kembali));
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Peminjaman $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Peminjaman $model): QueryBuilder
    {
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
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('nama_ruangan'),
            Column::make('nama_barang'),
            Column::make('waktu_peminjaman_ambil')->title('Waktu Pengambilan'),
            Column::make('waktu_peminjaman_kembali')->title('Waktu Kembalian'),
            Column::make('jumlah'),
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Peminjaman_' . date('YmdHis');
    }
}
