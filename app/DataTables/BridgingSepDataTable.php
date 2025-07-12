<?php

namespace App\DataTables;

use App\Models\BridgingSep;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BridgingSepDataTable extends DataTable
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
            ->addColumn('action', 'bridgingsep.action')
            ->addColumn('no_reg', function ($row) {
                return $row->regPeriksa->no_reg ?? '-';
            })
            ->addColumn('poliklinik', function ($row) {
                return $row->regPeriksa->poliklinik->nm_poli ?? '-';
            })
            ->addColumn('dokter', function ($row) {
                return $row->regPeriksa->dokter->nm_dokter ?? '-';
            })
            ->editColumn('tanggal_lahir', function ($row) {
                return Carbon::parse($row->tanggal_lahir)->translatedFormat('d F Y') ?? '-';
            })->editColumn('jnspelayanan', function ($row) {
                return $row->jnspelayanan === '1' ? "Rawat Inap" : "Rawat Jalan";
            })->addColumn('action', function ($row) {
                $action = "riwayatIcare('{$row->no_kartu}', '{$row->kddpjp}')";
                $buttons = '<button type="button" onclick="' . $action . '" class="btn btn-sm btn-success" data-id="' . $row->id . '" title="Open I-Care"></i> I-Care</button>';

                return $buttons;
            })
            ->rawColumns(['action']);
        ;

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BridgingSep $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BridgingSep $model)
    {
        return $model->newQuery()->with([
            'regPeriksa' => function ($q) {
                $q->with(['poliklinik', 'dokter']);
            }
        ])->orderBy('tglsep', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('bridgingsep-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
                Button::make('custom-button')
                    ->text('Click Me!') // Text displayed on the button
                    ->action('function() { alert("Custom button clicked!"); }') // JavaScript action
            );
        ;
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
            Column::make('no_sep'),
            Column::make('tglsep'),
            Column::make('no_kartu'),
            Column::make('nomr'),
            Column::make('nama_pasien'),
            Column::make('tanggal_lahir'),
            Column::make('jkel'),
            Column::make('poliklinik'),
            Column::make('dokter'),
            Column::make('jnspelayanan'),
            // Column::make('add your columns'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BridgingSep_' . date('YmdHis');
    }

    public function ajax()
    {
        return datatables()->eloquent($this->query())
            ->filter(function ($query) {
                $start = request()->get('date_start');
                $end = request()->get('date_end');
                if ($start && $end) {
                    $query->whereBetween('tglsep', [$start, $end]);
                }
            })
            ->toJson(true);
    }
}
