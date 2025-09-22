Webman JWT插件
=====

### 安装

```
composer require cdyun/webman-jwt
```

### 例子

引入文件:

```PHP
use Cdyun\WebmanJwt\JwtEnforcer;
```
生成TOKEN
```PHP
JwtEnforcer::generateToken($payload);
```

验证TOKEN

```PHP
JwtEnforcer::validateToken($token);
```
获取配置Config

```PHP
JwtEnforcer::getConfig($name , $default);
```
