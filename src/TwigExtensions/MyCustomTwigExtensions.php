<?php 
namespace App\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyCustomTwigExtensions extends AbstractExtension
{
   public function getFilters()
   {
    return [
        new TwigFilter('defaultImage',[$this,'defaultImage'])
    ];
   }
   public function defaultImage(string $path): string{
    if(strlen(trim($path)) == 0){
        return '2018-05-08_4thIndustrial_c_400x275.jpg';
    }
    return $path;
   }
 
}