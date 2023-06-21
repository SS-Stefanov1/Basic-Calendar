<?php
include getenv('DOCUMENT_ROOT') . "/index.php";
include getenv('DOCUMENT_ROOT') . "/config.php";
session_start();

function build_calendar($month, $year, $dateArray)
{

    $month = date('m');
    $year = date('Y');
    $day = date('d');

    $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, $day, $year);

    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);

    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];

    $calendar = "<table class='calendar_table'>";
    $calendar .= "<caption>$monthName $year</caption>";
    $calendar .= "<tr>";

    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $currentDay = 1;
    $calendar .= "</tr><tr>";

    if ($dayOfWeek > 0) {
        $calendar .= "<td colspan='$dayOfWeek' class='not-month'>&nbsp;</td>";
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
/*
$ap_counter = array();

$ap_query = mssql_query("SELECT count(ap_hour) as total FROM CalendarProject WHERE day = '" . $currentDay . "'");
$ap_count = mssql_num_rows($ap_query);
$ap_left = $total_apps - $ap_count;
 */
    while ($currentDay <= $numberDays) {

        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 1, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        #echo " $currentDay :";
        #echo " $ap_count /";
        #var_dump($apps_left);

        if ($date == date("Y-m-d")) {
            $calendar .= "<td class='day today' rel='$date'><span class='today-date'>$currentDay </span><p style='text-align: center; margin-top: 14%;'>Appointments Available: $ap_left</p></td>";
        } else if ($dayOfWeek >= 5) {
            $calendar .= "<td class='day_wk' rel='$date'><span class='day-date'>$currentDay</span><p style='text-align: center; margin-top: 14%;'>Appointments Available: $ap_left</p></td>";
        } else {
            $calendar .= "<td class='day' rel='$date'><span class='day-date'>$currentDay</span><p style='text-align: center; margin-top: 14%;'>Appointments Available: $ap_left</p></td>";
        }

        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        $calendar .= "<td colspan='$remainingDays' class='not-month'>&nbsp;</td>";
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";

    return $calendar;

}

echo build_calendar($month, $year, $dateArray);
