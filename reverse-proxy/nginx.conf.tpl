server {
    listen      80;
    listen [::]:80;
    server_name %fqdn_main% www.%fqdn_main%;

    return 301 https://%fqdn_main%$request_uri;
}

server {
  listen 443 ssl http2;
  listen [::]:443 ssl http2;

  server_name           %fqdn_main%;

  ssl_certificate      /etc/letsencrypt/cert.crt;
  ssl_certificate_key  /etc/letsencrypt/cert.key;

  gzip_types text/plain text/css application/json application/x-javascript
             text/xml application/xml application/xml+rss text/javascript;

  # Main website.
  location / {
    proxy_pass http://backend-web:8000;
    proxy_set_header Host $host;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
  }
}
