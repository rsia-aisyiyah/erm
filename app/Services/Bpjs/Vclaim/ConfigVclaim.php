<?php

namespace App\Services\Bpjs\Vclaim;


use Dotenv\Dotenv;
use App\Services\Bpjs\Vclaim\GenerateBpjs;
use App\Services\Bpjs\Vclaim\ManageService;

class ConfigVclaim extends ManageService
{
    protected $urlEndpoint;
    protected $consId;
    protected $secretKey;
    protected $userKey;
    protected $header;
    protected $timestamps;

    public function __construct()
    {
        $this->urlEndpoint = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/';
        $this->consId = '16748';
        $this->secretKey = '7cM8A9F546';
        $this->userKey = '23cdf31249c696d807e7cb714f98a471';
        // $this->urlEndpoint = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/';
        // $this->consId = '18626';
        // $this->secretKey = '8gU0048B8D';
        // $this->userKey = 'd79e5e17bbe11bc57d46af999aadf44e';

        // echo $this->userKey;
    }

    public function setUrl()
    {
        return $this->urlEndpoint;
    }

    public function setConsId()
    {
        return $this->consId;
    }

    public function setSecretKey()
    {
        return $this->secretKey;
    }

    public function setUserKey()
    {
        return $this->userKey;
    }

    public function setTimestamp()
    {
        return GenerateBpjs::bpjsTimestamp();
    }

    public function setsignature()
    {
        return GenerateBpjs::generateSignature($this->setConsId(), $this->setSecretKey());
    }

    public function setUrlEncode()
    {
        return array('Content-Type' => 'Application/x-www-form-urlencoded');
    }

    public function setUrlJson()
    {
        return array('Content-Type' => 'Application/Json');
    }

    public function setHeader()
    {
        return [
            'Accept' => 'application/json',
            'X-cons-id'   => $this->setConsid(),
            'X-timestamp' => $this->setTimestamp(),
            'X-signature' => $this->setSignature(),
            'user_key'    => $this->setUserKey()
        ];
    }
    public function setHeaderPost()
    {
        return [
            'Accept' => 'application/json',
            'X-cons-id'   => $this->setConsid(),
            'X-timestamp' => $this->setTimestamp(),
            'X-signature' => $this->setSignature(),
            'user_key'    => $this->setUserKey(),
            'Content-Type'    => $this->setUrlEncode()
        ];
    }

    public function keyDecrypt($timestamp)
    {
        return $this->setConsid() . $this->setSecretKey() . $timestamp;
    }

    public function setHeaders($header)
    {
        return array_merge($header, $this->setUrlEncode());
    }
}
