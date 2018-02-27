range
=====
```
Oh, give me a home where the buffalo roam
Where the deer and the antelope play
Where seldom is heard a discouraging word
And the skies are not cloudy all day
```
-- [Home on the Range](http://en.wikipedia.org/wiki/Home_on_the_Range)

The inspiration for this library came from a discussion by [Martin Fowler](https://web.archive.org/web/20101220225210/http://martinfowler.com/ap2/range.html).

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/texdc/range/master.svg?style=flat-square)](https://travis-ci.org/texdc/range)
[![Coverage Status](http://img.shields.io/coveralls/texdc/range.svg?style=flat-square)](http://img.shields.io/coveralls/texdc/range.svg)

install
-------
[Composer](https://getcomposer.org):
```sh
composer require texdc/range @stable
```

examples
--------
##### Range
Ranges provide simple validation and iteration.
```php
use texdc\range\DateRange;

$dateRange = new DateRange(new DateTime, new DateTime('+1 month'));

assert($dateRange->includes(new DateTime('+3 days')));

echo $dateRange->getSpan()->days;

foreach ($dateRange as $day) {
    echo $day->format('l, F jS, Y');
}
```

Ranges can also be compared against each other.
```php
use texdc\range\IntegerRange;

$range1 = new IntegerRange(1, 5);
$range2 = new IntegerRange(8, 3);
$range3 = new IntegerRange(5, 8);

assert($range1->overlaps($range2));
assert($range2->isContraryTo($range1));
assert($range3->abuts($range2));
assert($range1->begins(IntegerRange::merge($range1, $range3)));
assert($range3->ends(IntegerRange::combine([$range1, $range3])));
```
See the tests for more comparisons!

##### Enablement
Enablements leverage a range for more robust alternatives to simple boolean flags.
```php
use texdc\range\DateEnablement;

class DatedBannerAd extends AbstractBannerAd
{
    /**
     * @var DateEnablement
     */
    private $enablement;
    
    // ...
    
    public function render()
    {
        if ($this->enablement->isEnabled()) {
            return parent::render();
        }
    }
}
```
