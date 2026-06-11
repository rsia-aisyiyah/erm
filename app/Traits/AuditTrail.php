<?php

namespace App\Traits;

use App\Models\AuditLog;

trait AuditTrail
{
    protected static function bootAuditTrail()
    {
        static::created(function ($model) {
            $model->writeAudit('INSERT');
        });

        static::updated(function ($model) {
            $model->writeAudit('UPDATE');
        });

        static::deleted(function ($model) {
            $model->writeAudit('DELETE');
        });
    }

    protected function writeAudit(string $action): void
    {
        try {

            $pegawai = session()->get('pegawai');

            $audit = AuditLog::create([
                'module' => $this->getAuditModule(),
                'table_name' => $this->getTable(),
                'entity_keys' => $this->getAuditKeys(),
                'no_rawat' => $this->getAuditNoRawat(),
                'no_rkm_medis' => $this->getAuditNoRm(),
                'audit_action' => $action,
                'user_id' => $pegawai?->nik,
                'username' => $pegawai?->nama,
                'ip_address' => request()->ip(),
                'url' => request()->fullUrl(),
            ]);

            if ($action !== 'UPDATE') {
                return;
            }

            foreach ($this->getChanges() as $field => $newValue) {

                if (
                    in_array($field, [
                        'updated_at',
                        'created_at'
                    ])
                ) {
                    continue;
                }

                $audit->details()->create([
                    'field_name' => $field,
                    'old_value' => $this->getOriginal($field),
                    'new_value' => $newValue,
                ]);
            }
        } catch (\Throwable $e) {

            report($e);

        }
    }

    /**
     * Override jika ingin nama modul khusus
     */
    protected function getAuditModule(): string
    {
        return strtoupper($this->getTable());
    }

    /**
     * Mendukung PK tunggal maupun composite key
     */
    protected function getAuditKeys(): array
    {
        return [
            $this->getKeyName() => $this->getKey()
        ];
    }

    /**
     * Override jika model memiliki no_rawat
     */
    protected function getAuditNoRawat(): ?string
    {
        return $this->no_rawat ?? null;
    }

    /**
     * Override jika model memiliki relasi pasien
     */
    protected function getAuditNoRm(): ?string
    {
        return $this->no_rkm_medis ?? null;
    }
}
