# Kirby 2 - Relative Date Plugin
Plugin for Kirby 2 CMS that coverts date and time to a human-readable relative format:

Converts your absolute date (and time) in something relative and more readable, like e.g. 2 months 3 days ago.

# Installation & Usage
Add the ```relative-date.php``` to your 'site/plugins/' folder. 
Then use it on any date field, e.g.: $page->published()->relative()

# Languages supported
So far this plugin supports:

- English
- German

If you can help with other languages, please open up an issue. The following information is necessary:

- Words (singular & plural) for second, minute, hour, day, week, month and year
- Terms that express A) that date & time are still ahead of the current time (e.g. "left" as in "5 minutes left") and B) that date & time are passed the current time (e.g. "ago" as in "3 days ago")
- The information if these terms have to be added before or after the actual relative date phrase
