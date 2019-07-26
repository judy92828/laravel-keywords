<?php

namespace JingJing\Keywords;

class NotAllowStr
{
  /**
   * @describe 数组生成正则表达式
   * @param array $words
   * @return string
   */
  protected static function generateRegularExpression($string)
  {
    return "/$string/i";
  }

  /**
   * @describe 字符串 生成正则表达式
   * @param array $words
   * @return string
   */
  protected function generateRegularExpressionString($string)
  {
    $str_arr[0] = $string;
    $str_new_arr = array_map('preg_quote', $str_arr);
    return $str_new_arr[0];
  }

  /**
   * 匹配词语时候包含|
   * @param $NotAllowStr
   * @return string
   */
  public function checkString($NotAllowStr)
  {
    if (strstr($NotAllowStr, '|') == false) {
      return $NotAllowStr . "|";
    } else {
      return $NotAllowStr;
    }
  }

  /**
   * 违禁关键词进行匹配
   * @param $banned
   * @param $string
   * @param int $lenght
   * @return array
   */
  public function check_words($string, $NotAllowStr, $lenght = 1)
  {
    $match_banned = array();
    $NotAllowStr = $this->checkString($NotAllowStr);
    //循环查出所有敏感词
    $new_banned = strtolower($this->generateRegularExpression($NotAllowStr));
    $i = 0;
    do {
      $matches = null;
      if (!empty($new_banned) && preg_match($new_banned, $string, $matches)) {
        $isempyt = empty($matches[0]);
        if (!$isempyt) {
          $match_banned = array_merge($match_banned, $matches);
          $matches_str = strtolower($this->generateRegularExpressionString($matches[0]));
          $new_banned = str_replace("|" . $matches_str . "|", "|", $new_banned);
          $new_banned = str_replace("/" . $matches_str . "|", "/", $new_banned);
          $new_banned = str_replace("|" . $matches_str . "/", "/", $new_banned);
        }
      }
      $i++;
      if ($i > $lenght) {
        $isempyt = true;
        break;
      }
    } while (count($matches) > 0 && !$isempyt);
//查出敏感词
    if ($match_banned) {
      return $match_banned;
    }
//没有查出敏感词
    return array();
  }
}