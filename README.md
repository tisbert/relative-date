![Relative Date for Kirby CMS](http://distantnative.com/remote/github/kirby-relativedate-github.png)  

[![Release](https://img.shields.io/github/release/distantnative/relative-date.svg)](https://github.com/distantnative/relative-date/releases)  [![Issues](https://img.shields.io/github/issues/distantnative/relative-date.svg)](https://github.com/distantnative/relative-date/issues) [![Moral License](https://img.shields.io/badge/buy-moral_license-8dae28.svg)](https://gumroad.com/l/kirby-relativedate)

The Relative Date plugin for Kirby CMS displays date and time to a human-readable relative format. It converts your absolute date (and time) in something relative and more readable, e.g.: 

> 2 months 3 days ago  
> 5 hours 47 minutes 18 seconds from now  

#### Overview
1. [Requirements](#Requirements)
1. [Installation](#install)  
1. [Usage](#use)  
2. [Options](#options)  
4. [Languages](#languages)  
3. [Help & Improve](#helping)  
5. [Known Issues)](#issues)  
6. [Version History](#history)  


## Requirements <a id="Requirements"></a>
Kirby CMS 2.3.0+ and PHP 5.4+.


## Installation & Update <a id="Installation"></a>
1. [Download](https://github.com/distantnative/relative-date/archive/master.zip) the current release.
2. Add the files to `site/plugins/relative-date/` 


## Usage <a id="use"></a>
You can either use it as field method:
```php
<?= $page->published()->relativeDate() ?>
```

Or as [Kirbytext](http://getkirby.com/docs/content/text) tag:
```
Published: (relativeDate: 2015-02-15)
```

Or with the `relativeDate()` global helper function:
```
<?= relativeDate($page->modified()) ?>
```

## Options <a id="options"></a>

### Parameters

**Language**  
You can set some options on an per-use basis by passing them through as parameters. If you wan to get a specific language, just pass the locale as string:

```php
$page->published()->relative('es');
```

**Length**  
If you want to specify the number of elements, just pass the (length)[#length] as integer:

```php
$page->published()->relative(1);
```

**Multiple parameters**  
If you want to specify multiple options, pass them as an array:

```php
$page->published()->relative([
  'lang'      => 'es',
  'length'    => 1,
  'threshold' => 1600,
  'fuzzy'     => false
]);
```

**In a Kirbytag**  
If you use the Kirbytext tag, this works as well:
```
(relativeDate: 2015-02-15 lang: es length: 1 threshold: 1600 fuzzy: false)
```

### Global options

In addition to passing some options as parameters, you also can set some global options in your `site/config/config.php`:

**Threshold <a id="threshold"></a>**  
Sometimes you only want relative dates for dates that are not too far in the past/future, but not for dates really far away. In that case you can set a threshold (in seconds). Only dates on the range of that threshold from the current time will be displayed as relative dates:

```php
c::set('plugin.relativeDate.threshold', 604800);
```


**Length <a id="length"></a>**  
You can define how many date/time elements the phrase should entail. The default is 2 elements (e.g. '1 year 4 months' or '2 weeks 3 days' or '2 hours 34 minutes'). You can set your own phrase length in two ways:

```php
c::set('plugin.relativeDate.length', 4);
```

**Conjunctions <a id="conjunctions"></a>**  
You can glue the date and time elements together with conjunctions instead of just spaces by either setting the option to `true` (relying on language files) or specifying a conjunction:

```php
c::set('plugin.relativeDate.conjunction', 'et');
```

**Fuzzy <a id="fuzzy"></a>**  
Relative Date supports fuzzy expressions, which means that instead of the rather exact date difference one of the following expressions will be displayed: today, tomorrow/yesterday, next/last {weekday}, next/last week, next/last month:

```php
c::set('plugin.relativeDate.fuzzy', false);
```

Fuzzy expressions are only supported by a few of the included languages yet (English, Brazilian Portuguese, Catalan, French, German, Indonesian, Spanish, Swedish).

**Default Language**  
You can also define the default fallback language (if not, it defaults to English):

```php
c::set('plugin.relativeDate.lang', 'ja');
```

## Languages supported <a id="languages"></a>

- Arabic (ar)
- Bulgarian (bg)
- Catalan (ca)
- Chinese (zh)
- Chinese Taiwan (zh_TW)
- Czech (cs)
- Danish (da)
- Dutch (nl)
- English (en) *[default]*
- Finnish (fi)
- French (fr)
- German (de)
- Indonesian (id)
- Italian (it)
- Japanese (ja)
- Norwegian (no)
- Polish (pol)
- Portuguese (pt)
- Portuguese Brazilian (pt_BR) 
- Romanian (ro)
- Russian (ru)
- Serbian (sr)
- Spanish (es)
- Swedish (sv)
- Thai (th)
- Turkish (tr)


## Help & Improve <a id="Help"></a>
*If you have any suggestions for further configuration options, [please let me know](https://github.com/distantnative/oembed/issues/new).*

In addition, if you think a language is missing, [let me know](https://github.com/distantnative/relative-date/issues/11). And if you can even help with translations, [head over here](https://github.com/distantnative/relative-date/issues/32).

## Known Issues <a id="issues"></a>
- This plugin cannot be used with the Kirby's default date field as it is not chainable. Please use the plugin on a field named differently than `date`, e.g. `published`. As another workaround the `date` field could be passed directly to the `relativeDate()` helper function:
```php
<?= relativeDate($page->date('Y-m-d')) ?>
``` 


## Version history <a id="VersionHistory"></a>
You can find a more or less complete version history in the [changelog](docs/CHANGELOG.md).


## License
[MIT License](http://www.opensource.org/licenses/mit-license.php)


## Author
Nico Hoffmann - <https://nhoffmann.com>
