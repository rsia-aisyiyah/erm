<?php

namespace App\Services\Bpjs\Vclaim;

use LZCompressor\LZString;
use App\Services\Bpjs\Vclaim\GenerateBpjs;

class ResponseVclaim
{
    public function responseVclaim($response, $key)
    {
        // $response = json_encode("'response': 'JS/AvKNlNqr2bIp3h2z0L+jcX05uU16VQjvIhSnyaEo/q/k0cZRkGfcYCcD6JLajMslLJo0o/tApraMQLOHKiR04MbNRnd4YKUqXVp5b4H2IePgN0j7TMakU7uTX/EW8RLXdkWjyAMrn3T3koyuRu6YG2dtOJ6vbzleoTR0y2cluSsoxPtw+d4El+e42tpEQqCDo4PYdQcD2cbfVpSaBpFpmEdfTXUg6EcBnCDs42J8=','metaData' : {'code': 200,'message': 'Sukses'}");

        // return $response;

        $result = json_decode($response);
        if ($result->metaData->code == "200" && is_string($result->response)) {
            return self::doMaping($result->metaData, $result->response, $key);
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
