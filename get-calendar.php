<?php

require_once('config.php');

function get_string_between($string, $start, $end){
	$string = " ".$string;
	$ini = strpos($string,$start);
	if ($ini == 0) return "";
	$ini += strlen($start);   
	$len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}

// get cal xml
$cal_xml_raw = file_get_contents(config::$cal_url . '?orderby=starttime&sortorder=ascending&futureevents=true&fields=entry(title,summary)');
$cal_xml = new SimpleXMLElement($cal_xml_raw);

// find next 3 events
if ($cal_xml) {
    $json = [];
    foreach ($cal_xml->entry as $entry) {
        // get date string
        $date_string = get_string_between($entry->summary,'When: ','<br>');
        $date_string = str_ireplace("&nbsp;\n", ' ', $date_string);
        $date_string = trim(preg_replace('/.DT/','', $date_string));
        // if date string contains ' to ', split on that
        if (strpos($date_string, ' to ') > -1) {
            $date_split = explode(' to ', $date_string);
            $entry->date_start = strtotime($date_split[0]);
            $entry->date_end = strtotime($date_split[1]);
        } else {
            $entry->date_start = strtotime($date_string);
        }
        // remove summary
        unset($entry->summary);
        // add to json data
        $json[] = $entry;
    }

    echo json_encode($json, JSON_PRETTY_PRINT);
}
