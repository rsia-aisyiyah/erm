<?php

namespace App\Services\Dokumen\Contracts;

interface DokumenResolverInterface
{
    /**
     * Nama tabel fisik yang dikelola resolver ini, misal 'rsia_persetujuan_umum'.
     */
    public function table(): string;

    /**
     * Ambil satu baris dokumen berdasarkan uuid, dalam bentuk array TERNORMALISASI
     * dengan key seragam: uuid, no_rawat, nip, file, hash, signed_at, konten.
     * Return null kalau tidak ditemukan.
     */
    public function findByUuid(string $uuid): ?array;

    /**
     * Cek cepat (tanpa ambil semua kolom) apakah uuid ini ada di tabel resolver ini.
     * Resolver yang tahu nama kolom uuid-nya sendiri (bisa 'uuid', 'uuid_dokumen', dst),
     * jadi pencarian lintas tabel tidak perlu berasumsi nama kolom seragam.
     */
    public function existsUuid(string $uuid): bool;

    /**
     * Prefix nomor dokumen resmi, misal 'PU' untuk Persetujuan Umum,
     * 'SL' untuk Surat Lahir. Dipakai controller untuk format
     */
    public function nomorPrefix(): string;

    /**
     * Nama tampilan (label) untuk jenis dokumen ini, misal 'Persetujuan Umum'.
     */
    public function label(): string;

    /**
     * Path partial view/blade untuk render konten spesifik jenis ini.
     */
    public function viewTemplate(): string;

    /**
     * Nama storage untuk penyimpanan file pdf
     */
    public function storage(): string;
}