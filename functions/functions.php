<?php
function ftranslite($name){
    $name=preg_replace("/[\s+\.\,]/","-",$name);
    $name=preg_replace("/[\"\'!\?\(\)\:\$\%]/","",$name);
    static $trans=array(
    'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ж'=>'zh', 'з'=>'z',
    'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p',
    'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'ы'=>'i', 'э'=>'e', 'А'=>'A',
    'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ж'=>'ZH', 'З'=>'Z', 'И'=>'I',
    'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R',
    'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Ы'=>'I', 'Э'=>'E', 'ё'=>"yo", 'х'=>"h",
    'ц'=>"ts", 'ч'=>"ch", 'ш'=>"sh", 'щ'=>"shch", 'ъ'=>"", 'ь'=>"", 'ю'=>"yu", 'я'=>"ya",
    'Ё'=>"YO", 'Х'=>"H", 'Ц'=>"TS", 'Ч'=>"CH", 'Ш'=>"SH", 'Щ'=>"SHCH", 'Ъ'=>"", 'Ь'=>"",
    'Ю'=>"YU", 'Я'=>"YA"                                 
    );
    $strstring = strtr($name, $trans);
    return strtolower($strstring);
}

function utf8_to_cp1251($s) 
  { 
  if ((mb_detect_encoding($s,'UTF-8,CP1251')) == "UTF-8") 
    { 
    for ($c=0;$c<strlen($s);$c++) 
      { 
      $i=ord($s[$c]); 
      if ($i<=127) $out.=$s[$c]; 
      if ($byte2) 
        { 
        $new_c2=($c1&3)*64+($i&63); 
        $new_c1=($c1>>2)&5; 
        $new_i=$new_c1*256+$new_c2; 
        if ($new_i==1025) 
          { 
          $out_i=168; 
          } else { 
          if ($new_i==1105) 
            { 
            $out_i=184; 
            } else { 
            $out_i=$new_i-848; 
            } 
          } 
        $out.=chr($out_i); 
        $byte2=false; 
        } 
        if (($i>>5)==6) 
          { 
          $c1=$i; 
          $byte2=true; 
          } 
      } 
    return $out; 
    } 
  else 
    { 
    return $s; 
    } 
  } 
  
function clear_string($cl_str)
{
    $cl_str = strip_tags($cl_str);
    $cl_str = mysql_real_escape_string($cl_str);
    $cl_str = trim($cl_str);
    return $cl_str;
}

function remove_zeros_after_dot($number_value) {
  return rtrim(rtrim(number_format($number_value, 2, '.',' '), '\0'), '\.');
}

function calculate_age($birthday) {
  $birthday_timestamp = strtotime($birthday);
  $age = date('Y') - date('Y', $birthday_timestamp);
  if (date('md', $birthday_timestamp) > date('md')) {
    $age--;
  }
  return $age;
}

function corrected_date($date) {
  $corr_date = $date;
  
  preg_match('/(?P<year>\d+)-(?P<month>\d+)-(?P<day>\d+)/', $corr_date, $matches);

  $date_day = $matches['day'];
  $date_month = $matches['month'];
  $date_year = $matches['year'];

  return $date_day.'.'.$date_month.'.'.$date_year;
} 

function corrected_date_with_text_month($date) {
  $corr_date = $date;
  
  preg_match('/(?P<year>\d+)-(?P<month>\d+)-(?P<day>\d+)/', $corr_date, $matches);

  $date_day = $matches['day'];
  $date_month = $matches['month'];
  $date_year = $matches['year'];

  switch ($date_day) {
    case '01':
      $date_day = 1;
      break;

    case '02':
      $date_day = 2;
      break;

    case '03':
      $date_day = 3;
      break;

    case '04':
      $date_day = 4;
      break;

    case '05':
      $date_day = 5;
      break;

    case '06':
      $date_day = 6;
      break;

    case '07':
      $date_day = 7;
      break;

    case '08':
      $date_day = 8;
      break;

    case '09':
      $date_day = 9;
      break;

    default:
      break;
  }

  switch ($date_month) {
    case '01':
      $date_month_text = "января";
      break;

    case '02':
      $date_month_text = "февраля";
      break;

    case '03':
      $date_month_text = "марта";
      break;

    case '04':
      $date_month_text = "апреля";
      break;

    case '05':
      $date_month_text = "мая";
      break;

    case '06':
      $date_month_text = "июня";
      break;

    case '07':
      $date_month_text = "июля";
      break;

    case '08':
      $date_month_text = "августа";
      break;

    case '09':
      $date_month_text = "сентября";
      break;

    case '10':
      $date_month_text = "октября";
      break;

    case '11':
      $date_month_text = "ноября";
      break;

    case '12':
      $date_month_text = "декабря";
      break;
    
    default:
      $date_month_text = "[месяца нет]";
      break;
  }

  return $date_day.'&nbsp;'.$date_month_text.'&nbsp;'.$date_year;
}

function rounding_number_by_places($number_val) {
  $number = $number_val;
  $result_number = $number;

  if ($number < 1000)
    return $result_number;
  elseif ($number > 999 && $number < 1000000) {
    $result_number = bcdiv($number / 1000, 1, 1).'K';
    return $result_number;
  }elseif ($number > 999999) {
    $result_number = bcdiv($number / 1000000, 1, 1).'M';
    return $result_number;
  }
}

function generateRandomString($length = 50) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }

  return $randomString;
}

function cut_string_to_N_character($str, $n) {
  return (mb_strwidth($str) > $n) ? mb_strimwidth($str, 0, $n, "...") : $str;
}
?>