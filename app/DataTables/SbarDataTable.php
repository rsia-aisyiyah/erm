<?php

namespace App\DataTables;

use App\Models\PemeriksaanRanap;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SbarDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('verifikasi', function ($query) {
                return $query->verifikasi !== null ? date('d-m-Y', strtotime($query->verifikasi->tgl_verif))." ".$query->verifikasi->jam_verif : 'Belum Verifikasi';
            })
            ->editColumn('tgl_perawatan', function ($query) {
                return date('d-m-Y', strtotime($query->tgl_perawatan))." ".$query->jam_rawat;
            })
            ->setRowClass(function ($query) {
                return $query->verifikasi !== null ? 'table-success' : '';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PemeriksaanRanap $model
     */
    public function query()
    {
        $model = new PemeriksaanRanap();
        return $model->select(['no_rawat', 'jam_rawat', 'tgl_perawatan','keluhan', 'pemeriksaan', 'rtl', 'penilaian', 'nip'])
        ->whereHas('sbar',function($q){
            return $q->where('sumber', 'SBAR');
        })->with([
                'sbar' => function ($q) {
                    $q->select(['no_rawat', 'tgl_perawatan', 'jam_rawat', 'sumber', 'nip'])->with([
                        'dokterKonsul' => function ($q) {
                            return $q->with('dokterSbar');
                        }
                    ]);
        }, 'petugas.pegawai.departemen', 'verifikasi']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('sbar-table')
                    // ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    // ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            // Column::make('id'),
            // Column::make('add your columns'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            // Column::make('no_rawat')->width(60),
            // Column::make('keluhan'),
            // Column::make('pemeriksaan'),
            // Column::make('rtl'),
            // Column::make('penilaian'),
            // Column::make('petugas.nama', 'nm_petugas'),
            // Column::make('sbar.dokterKonsul.dokterSbar.nm_dokter', 'nm_dokter'),
            // Column::make('verifikasi.dokter.nm_dokter', 'nm_dokter'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sbar_' . date('YmdHis');
    }
}
