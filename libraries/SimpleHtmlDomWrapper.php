<?php
include("simple_html_dom.php");

class SimpleHtmlDomWrapper{
  public static function str_get_html(
  	$str,
  	$lowercase = true,
  	$forceTagsClosed = true,
  	$target_charset = DEFAULT_TARGET_CHARSET,
  	$stripRN = true,
  	$defaultBRText = DEFAULT_BR_TEXT,
  	$defaultSpanText = DEFAULT_SPAN_TEXT)
  {
    return str_get_html(
    	$str,
      $lowercase,
      $forceTagsClosed,
      $target_charset,
      $stripRN,
      $defaultBRText,
      $defaultSpanText
    );
  }

  public static function file_get_html(
  	$url,
  	$use_include_path = false,
  	$context = null,
  	$offset = 0,
  	$maxLen = -1,
  	$lowercase = true,
  	$forceTagsClosed = true,
  	$target_charset = DEFAULT_TARGET_CHARSET,
  	$stripRN = true,
  	$defaultBRText = DEFAULT_BR_TEXT,
  	$defaultSpanText = DEFAULT_SPAN_TEXT)
  {
    return file_get_html(
      $url,
      $use_include_path,
      $context,
      $offset,
      $maxLen,
      $lowercase,
      $forceTagsClosed,
      $target_charset,
      $stripRN,
      $defaultBRText,
      $defaultSpanText
    );
  }
}
