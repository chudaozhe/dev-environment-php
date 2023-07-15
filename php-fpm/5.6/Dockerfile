FROM php:5.6.40-fpm
RUN echo "deb http://mirrors.cloud.tencent.com/debian-archive/debian stretch main" > /etc/apt/sources.list
RUN echo "deb http://mirrors.cloud.tencent.com/debian-archive/debian-security stretch/updates main" >> /etc/apt/sources.list
RUN apt-get update && apt-get install -y git procps inetutils-ping net-tools wget\
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql mysqli mysql zip \
    && wget http://pecl.php.net/get/redis-2.2.4.tgz -P /tmp && pecl install /tmp/redis-2.2.4.tgz && rm -rf  /tmp/redis-2.2.4.tgz \
    && docker-php-ext-enable redis \
    && curl -sfL https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && chmod +x /usr/bin/composer \
    && composer self-update 2.0.6 \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

#构建
#docker build -f Dockerfile5.6.40-work -t php:5.6.40-fpm-v1.0 .
