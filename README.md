# MediaWiki Docker Image

Based on MediaWiki release [1.26.2](https://www.mediawiki.org/wiki/Release_notes/1.26#MediaWiki_1.26.2).

Installed extensions:

- [Cite](https://www.mediawiki.org/wiki/Extension:Cite)
- CustomParser
- [Echo](https://www.mediawiki.org/wiki/Extension:Echo)
- [Editcount](https://www.mediawiki.org/wiki/Extension:Editcount)
- [Flow](https://www.mediawiki.org/wiki/Extension:Flow)
- [InputBox](https://www.mediawiki.org/wiki/Extension:InputBox)
- [Interwiki](https://www.mediawiki.org/wiki/Extension:Interwiki)
- [LookupUser](https://www.mediawiki.org/wiki/Extension:LookupUser)
- [News](https://www.mediawiki.org/wiki/Extension:News)
- [ParserFunctions](https://www.mediawiki.org/wiki/Extension:ParserFunctions)
- [Renameuser](https://www.mediawiki.org/wiki/Extension:Renameuser)
- [ReplaceText](https://www.mediawiki.org/wiki/Extension:ReplaceText)
- [SyntaxHighlight_GeSHi](https://www.mediawiki.org/wiki/Extension:SyntaxHighlight)
- [VisualEditor](https://www.mediawiki.org/wiki/Extension:VisualEditor)
- [WikiEditor](https://www.mediawiki.org/wiki/Extension:WikiEditor)

## Setup

For VisualEditor, you have to run `cd mediawiki/extensions/VisualEditor && git submodule update --init`.

## Upgrade

To run the `upgrade.php` script:

```
$ docker-compose run mediawiki php /var/www/html/w/maintenance/update.php
```

## License

MIT License