FROM node:0.12.14

RUN mkdir -p /app
COPY mediawiki/parsoid /app
RUN cd /app && npm install --production

EXPOSE 8000

COPY docker/parsoid/localsettings.js /app/localsettings.js

CMD ["/app/bin/server.js", "-n4"]