<?php

namespace App\Traits;

trait PrintErmTrait
{
    use FingerPrintTrait;

    protected function preparePrintData(
        $model,
        string $pegawaiField = 'pegawai',
        string $nipField = 'nip',
        string $tanggalField = 'tanggal'
    ) {

        $data = $model->toArray();

        $pegawai = data_get(
            $model,
            "$pegawaiField.nama",
            '-'
        );

        $data['ttd_petugas'] = $this->setFingerOutput(
            $pegawai,
            $model->{$nipField},
            $model->{$tanggalField}
        );

        return $data;
    }
}