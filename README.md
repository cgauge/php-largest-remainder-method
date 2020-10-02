# Largest Remainder Method ➗

This library provides a simple way to calculate percentages using the Largest Remainder Method.
[Learn more](https://en.wikipedia.org/wiki/Largest_remainder_method).

## Installation

```bash
composer require customergauge/remainder
```

## Usage

```php
use CustomerGauge\Math\Remainder\Remainder;

$remainder = new Remainder([1, 1, 1]);

$remainder->round(2); // [0.34, 0.33, 0.33]
```

In simple terms, the goal of the Largest Remainder Method is to make
sure that when calculating the weight of each _seat_ in the data set,
the aggregated percentage will not be 99.99 or 100.01.

The first example above is arbitrary and end up rounding up only the
first record so that `0.34 + 0.33 + 0.33 = 1`, however not always
the decision is arbitrary.

```php
use CustomerGauge\Math\Remainder\Remainder;

$remainder = new Remainder([92, 93, 70]);

$remainder->round(2); // [0.36, 0.37, 0.27]
```

As we can see, `0.36 + 0.37 + 0.27 = 1`, however using standard
rounding, the result would have been different. To demonstrate that,
let's calculate `92 + 93 + 70 = 255`. Each value takes the following
percentage of the whole:


| Value | Percentage   | Round | Largest Remainder Method |
|-------|--------------|-------|--------------------------|
| 92    | 0.3607843137 | 0.36  | 0.36 |
| 93    | 0.3647058823 | 0.36  | 0.37 |
| 70    | 0.2745098039 | 0.27  | 0.27 |

As we can see from the table above, standard rounding end up
losing one percentage point because all three numbers round
down. The Largest Remainder Method will scan the values that will
be discarded (**0.36**~~07843137~~, **0.36**~~47058823~~, 
**0.27**~~45098039~~) and prioritize the ones with the largest
contribution. In this case, the 2nd value will discard `47058823`,
which is the largest value discarded. That makes it viable for
round up to fill the gap.

The fact that `93` is also the largest value does not necessarily
have a direct connection to the option being rounded up. We can
try the same example again using a much smaller number. Take
`92 + 32 + 70 = 194`.

| Value | Percentage   | Round | Largest Remainder Method |
|-------|--------------|-------|--------------------------|
| 92    | 0.4742268041 | 0.47  | 0.47 |
| 32    | 0.1649484536 | 0.16  | 0.17 |
| 70    | 0.3608247422 | 0.36  | 0.36 |