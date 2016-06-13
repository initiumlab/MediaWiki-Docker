FROM buildpack-deps:jessie

RUN set -x; \
    apt-get update \
    && apt-get install -y --no-install-recommends node npm \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /app
COPY mediawiki/parsoid /app
RUN cd /app && npm install --production

EXPOSE 8000

COPY docker/parsoid/localsettings.js /app/localsettings.js

CMD ["/usr/bin/nodejs", "/app/bin/server.js", "-n4"]