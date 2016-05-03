# MediaWiki Docker Image

Based on MediaWiki release 1.26.2

Installed extensions:

- Cite
- Echo
- Flow
- InputBox
- Interwiki
- News
- ParserFunctions
- Renameuser
- ReplaceText
- SyntaxHighlight_GeSHi
- VisualEditor
- WikiEditor

## Setup

For VisualEditor, you have to run `cd mediawiki/extensions/VisualEditor && git submodule update --init`.

## Upgrade

To run the `upgrade.php` script:

```
$ docker-compose run mediawiki php /var/www/html/w/maintenance/update.php
```