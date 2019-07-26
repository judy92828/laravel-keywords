<?php
namespace Jingjing\Keywords\Facades;

use Illuminate\Support\Facades\Facade;

class JKeywords extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'JKeywords';
  }
}