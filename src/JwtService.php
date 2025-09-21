<?php
/**
 * @desc JwtService.php
 * @author cdyun(121625706@qq.com)
 * @date 2025/9/21 21:49
 */
declare(strict_types=1);

namespace Cdyun\WebmanJwt;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use support\Log;

class JwtService
{
    /**
     * @param array $payload
     * @param int|null $expire
     * @return string
     * @author cdyun(121625706@qq.com)
     * @desc 生成JwtToken
     */
    public static function generateToken(array $payload, ?int $expire = null): string
    {
        $exp = $expire ?? self::getConfig('exp', 3600);
        $time = time();
        $payload += [
            'iss' => self::getIss(),
            'iat' => $time,
            'nbf' => $time,
            'exp' => $time + $exp,
        ];

        return JWT::encode($payload, self::getSecretKey(), self::getAlgorithm());

    }

    /**
     * @param string $token
     * @return array|false
     * @author cdyun(121625706@qq.com)
     * @desc 验证JwtToken
     */
    public static function validateToken(string $token): bool|array
    {
        try {
            $token = str_replace('Bearer ', '', $token);
            $payload = (array)JWT::decode($token, new Key(self::getSecretKey(), self::getAlgorithm()));
            if ($payload['iss'] !== self::getIss()) {
                throw new \Exception('JWT Token签发者不匹配');
            }
            return $payload;
        } catch (\Exception $e) {
            Log::error("验证JWT Token失败:", [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * @param string|null $name - 名称
     * @param $default - 默认值
     * @return mixed
     * @author cdyun(121625706@qq.com)
     * @desc 获取配置config
     */
    public static function getConfig(?string $name = null, $default = null): mixed
    {
        if (!is_null($name)) {
            return config('plugin.cdyun.webman-jwt.jwt.' . $name, $default);
        }
        return config('plugin.cdyun.webman-jwt.jwt');
    }

    /**
     * @return mixed
     * @author cdyun(121625706@qq.com)
     * @desc 获取密钥
     */
    private static function getSecretKey(): mixed
    {
        return self::getConfig('secret', 'secret_key');
    }

    /**
     * @return mixed
     * @author cdyun(121625706@qq.com)
     * @desc 获取加密算法
     */
    private static function getAlgorithm(): mixed
    {
        return self::getConfig('alg', 'HS256');
    }

    /**
     * @return mixed
     * @author cdyun(121625706@qq.com)
     * @desc JWT签发方标识
     */
    private static function getIss(): mixed
    {
        return self::getConfig('iss', 'cdyun');
    }
}