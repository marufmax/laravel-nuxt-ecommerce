<?php

namespace App\Cart;

use Money\{Currencies\ISOCurrencies, Formatter\IntlMoneyFormatter, Money as BaseMoney, Currency};
use NumberFormatter;

class Money
{
    protected $money;
    
    public function __construct($value)
    {
        $this->money = new BaseMoney($value, new Currency('BDT'));
    }
    
    public function formatted()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('en-US', NumberFormatter::CURRENCY),
            new ISOCurrencies()
        );
        
        return $formatter->format($this->money);
    }
}
