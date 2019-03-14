FROM nginx

ARG FQDN_MAIN=mollemo.test
ENV FQDN_MAIN "$FQDN_MAIN"

COPY nginx.conf.tpl /etc/nginx/conf.d/default.conf.tpl

RUN sed -i 's/%fqdn_main%/'${FQDN_MAIN}'/g' /etc/nginx/conf.d/default.conf.tpl

RUN cp /etc/nginx/conf.d/default.conf.tpl /etc/nginx/conf.d/default.conf
