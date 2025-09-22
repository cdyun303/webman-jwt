<?php
/**
 * @desc jwt.php
 * @author cdyun(121625706@qq.com)
 * @date 2025/9/22 16:48
 */
return [
    //  JWT加密key
    'secret' => '30cb068135ea7a8c4cb91c7a6f732bc4',
    //  JWT签发方标识
    'iss' => 'cdyun',
    //  JWT过期时间1小时
    'exp' => 3600,
    //  JWT刷新过期时间15天
    'refresh_exp' => 1296000,
    //  JWT加密算法
    'alg' => 'HS256',
    ];
