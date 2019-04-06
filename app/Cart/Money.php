<?php 

namespace App\Cart;

use Money\Currency;
use NumberFormatter;
use Money\Money as BaseMoney;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;


class Money 
{
    protected $money;

    public function __construct($value)
    {
        $this->money = new BaseMoney($value, new Currency('IRR'));
    }

    public function amount()
    {
        return $this->money->getAmount();
    }

    public function formatted()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('fa_IR', NumberFormatter::CURRENCY, ''),
            new ISOCurrencies()
        );

        $formatterWithoutSpecialChars = preg_replace('/\p{C}+/u', "", $formatter->format($this->money)); 
        // return $formatter->format($this->money);
        return $formatterWithoutSpecialChars;
        // return $this->money;
    }
}