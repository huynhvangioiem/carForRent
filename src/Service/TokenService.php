<?php

namespace Tlait\CarForRent\Service;

use Dotenv\Dotenv;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenService
{
    private string $jwtSecret;
    private array $token;
    private int $issuedAt;
    private int $expire;
    private string $jwt;
    private static $loadEnv;

    public function __construct()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->issuedAt = time();
        $this->expire = $this->issuedAt + 3600;
        $this->jwtSecret = $this->setJwtSecret();
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
            "payload" => $data
        );

        $this->jwt = JWT::encode($this->token, $this->jwtSecret, 'HS256');
        return $this->jwt;
    }

    public function jwtDecodeData($jwtToken)
    {
        try {
            $decode = JWT::decode($jwtToken, new Key($this->jwtSecret, 'HS256'));
            return $decode->data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function setJwtSecret()
    {
        self::$loadEnv = LoadEnvService::getConnection();
        self::$loadEnv->load();
        return $_ENV['TOKEN_SECRET'];
    }
}
