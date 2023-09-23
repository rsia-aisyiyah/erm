<?php

namespace App\Services\Bpjs\Apotek;

use App\Services\Bpjs\CurlFactory;
use App\Services\Bpjs\Apotek\ResponseApotek;

class BridgeApotek extends CurlFactory
{
    protected $config;
    protected $response;
    protected $header;
    protected $headers;

    public function __construct()
    {
        $this->config = new ConfigApotek;
        $this->response = new ResponseApotek;
        $this->header = $this->config->setHeader();
    }

    public function getRequest($endpoint)
    {

        $output = false;
        try {
            while ($output == false) {
                $result = $this->request($this->config->setUrl() . $endpoint, $this->header);
                $result = $this->response->responseApotek($result, $this->config->keyDecrypt($this->header['X-timestamp']));
                $response = json_decode($result);
                if ($response->response == null && $response->metaData->code = '200') {
                    $output = false;
                    if ($response->metaData->message != 'Sukses') {
                        $output = true;
                    }
                } else {
                    $output = true;
                }
            }
            return $response;
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function getRequestNew($endpoint)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header);
        $result = $this->response->responseApotek($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function postRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->config->setHeaderPost(), "POST", $data);
        $result = $this->response->responseApotek($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function putRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header, "PUT", $data);
        $result = $this->response->responseApotek($result,  $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function deleteRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header, "DELETE", $data);
        $result = $this->response->responseApotek($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function deleteResponseNoDecrypt($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header, "DELETE", $data);
        return $result;
    }
}
