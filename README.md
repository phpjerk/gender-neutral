PHPJerk's Gender Neutral Library v1
==============

Simple library that takes your text and removes all gender specific pronouns.

## Install
Open up that composer.json and drop this
```
	"phpjerk/gender-neutral": "dev-master"
```

## Usage
```php
	$nu = new Phpjerk\GenderNeutral\GenderNeutral;

	$text = "Read errors are reported only if nsent==0, otherwise we return nsent. The user needs to know that some data has already been sent, to stop him from sending it twice.";

	echo $nu->neutralize($text);
```

You can also change the 'bad' words and the 'good' word to replace it.
```php
	$nu->setNonoWords(['ducky', 'creamy', 'Brad Pitt']);
	$nu->setGoodWord('scrumdiddlyumptious');
```
