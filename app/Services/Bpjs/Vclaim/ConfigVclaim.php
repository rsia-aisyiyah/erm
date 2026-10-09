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
        $this->timestamps = GenerateBpjs::bpjsTimestamp();
        return $this->timestamps;
    }

    public function setsignature($timestamp = null)
    {
        $t = $timestamp ?: ($this->timestamps ?: $this->setTimestamp());
        return GenerateBpjs::generateSignature($this->setConsId(), $this->setSecretKey(), $t);
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
        $t = $this->setTimestamp();
        return [
            'Accept' => 'application/json',
            'X-cons-id'   => $this->setConsid(),
            'X-timestamp' => $t,
            'X-signature' => $this->setsignature($t),
            'user_key'    => $this->setUserKey()
        ];
    }
    public function setHeaderPost()
    {
        $t = $this->setTimestamp();
        return [
            'Accept' => 'application/json',
            'X-cons-id'   => $this->setConsid(),
            'X-timestamp' => $t,
            'X-signature' => $this->setsignature($t),
            'user_key'    => $this->setUserKey(),
            'Content-Type' => 'Application/x-www-form-urlencoded'
        ];
    }

    public function setHeaderIcare()
    {
        $t = $this->setTimestamp();
        return [
            'Accept' => 'application/json',
            'X-cons-id'   => $this->setConsid(),
            'X-timestamp' => $t,
            'X-signature' => $this->setsignature($t),
            'user_key'    => $this->setUserKey(),
            'Content-Type' => 'Application/Json'
        ];
    }

    public function keyDecrypt($timestamp = null)
    {
        $t = $timestamp ?: ($this->timestamps ?: $this->setTimestamp());
        return $this->setConsid() . $this->setSecretKey() . $t;
    }

    public function setHeaders($header)
    {
        return array_merge($header, $this->setUrlEncode());
    }
}
