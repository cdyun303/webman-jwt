Webman JWT插件
=====

### 安装

```
composer require cdyun/webman-jwt
```

### 例子

引入文件:

```PHP
use Cdyun\WebmanJwt\JwtService;
```
生成TOKEN
```PHP
JwtService::generateToken($payload);
```

验证TOKEN

```PHP
JwtService::validateToken($token);
```
获取配置Config

```PHP
JwtService::getConfig($name , $default);
```
