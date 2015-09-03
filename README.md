![Relative Date for Kirby CMS](http://distantnative.com/remote/github/kirby-relativedate-github.png)  

[![Release](https://img.shields.io/github/release/distantnative/relative-date.svg)](https://github.com/distantnative/relative-date/releases)  [![Issues](https://img.shields.io/github/issues/distantnative/relative-date.svg)](https://github.com/distantnative/relative-date/issues) [![License](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://raw.githubusercontent.com/distantnative/relative-date/master/LICENSE)
[![Moral License](https://img.shields.io/badge/buy-moral_license-8dae28.svg)](https://gumroad.com/l/kirby-relativedate)

The Relative Date plugin for Kirby CMS displays date and time to a human-readable relative format. It converts your absolute date (and time) in something relative and more readable, e.g.: 

> 2 months 3 days ago  
> 5 hours 47 minutes 18 seconds from now  
 
**The plugin is free. However, I would really appreciate if you could support me with a [moral license](https://gumroad.com/l/kirby-relativedate)!**

#### Overview
1. [Installation](#install)  
1. [Usage](#use)  
2. [Options](#options)  
3. [Help & Improve](#helping)  
4. [Languages](#languages)  
5. [Known Issues)](#issues)  
6. [Version History](#history)  

# Installation <a id="install"></a>
1. [Download](https://github.com/distantnative/relative-date/archive/master.zip) the current release.
2. Copy everything to `site/plugins/relative-date/`.

To **update** to a higher version of this plugin, replace the files with the newer version.

# Usage <a id="use"></a>
You can either use it as field method:
```php
<?php echo $page->published()->relative() ?>
```

Or as [Kirbytext](http://getkirby.com/docs/content/text) tag:
```
Published: (relativedate: 2015-02-15)
```

Or with the `relativeDate()` helper function:
```
<?php echo relativeDate($page->modified()) ?>
```

# Options <a id="options"></a>

## Parameters

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
$args = array(
  'lang'      => 'es',
  'length'    => 1,
  'threshold' => 999999,
  'fuzzy'     => false
);
$page->published()->relative($args);
```

**In a Kirbytag**  
If you use the Kirbytext tag, this works as well:
```
(relativedate: 2015-02-15 lang: es length: 1 threshold: 99999 fuzzy: false)
```

## Global options

In addition to passing some options as parameters, you also can set some global options in your `sites/config/config.php`:

**Threshold <a id="threshold"></a>**  
Sometimes you only want relative dates for dates that are not too far in the past/future, but not for dates really far away. In that case you can set a threshold (in seconds). Only dates on the range of that threshold from the current time will be displayed as relative dates:

```php
c::set('relativedate.threshold', 604800);
```


**Length <a id="length"></a>**  
You can define how many date/time elements the phrase should entail. The default is 2 elements (e.g. '1 year 4 months' or '2 weeks 3 days' or '2 hours 34 minutes'). You can set your own phrase length in two ways:

```php
c::set('relativedate.length', 4);
```

**Conjunctions <a id="conjunctions"></a>**  
You can glue the date and time elements together with conjunctions instead of just spaces by either setting the option to `true` (relying on language files) or specifying a conjunction:

```php
c::set('relativedate.conjunction', 'et');
```

**Fuzzy <a id="fuzzy"></a>**  
Relative Date supports fuzzy expressions, which means that instead of the rather exact date difference one of the following expressions will be displayed: today, tomorrow/yesterday, next/last {weekday}, next/last week, next/last month:

```php
c::set('relativedate.fuzzy', false);
```

Fuzzy expressions are only supported by a few of the included languages yet (English, German, French, Spanish, Swedish, Catalan, Brazilian Portuguese).

**Default Language**  
You can also define the default fallback language (if not, it defaults to English):

```php
c::set('relativedate.lang', 'ja');
```

# Help & Improve <a id="helping"></a>
Help is always appreciated. Suggestions, ideas or bugs - let me please know by [opening an issue](https://github.com/distantnative/relative-date/issues).

In addition, if you think a language is missing, [let me know](https://github.com/distantnative/relative-date/issues/11). And if you can even help with translations, [head over here](https://github.com/distantnative/relative-date/issues/32).

# Languages supported <a id="languages"></a>

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

# Known Issues <a id="issues"></a>
- This plugin cannot be used with the Kirby's default date field as it is not chainable. Please use the plugin on a field named differently than `date`, e.g. `published`. As another workaround the `date` field could be passed directly to the `relativeDate()` helper function:
```php
<?php echo relativeDate($page->date('Y-m-d')) ?>
``` 

# Version History <a id="history"></a>
Check out the more or less complete [changelog](https://github.com/distantnative/relative-date/blob/master/CHANGELOG.md).
