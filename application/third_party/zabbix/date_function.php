<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    // $diff->w = floor($diff->d / 7);
    // $diff->d -= $diff->w * 7;
    $string = array(
        // 'y' => 'a',
        'm' => 'M',
        // 'w' => 'S',
        'd' => 'd',
        'h' => 'h',
        'i' => 'm',
        // 's' => 's',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . $v;
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(' ', $string) : 'agora';
}

function time2string($timeline) {
    $periods = array('d' => 86400, 'h' => 3600, 'm' => 60, 's' => 1);
    $ret = "";
    foreach($periods AS $name => $seconds){
        $num = floor($timeline / $seconds);
        $timeline -= ($num * $seconds);
        // $ret .= $num.' '.$name.(($num > 1) ? 's' : '').' ';
        $ret .= $num.''.$name.' ';
    }

    return trim($ret);
}
?>