# Kirby 2 - Relative Date Plugin v0.3
Plugin for Kirby 2 CMS that coverts date and time to a human-readable relative format: Converts your absolute date (and time) in something relative and more readable, like e.g. 2 months 3 days ago.

# Installation & Usage
1. Add the ```relative-date.php``` and ```relative-date-lang.php``` to your ```site/plugins/``` folder. You can also move them to a subfolder (e.g. called ```relative-date```) within the ```plugins``` directory.
2. Then use it on any date field, e.g.: 
```php
$page->published()->relative()
```

# Options
You can define how many date/time elements the phrase should entail. The default is 2 elements (e.g. '1 year 4 months' or '2 weeks 3 days' or '2 hours 34 minutes'). You can set your own phrase length in tow ways:

**Globally in your ```sites/config/config.php```:**
```php
c::set('relativedate.length', 4);
```

**On a per case basis:**
```php
$page->published()->relative(4);
```

# Help & Improve
Help is always appreciated. Suggestions, ideas or bugs - let me please know by [opening an issue](https://github.com/distantnative/kirby-relativedate/issues).

In addition, if you think a language is missing and you can help, please provide the following information:
- Words (singular & plural) for second, minute, hour, day, week, month and year
- Terms that express A) that date & time are in the future (e.g. "1 hour from now") and B) that date & time are in the past (e.g. "3 days ago")
- Where to put these terms in relation to the date/time-phrase (before, after, in between?)

# Languages supported

- English (en)
- French (fr)
- German (de)
- Italian (it)
- Spanish (es)
- Swedish (sv)
- Thai (th)
