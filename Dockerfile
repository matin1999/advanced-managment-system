FROM openswoole/swoole:4.12.1-php8.1

WORKDIR /app

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install php extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl

RUN composer selfupdate

COPY composer.json /app/

RUN composer install --prefer-dist --no-scripts

COPY . /app

RUN chmod +x entrypoint.sh
ENTRYPOINT ["./entrypoint.sh"]
EXPOSE 587/tcp

