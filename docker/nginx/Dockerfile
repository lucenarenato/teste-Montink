FROM nginx:alpine

COPY nginx.conf /etc/nginx/

RUN apk update \
    && apk upgrade \
    && apk --update add logrotate \
    && apk add --no-cache openssl \
    && apk add --no-cache bash

RUN apk add --no-cache curl \
    certbot \
    certbot-nginx

ENV TZ America/Sao_PauloENV TZ America/Sao_Paulo

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    echo $TZ > /etc/timezone && \
    apk add --no-cache openssl && \
    mkdir /etc/nginx/certificates && \
    openssl req \
    -x509 \
    -newkey rsa:2048 \
    -keyout /etc/nginx/certificates/key.pem \
    -out /etc/nginx/certificates/cert.pem \
    -days 365 \
    -nodes \
    -subj /CN=localhost && \
    mkdir /www && \
    mkdir -p /etc/ssl/certs && \
    if [ ! -f /etc/ssl/certs/dhparam.pem ]; then \
    openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048; \
    fi

RUN apk del tzdata && \
    rm -rf /var/cache/apk/*

RUN set -x ; \
    addgroup -g 82 -S www-data ; \
    adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

ARG PHP_UPSTREAM_CONTAINER=php-fpm
ARG PHP_UPSTREAM_PORT=9000

# Create 'messages' file used from 'logrotate'
RUN touch /var/log/messages

# Copy 'logrotate' config file
COPY logrotate/nginx /etc/logrotate.d/

# Set upstream conf and remove the default conf
RUN echo "upstream php-upstream { server ${PHP_UPSTREAM_CONTAINER}:${PHP_UPSTREAM_PORT}; }" > /etc/nginx/conf.d/upstream.conf \
    && rm /etc/nginx/conf.d/default.conf

# Criar diretório raiz
RUN mkdir -p /var/www/html

# Emitir auto-certificação
RUN openssl genrsa 2048 > server.key \
    && openssl req -new -key server.key -subj "/C=BR/ST=SAO PAULO/L=SAO PAULO/O=CAPSORTEIOS/OU=web/CN=CA CERTIFICATE" > server.csr \
    && openssl x509 -in server.csr -days 3650 -req -signkey server.key > server.crt \
    #  && openssl x509 -signkey CA.key -in CA.csr -req -days 3650 -out CA.pem \
    #  && cp CA.pem /etc/nginx/CA.pem \
    && cp server.crt /etc/nginx/server.crt \
    && cp server.key /etc/nginx/server.key \
    && chmod 755 -R /var/www/html \
    && chmod 644 /etc/nginx/server.key

ADD ./startup.sh /opt/startup.sh
RUN sed -i 's/\r//g' /opt/startup.sh
CMD ["/bin/bash", "/opt/startup.sh"]

EXPOSE 80 443
