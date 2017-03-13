<?php

  function checkKeyGen($data) {
    $info = array($data, $data, $data, $data);
    $bool = false;
    $conn = dbconn();
    $sql = "SELECT * FROM partners p, subscription_plans s, departments d, classes c
             WHERE p.partner_key = ? OR s.keygen = ? OR d.department_key = ? OR c.enrollment_key = ?
             LIMIT 1";
    $pdo = $conn->prepare($sql);
    $pdo->execute($info);
    $res = $pdo->fetchAll();

    if(count($res)==0) {
      $bool = true;
    }
    $conn = null;
    return $bool;
  }

  function generateKeyGen($num) {
    do {
      $keyGen = "";
      $alphaNumeric = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n",
                        "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B",
                      "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P",
                    "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3",
                  "4", "5", "6", "7", "8", "9", ];
      for ($i=0; $i < $num; $i++) {
        $keyGen = $keyGen.$alphaNumeric[rand(0, 61)];
      }
      $check = checkKeyGen($keyGen);
    } while(!$check);
    return $keyGen;
  }

  function timeIndReceprocate($var) {
    if($var == "AM") {
      $var = "PM";
    }
    else {
      $var = "AM";
    }
    return $var;
  }

  function timeconv($hour, $minute) {
    $timeind = "AM";
    if($hour > 11 && $hour < 24) {
      $timeind = timeIndReceprocate($timeind);
      $hour = $hour - 12;
    }
    elseif ($hour == 24) {
      $hour = $hour - 12;
    }
    $hour = makeItTwoChar($hour);
    $minute = makeItTwoChar($minute);

    $finaltime = $hour.":".$minute." ".$timeind;
    return $finaltime;
  }

  function makeItTwoChar($var) {
    if(strlen($var)<2) {
      $var = "0" .$var;
    }
    return $var;
  }

  function pr($val) {
    echo $val;
  }

  function checkNextBaseUrl($toLoc, $i) {
    if(isset($baseurl[$i])) {
      header('Location: /practicumhub/'.$loc.'');
    }
  }

  function convdays($days) {
    $conv = "";
    $counter = 0;
    foreach($days as $key) {
      $conv = $conv. $key;
      if($counter+1 != count($days))
        $conv = $conv. ", ";
      $counter++;
    }
    return $conv;
  }

  function myDateNow() {
    $arrMonth = ["January", "February", "March", "April", "May", "June", "July",
                  "August", "September", "October", "November", "December"];
    $date = date("d");
    $month = $arrMonth[date("m")-1];
    $year = date("Y");
    $fulldate = $date. " " .$month. ", " .$year;

    return $fulldate;
  }

  function incError($errtype = 'notfound') {
    switch ($errtype) {
      case 'notfound':
        require_once('app/views/errors/page404.php');
        break;

      case 'forbidden':
        require_once('app/views/errors/forbidden.php');
        break;

      case 'notsubscribbed':
        require_once('app/views/errors/notsubscribbed.php');
        break;

      default:
        break;
    }
  }

  function myMonth($datetime) {
    $getCom = strpos($datetime, ",");
    $getSpace = strpos($datetime, " ")+1;
    $month = substr($datetime, $getSpace, $getCom-$getSpace);
    return $month;
  }

  function myDate($datetime) {
    $getSpace = strpos($datetime, " ");
    $date = substr($datetime, 0, $getSpace);
    return $date;
  }

  function myYear($datetime) {
    $start = strpos($datetime, ", ")+2;
    $year = substr($datetime, $start, 4);
    return $year;
  }

  function myHour($datetime) {
    $start = strpos($datetime, "-")+2;
    $end = strpos($datetime, ":");
    $hour = substr($datetime, $start, $end-$start);
    return $hour;
  }

  function myMin($datetime) {
    $start = strpos($datetime, ":")+1;
    $end = strpos($datetime, " ", 3);
    $min = substr($datetime, $start, 2);
    return $min;
  }

  function myMeridiem($datetime) {
    $start = strpos($datetime, "M")-1;
    $amPm = substr($datetime, $start, 2);
    return $amPm;
  }

  function splitDateTime($d) {
    $result = [
      'date'      => myDate($d),
      'month'     => myMonth($d),
      'year'      => myYear($d),
      'hour'      => myHour($d),
      'minutes'   => myMin($d),
      'meridiem'      => myMeridiem($d)
    ];
    return $result;
  }

  function dateNowWithTime() {
    $result = [
      'date'      => date("d"),
      'month'     => date("F"),
      'year'      => date("Y"),
      'hour'      => date("h"),
      'minutes'   => date("i"),
      'meridiem'      => date("A")
    ];
    return $result;
  }

  function concatDateWithTime() {
    $time_now = dateNowWithTime();
    $t = $time_now['date']. " " .$time_now['month']. ", " .$time_now['year']. " - " .$time_now['hour']. ":" .$time_now['minutes']. " " .$time_now['meridiem'];
    return $t;
  }

  function concatDateWithTime2($time) {
    $time_now = $time;
    $t = $time_now['date']. " " .$time_now['month']. ", " .$time_now['year']. " - " .$time_now['hour']. ":" .$time_now['minutes']. " " .$time_now['meridiem'];
    return $t;
  }

  function countDutyTime($in, $out) {
    $minutes = 0;
    $months = ["January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"];
    // $inHour = ($in['meridiem'] == "PM")? $in['hour'] + 12: $in['hour'];
    // $outHour = ($out['meridiem'] == "PM")? $out['hour'] + 12: $out['hour'];
    if($in['meridiem'] == "PM") {
      $in['hour'] += 12;
      if($in['hour']>23) {
        $in['hour'] = 0;
      }
    }
    else {
      if($in['hour'] == 12) {
        $in['hour'] = 0;
      }
    }
    $inHour = $in['hour'];
    if($out['meridiem'] == "PM") {
      $out['hour'] += 12;
      if($out['hour']>23) {
        $out['hour'] = 0;
      }
    }
    else {
      if($out['hour'] == 12) {
        $out['hour'] = 0;
      }
    }
    $outHour = $out['hour'];
    $inMonth = array_search($in['month'], $months)+1;
    $outMonth = array_search($out['month'], $months)+1;
    while($in['year']<$out['year'] || $inMonth<$outMonth || $in['date']<$out['date'] || $inHour<$outHour || $in['minutes']<$out['minutes'] ) {
      $daycount = date("t", mktime(0, 0, 0, $inMonth, 1, $in['year']));
      $in['minutes']++;
      if($in['minutes']>59) {
        $in['minutes'] = 0;
        $inHour++;
        if($inHour>23) {
          $inHour = 0;
          $in['date']++;
          if($in['date']>$daycount) {
            $in['date'] = 1;
            $inMonth++;
            if($inMonth>12) {
              $inMonth = 0;
              $in['year']++;
            }
          }
        }
      }
      $minutes++;
    }
    return $minutes;
  }

  function getDayWeek($t) {
    $months = ["January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"];
    $m = array_search($t['month'], $months)+1;
    $res = date("l", mktime(0,0,0,$m,$t['date'],$t['year']));
    return $res;
  }

  function convHrMin($m) {
    $hr = makeItTwoChar(intval($m/60));
    $min = makeItTwoChar($m%60);
    $hrMin = [
      'hr' => $hr,
      'min' => $min
    ];
    return $hrMin;
  }

  function hourToMin($time) {
    return $time*60;
  }

  function minToDecimal($minutes) {
    return $minutes/60;
  }

?>
