ARG PHP_VERSION='8.1'

FROM serversideup/php:${PHP_VERSION}-fpm-nginx as base
ENV AUTORUN_ENABLED=false
ENV SSL_MODE=off

# ================
# Production Stage
# ================
FROM base as production

ENV APP_ENV=production
ENV APP_DEBUG=false

# Required Modules
RUN apt-get update && \
    apt-get install -y php${PHP_VERSION}-mysql php${PHP_VERSION}-gd libpng-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

USER $PUID:$PGID

# Copy source code from builder.
# - To ignore files or folders, use .dockerignore
COPY --chown=$PUID:$PGID . .
COPY --chown=$PUID:$PGID .env.example .env

RUN composer install --optimize-autoloader --no-dev --no-interaction --no-progress --ansi

# artisan commands
RUN php ./artisan key:generate && \
    php ./artisan view:cache && \
    php ./artisan route:cache && \
    php ./artisan config:cache && \
    php ./artisan storage:link

USER root:root