<?php

namespace App\Services\Bpjs\Vclaim;

use LZCompressor\LZString;
use App\Services\Bpjs\Vclaim\GenerateBpjs;

class ResponseVclaim
{
    public function responseVclaim($response, $key)
    {
        $result = json_decode($response);
        if ($result && isset($result->metaData) && $result->metaData->code == "200" && is_string($result->response)) {
            $mapped = self::doMaping($result->metaData, $result->response, $key);
            $mappedObj = json_decode($mapped);

            // Jika response gagal didekripsi (null) padahal code 200, coba toleransi drift timestamp (±1 s/d ±4 detik)
            if ((!$mappedObj || $mappedObj->response === null) && strlen($key) > 10) {
                $baseKey = substr($key, 0, -10);
                $origTs = intval(substr($key, -10));
                if ($origTs > 1000000000) {
                    $offsets = [-1, 1, -2, 2, -3, 3, -4, 4];
                    foreach ($offsets as $offset) {
                        $tryKey = $baseKey . strval($origTs + $offset);
                        $tryMapped = self::doMaping($result->metaData, $result->response, $tryKey);
                        $tryObj = json_decode($tryMapped);
                        if ($tryObj && $tryObj->response !== null) {
                            return $tryMapped;
                        }
                    }
                }
            }

            return $mapped;
        }

        return json_encode($result);
    }

    public function doMaping($metaData, $response, $key)
    {
        $data = [
            "metaData" => $metaData,
            "response" => json_decode($this->decompressed(GenerateBpjs::stringDecrypt($key, $response)))
        ];
        return json_encode($data);
    }

    protected function decompressed($dataString)
    {
        return LZString::decompressFromEncodedURIComponent($dataString);
    }
}
