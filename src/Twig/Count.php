<?php


namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Count extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('count', [$this, 'getCount']),

        ];
    }
    public function getCount($parms)
    {
        return count($parms);
    }
}
