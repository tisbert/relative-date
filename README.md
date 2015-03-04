# Kirby 2 - Relative Date Plugin v0.9
Plugin for Kirby 2 CMS that coverts date and time to a human-readable relative format: Converts your absolute date (and time) in something relative and more readable, e.g.: 
```
2 months 3 days ago
5 hours 47 minutes 18 seconds from now
``
# Installation & Usage
1. [Download](https://github.com/distantnative/kirby-relativedate/archive/develop.zip) the current release.
2. Add the ```relative-date.php``` and ```lang``` folder to the ```site/plugins/relative-date/``` directory. You probably need to create the ```relative-date```folder.
3. Then use it on any date field, e.g.: 
```php
$page->published()->relative()
```

To **update** to a higher version just replace the same files by their newer version.

# Options
You can define how many date/time elements the phrase should entail. The default is 2 elements (e.g. '1 year 4 months' or '2 weeks 3 days' or '2 hours 34 minutes'). You can set your own phrase length in two ways:

**Globally in your ```sites/config/config.php```:**
```php
c::set('relativedate.length', 4);
```

**On a per case basis:**
```php
$page->published()->relative(4);
```

**You can also define the default fallback language (if not, it's English) in your ```sites/config/config.php```:**

```php
c::set('relativedate.default', 'ja');
```

# Fuzzy expressions <a id="fuzzy"></a>
Sometimes you don't want the exact days or hours, but something more fuzzy. To activate include this in oyur ```site/config/config.php```:

```php
c::set('relativedate.fuzzy', array(
    'FUZZYEXPRESSION',
    'FUZZYEXPRESSION',
    ));
```

Instead of ```FUZZYEXPRESSION``` you have to include the fuzzy expressions identifiers, which you want to be activated. At the moment the following fuzzy expression identifiers are available for some languages:

**English:**
- ```less than a minute ago```
- ```yesterday```
- ```tomorrow```

**German:**
- ```gestern```

# Help & Improve
Help is always appreciated. Suggestions, ideas or bugs - let me please know by [opening an issue](https://github.com/distantnative/kirby-relativedate/issues).

In addition, if you think a language is missing, [let me know](https://github.com/distantnative/kirby-relativedate/issues/11). And if you can even help with the translation, please provide the following information:
- Words (singular & plural) for second, minute, hour, day, week, month and year
- Terms that express A) that date & time are in the future (e.g. "1 hour from now") and B) that date & time are in the past (e.g. "3 days ago")
- Where to put these terms in relation to the date/time-phrase (before, after, in between?)

# Languages supported

- English (en) *[default]*
- Arabic (ar) *[experimental]*
- Dutch (nl)
- Finnish (fi)
- French (fr)
- German (de)
- Italian (it)
- Japanese (ja)
- Norwegian (no)
- Polish (pol)
- Portuguese (pt)
- Portuguese Brazilian (pt_BR)
- Russian (ru)
- Serbian (sr)
- Spanish (es)
- Swedish (sv)
- Thai (th)
- Turkish (tr)

Credits go to the [Laravel Date project](https://github.com/jenssegers/laravel-date/tree/master/src/lang) for their languages variables as well as [this localization guide](http://localization-guide.readthedocs.org/en/latest/l10n/pluralforms.html) for providing the plural set rules.

# Version history
**v0.8**
- Complete rewrite of logic for languages that feature multiple plural forms with specific rule sets (e.g. Russian)
- Fixed Russian localization
- Added support for Norwegian, Polish, Brazilian Portuguese, Finnish, Turkish, Serbian
- Added experimental support for Arabic

**v0.7**
- Added basic [fuzzy expression support](#fuzzy) 
- Fixed wrong language matching for years
- Code simplifications
