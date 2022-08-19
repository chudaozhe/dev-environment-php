# 启动
```
docker-compose up -d

#容器启动后，不代表里面的服务也准备就绪，里面的服务可能还需要等待片刻，比如：mysql第一次初始化
```
# 使用
nginx配置目录：`nginx/conf/conf.d`

代码目录：`data/www`

浏览器访问 `http://localhost/test.php`

# php
安装了哪些系统命令和php扩展？基于官方镜像`php:8.1.9-fpm`，详见 `php-fpm\dockerfile.md`

您可以根据自己的需要，新增或移除部分命令或扩展，然后build一个新容器镜像
```
cd php-fpm
docker build -t php:[镜像版本号] .
```

# mysql
官方镜像`mysql:8.0.26`，无修改
> 注意：如果mysql已经产生了数据，版本号8.0.26就不能随便改了，改之前需要通过脚本`data/apps/mysql/backup/backup.sh`备份一下

# nginx
官方镜像`nginx:1.21.3`，无修改

# redis 
官方镜像`redis:6.2.5`，无修改

# 正式环境
虽说这是开发环境，但用于正式环境也是没问题的。

mysql不建议用容器，可以考虑物理机单独部署或使用云服务rds

如果用于正式环境，建议新增一个docker-compose文件
`docker-compose-production.yml`
