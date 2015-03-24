# Kirby 2 - Relative Date Plugin v1.1
Plugin for Kirby 2 CMS that coverts date and time to a human-readable relative format: Converts your absolute date (and time) in something relative and more readable, e.g.: 

> 2 months 3 days ago  
> 5 hours 47 minutes 18 seconds from now  
 
#### Overview
1. [Installation & Usage](#install)  
2. [Options](#options)  
3. [Heping & Improving](#helping)  
4. [Languages](#languages)  
5. [Known Issues)](issues)  
6. [Version History](#history)  


# Installation & Usage <a id="install"></a>
1. [Download](https://github.com/distantnative/kirby-relativedate/archive/develop.zip) the current release.
2. Add the `relative-date.php` and `lang` folder to the `site/plugins/relative-date/` directory. You probably need to create the `relative-date` folder.
3. Then use it on any date field, e.g.: 
```php
$page->published()->relative()
```

To **update** to a higher version just replace the same files by their newer version.


# Options <a id="options"></a>

### Parameters

You can set some options on an per-use basis by passing them through as parameters. If you wan to get a specific language, just pass the locale as string:

```php
$page->published()->relative('es');
```

If you want to specify the number of elements, just pass the (length)[#length] as integer:

```php
$page->published()->relative(1);
```

If you want to specify multiple options, pass them as an array:

```php
$args = array(
  'lang'      => 'es',
  'lenght'    => 1,
  'threshold' => 999999,
  'fuzzy'     => false
);
$page->published()->relative($args);
```

### Global options

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

**Fuzzy <a id="fuzzy"></a>**  
Relative Date supports fuzzy expressions, which means that instead of the rather exact date difference one of the following expressions will be displayed: today, tomorrow/yesterday, next/last {weekday}, next/last week, next/last month:

```php
c::set('relativedate.fuzzy', false);
```

Fuzzy expressions are only supported by a few of the included languages yet (English, German, French).

**Default Language**  
You can also define the default fallback language (if not, it defaults to English):

```php
c::set('relativedate.lang', 'ja');
```

# Helping & Improving <a id="helping"></a>
Help is always appreciated. Suggestions, ideas or bugs - let me please know by [opening an issue](https://github.com/distantnative/kirby-relativedate/issues).

In addition, if you think a language is missing, [let me know](https://github.com/distantnative/kirby-relativedate/issues/11). And if you can even help with translations, [head over here](https://github.com/distantnative/kirby-relativedate/issues/20).

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
- This plugin cannot be used with the Kirby's default date field as it is not chainable. Please use the plugin on a field named differently than `date`, e.g. `published`.

# Version History <a id="history"></a>
**v1.1**
- Moved plugin logic to relativeTimeDate class
- Improved parameter handling
- Added option to specify a different language as the current
- Systemized and cleaned up language files
- Added support for Catalan
- Added language support for gendered fuzzy expressions (already enable in French, Spanish, Brazilian Portuguese and Catalan)

**v1.0**
- Rewritten human readable & fuzzy expression logic
- Switched to using DateTime
- Added Romanian support

**v0.9**
- Added [threshold option](#threshold)
- Complete rewrite [fuzzy expression](#fuzzy) logic, located it to ```site/config/config.php```
- Added Czech, Bulgarian, Chinese, Chinese Taiwan, Danish support
- Improved minor things on Thai translation

**v0.8**
- Complete rewrite of logic for languages that feature multiple plural forms with specific rule sets (e.g. Russian)
- Fixed Russian localization
- Added support for Norwegian, Polish, Brazilian Portuguese, Finnish, Turkish, Serbian
- Added experimental support for Arabic

**v0.7**
- Added basic [fuzzy expression support](#fuzzy) 
- Fixed wrong language matching for years
- Code simplifications
