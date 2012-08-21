<?php

namespace Custom;

final class Url
{
  public static function Slugify($str)
  {
    $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
    $slug = preg_replace('~[^\\pL\d]+~u', '-', $str);
    $slug = trim($slug, '-');
    if (function_exists('iconv')) {
      $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
    }
    $slug = strtolower($slug);
    $slug = preg_replace('~[^-\w]+~', '', $slug);

    return $slug;
  }
}
