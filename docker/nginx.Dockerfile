FROM node:15.5-alpine AS assets-build

WORKDIR /var/www/html

COPY . /var/www/html/

RUN npm ci
RUN npm run development

FROM nginx:1.19-alpine AS nginx

COPY /docker/vhost.conf /etc/nginx/conf.d/default.conf
COPY --from=assets-build /var/www/html/public /var/www/html/