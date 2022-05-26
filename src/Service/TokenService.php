<?php

namespace Tlait\CarForRent\Service;

use Exception;
use Firebase\JWT\JWT;

class TokenService
{
    private string $jwtSecret;
    private array $token;
    private int $issuedAt;
    private int $expire;
    private string $jwt;

    public function __construct()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->issuedAt = time();
        $this->expire = $this->issuedAt + 3600;
        $this->jwtSecret = "TlaitToken";
    }

    /**
     * @param $iss
     * @param $data
     * @return string
     */
    public function jwtEncodeData($iss, $data): string
    {

        $this->token = array(
            "iss" => $iss,
            "aud" => $iss,
            "iat" => $this->issuedAt,
            "exp" => $this->expire,
            "data" => $data
        );

        $this->jwt = JWT::encode($this->token, $this->jwtSecret, 'HS256');
        return $this->jwt;
    }

    public function jwtDecodeData($jwtToken)
    {
        try {
            $decode = JWT::decode($jwtToken, $this->jwtSecret, array('HS256'));
            return $decode->data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
