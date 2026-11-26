<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class KalenderLiburController extends Controller
{
    /**
     * Ambil daftar hari libur nasional Indonesia (mengacu ke Kalender Nasional Resmi).
     * Secara default mengembalikan gabungan tahun berjalan dan tahun berikutnya.
     */
    public function getHariLibur(Request $request): JsonResponse
    {
        $tahunParam = $request->input('tahun');
        $years = $tahunParam
            ? [(int) $tahunParam]
            : [(int) date('Y'), (int) date('Y') + 1];

        $merged = [];
        $sources = [];

        foreach ($years as $year) {
            $result = $this->fetchYearHolidays($year);
            $sources[$year] = $result['source'];
            foreach ($result['data'] as $tgl => $info) {
                $merged[$tgl] = $info;
            }
        }

        ksort($merged);

        return response()->json([
            'status' => true,
            'years' => $years,
            'sources' => $sources,
            'data' => $merged,
        ]);
    }

    /**
     * Ambil dan cache data hari libur nasional untuk 1 tahun tertentu.
     */
    protected function fetchYearHolidays(int $year): array
    {
        $cacheKey = "rsia_hari_libur_nasional_v2_{$year}";
        $backupKey = "rsia_hari_libur_nasional_v2_backup_{$year}";

        if (Cache::has($cacheKey)) {
            return [
                'source' => 'cache',
                'data' => Cache::get($cacheKey, []),
            ];
        }

        // 1. Sumber utama: Google Calendar Resmi Hari Libur Nasional Indonesia
        $holidays = $this->fetchFromGoogleCalendar($year);
        $source = 'google-calendar-id';

        // 2. Sumber cadangan: Nager.Date Public Holidays API
        if (empty($holidays)) {
            $holidays = $this->fetchFromNagerApi($year);
            $source = 'nager-date';
        }

        if (!empty($holidays)) {
            Cache::put($cacheKey, $holidays, now()->addDays(7));
            Cache::forever($backupKey, $holidays);

            return [
                'source' => $source,
                'data' => $holidays,
            ];
        }

        // 3. Fallback offline: gunakan backup cache terakhir jika API tidak bisa dijangkau
        if (Cache::has($backupKey)) {
            return [
                'source' => 'backup-cache',
                'data' => Cache::get($backupKey, []),
            ];
        }

        return [
            'source' => 'unavailable',
            'data' => [],
        ];
    }

    /**
     * Sumber utama: Google Calendar Official Indonesian Holidays (.ics)
     * Mencakup Hari Libur Nasional dan Cuti Bersama resmi pemerintah Indonesia.
     */
    protected function fetchFromGoogleCalendar(int $year): array
    {
        try {
            $url = 'https://calendar.google.com/calendar/ical/id.indonesian%23holiday%40group.v.calendar.google.com/public/basic.ics';
            $response = Http::timeout(8)->get($url);

            if (!$response->successful()) {
                return [];
            }

            $ics = $response->body();
            if (empty($ics)) {
                return [];
            }

            preg_match_all('/BEGIN:VEVENT(.*?)END:VEVENT/s', $ics, $matches);
            if (empty($matches[1])) {
                return [];
            }

            $result = [];
            $prefix = $year . '-';

            foreach ($matches[1] as $event) {
                preg_match('/DTSTART;VALUE=DATE:(\d{8})/', $event, $dt);
                preg_match('/SUMMARY:(.*)/', $event, $sum);
                preg_match('/DESCRIPTION:(.*)/', $event, $desc);

                if (!$dt || !$sum) {
                    continue;
                }

                $ymd = substr($dt[1], 0, 4) . '-' . substr($dt[1], 4, 2) . '-' . substr($dt[1], 6, 2);
                if (!str_starts_with($ymd, $prefix)) {
                    continue;
                }

                $description = trim($desc[1] ?? '');
                $summary = trim(str_replace('\,', ',', $sum[1]));

                // Hanya ambil yang berstatus Hari libur nasional atau Cuti bersama
                if (stripos($description, 'Hari libur') !== false || stripos($description, 'Cuti bersama') !== false) {
                    $result[$ymd] = [
                        'tanggal' => $ymd,
                        'keterangan' => $summary,
                        'kategori' => $description,
                        'is_national_holiday' => true,
                    ];
                }
            }

            ksort($result);
            return $result;
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Sumber cadangan: date.nager.at Public Holidays API
     */
    protected function fetchFromNagerApi(int $year): array
    {
        try {
            $response = Http::timeout(5)->get("https://date.nager.at/api/v3/PublicHolidays/{$year}/ID");

            if (!$response->successful()) {
                return [];
            }

            $rows = $response->json();
            if (!is_array($rows)) {
                return [];
            }

            $result = [];
            foreach ($rows as $row) {
                $date = $row['date'] ?? null;
                $name = $row['localName'] ?? ($row['name'] ?? null);

                if ($date && $name) {
                    $normalizedDate = date('Y-m-d', strtotime($date));
                    $result[$normalizedDate] = [
                        'tanggal' => $normalizedDate,
                        'keterangan' => trim($name),
                        'kategori' => 'Hari libur nasional',
                        'is_national_holiday' => true,
                    ];
                }
            }

            return $result;
        } catch (Exception $e) {
            return [];
        }
    }
}
