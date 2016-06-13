FROM node:0.12.14
ENV LC_ALL          C.UTF-8
ENV LANG            en_US.UTF-8
ENV LANGUAGE        en_US.UTF-8

RUN echo "deb http://ftp.jp.debian.org/debian jessie main" > /etc/apt/sources.list

RUN apt-get update \
  && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
     texlive-xetex texlive-latex-recommended \
     texlive-latex-extra texlive-generic-extra \
     texlive-fonts-recommended texlive-fonts-extra \
     fonts-hosny-amiri fonts-farsiweb fonts-nafees \
     fonts-arphic-uming fonts-arphic-ukai fonts-droid fonts-baekmuk \
     texlive-lang-all latex-xcolor \
     poppler-utils imagemagick librsvg2-bin libjpeg-progs \
     djvulibre-bin zip unzip \
     inkscape lmodern \
  && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /app/
COPY mediawiki/ocg/ /app/

RUN cd /app/mw-ocg-service && npm install --production
RUN cd /app/mw-ocg-bundler && npm install --production
RUN cd /app/mw-ocg-latexer && npm install --production
RUN cd /app/mw-ocg-texter && npm install --production

EXPOSE 17080

COPY docker/ocg/localsettings.js /app/
WORKDIR /app/mw-ocg-service
CMD ["/app/mw-ocg-service/mw-ocg-service.js", "-c", "/app/localsettings.js"]