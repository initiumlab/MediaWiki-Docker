// for mw-ocg-service
module.exports = function(config) {
  // URL to the Parsoid instance
  config.backend.bundler.parsoid_api = "http://parsoid:8000";
  config.redis.host = "redis";
  // Use the Parsoid "v3" API
  // The "domainname" should match the "domain" in the setMwApi
  // call in Parsoid's localsettings.js and the "domain" in mediawiki's
  // $wgVirtualRestConfig in LocalSettings.php
  config.backend.bundler.additionalArgs = [ '--domainname=mediawiki', '--api-version=parsoid3' ];
};