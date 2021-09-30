拆解Dockerfile
# 系统命令
git
```
RUN apt-get update && apt-get install -y git
```

ps
```
RUN apt-get update && apt-get install -y procps
```

composer
```
# 方式1，不推荐
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
# 方式2，推荐
RUN curl -sfL https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && chmod +x /usr/bin/composer \
    && composer self-update 2.1.8 \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
```

supervisor
```
RUN apt-get update && apt-get install -y supervisor
#开机自启
CMD supervisord -c /etc/supervisor/supervisord.conf \
    && php-fpm
```

# php扩展
gd
```
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
```

zip
```
RUN apt-get update && apt-get install -y libzip-dev \
    && docker-php-ext-install zip
```

mysql
```
RUN docker-php-ext-install pdo pdo_mysql mysqli
```

redis
```
RUN pecl install redis-5.3.4 \
    && docker-php-ext-enable redis
```

xdebug
```
RUN pecl install xdebug-2.9.8 \
    && docker-php-ext-enable xdebug
```

swoole
```
RUN apt-get update && apt-get install -y libssl-dev \
        libcurl4-openssl-dev
        
RUN pecl install -D 'enable-sockets="no" enable-openssl="yes" enable-http2="yes" enable-mysqlnd="yes" enable-swoole-json="no" enable-swoole-curl="yes" enable-cares="yes"' swoole \
    && docker-php-ext-install sockets\
    && docker-php-ext-enable swoole
```

