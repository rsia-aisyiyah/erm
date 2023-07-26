<?php

namespace App\Services\Bpjs\Vclaim;


use Dotenv\Dotenv;
use App\Services\Bpjs\Vclaim\GenerateBpjs;
use App\Services\Bpjs\Vclaim\ManageService;

class ConfigVclaim extends ManageService
{
    protected $urlEndpoint;
    protected $icareUrl;
    protected $consId;
    protected $secretKey;
    protected $userKey;
    protected $header;
    protected $timestamps;

    public function __construct()
    {
        $this->urlEndpoint = config('app.bpjsUrl');
        $this->consId = config('app.consId');
        $this->secretKey = config('app.secretKey');
        $this->userKey = config('app.userKey');
        $this->icareUrl = config('app.icareUrl');
    }

    public function setUrl()
    {
        return $this->urlEndpoint;
    }
    public function setUrlIcare()
    {
        return $this->icareUrl;
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

    public function setHeaderIcare()
    {
        return [
            'Accept' => 'application/json',
            'X-cons-id'   => $this->setConsid(),
            'X-timestamp' => $this->setTimestamp(),
            'X-signature' => $this->setSignature(),
            'user_key'    => $this->setUserKey(),
            'Content-Type'    => $this->setUrlJson()
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
