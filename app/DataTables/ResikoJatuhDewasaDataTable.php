<?php

namespace App\DataTables;

use App\Models\ResikoJatuhDewasa;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ResikoJatuhDewasaDataTable extends DataTable
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
            ->addColumn('action', 'resikojatuhdewasa.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ResikoJatuhDewasa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ResikoJatuhDewasa $model, Request $request)
    {
        $noRawat = $request->no_rawat;
        $tanggal = $request->input('tanggal');

        $query = $model->where('no_rawat', $noRawat)->with('petugas');

        if ($tanggal) {
            try {
                $tanggalCarbon = Carbon::parse($tanggal)->format('Y-m-d H:i:s');
                $query->where('tanggal', $tanggalCarbon);
            } catch (QueryException $e) {
                // return $e->errorInfo;
            }
        }

        return $query->orderBy('tanggal', 'desc');
    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('resikojatuhdewasa-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ResikoJatuhDewasa_' . date('YmdHis');
    }
}
