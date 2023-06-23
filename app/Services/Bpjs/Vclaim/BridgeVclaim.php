<?php

namespace App\Services\Bpjs\Vclaim;

use Bpjs\Bridging\CurlFactory;
// use Bpjs\Bridging\Vclaim\ConfigVclaim;
use Bpjs\Bridging\Vclaim\ResponseVclaim;

class BridgeVclaim extends CurlFactory
{
    protected $config;
    protected $response;
    protected $header;
    protected $headers;

    public function __construct()
    {
        $this->config = new ConfigVclaim;
        $this->response = new ResponseVclaim;
        $this->header = $this->config->setHeader();
    }

    public function getRequest($endpoint)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header);
        $result = $this->response->responseVclaim($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function getRequestNew($endpoint)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header);
        $result = $this->response->responseVclaim($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function postRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header, "POST", $data);
        $result = $this->response->responseVclaim($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function putRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header, "PUT", $data);
        $result = $this->response->responseVclaim($result,  $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function deleteRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header, "DELETE", $data);
        $result = $this->response->responseVclaim($result, $this->config->keyDecrypt($this->header['X-timestamp']));
        return $result;
    }

    public function deleteResponseNoDecrypt($endpoint, $data)
    {
        $result = $this->request($this->config->setUrl() . $endpoint, $this->header, "DELETE", $data);
        return $result;
    }
}
