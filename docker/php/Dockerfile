FROM node:24.22.1-bookworm-slim AS node

RUN npm install -g npm@12.2.1


FROM php:8.4.27-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
 && docker-php-ext-install pdo_mysql zip

# Node.jsをコピー
COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules

# npm / npx
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
 && ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

# Composer
COPY --from=composer:2.10.3 /usr/bin/composer /usr/bin/composer
