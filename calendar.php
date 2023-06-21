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

    while ($currentDay <= $numberDays) {

        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 1, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        $app_hours = array(
            1 => '09:00',
            2 => '09:30',
            3 => '10:00',
            4 => '10:30',
            5 => '11:00',
            6 => '11:30',
            7 => '12:00',
            8 => '12:30',
            9 => '13:00',
            10 => '13:30',
            11 => '14:00',
            12 => '14:30',
            13 => '15:00',
            14 => '15:30',
            15 => '16:00',
            16 => '16:30',
            17 => '17:00',
            18 => '17:30',
        );

        $sql = mssql_query("SELECT day,ap_hour FROM CalendarProject WHERE day = $currentDay");

        while ($row = mssql_fetch_assoc($sql)) {
            if (array_key_exists($row['ap_hour'], $app_hours)) {
                unset($app_hours[$row['ap_hour']]);
            }
        }

        #var_dump($test_count);

        if ($date == date("Y-m-d")) {
            $calendar .= "<td class='day today' rel='$date'><span class='today-date'>$currentDay </span><p style='text-align: center; margin-top: 14%;'><a style='text-decoration: none;' style='text-decoration: none;' href='/hours.php' id='no-link'>Appointments Available: <font color='green'>" . count($app_hours) . "</font></a></p></td>";
        } else if ($dayOfWeek >= 5) {
            $calendar .= "<td class='day_wk' rel='$date'><span class='day-date'>$currentDay</span><p style='text-align: center; margin-top: 14%;'><a class='hyper' href='/hours.php' id='no-link'>Appointments Available: <font color='green'>" . count($app_hours) . "</font></a></p></td>";
        } else {
            $calendar .= "<td class='day' rel='$date'><span class='day-date'>$currentDay</span><p style='text-align: center; margin-top: 14%;'><a style='text-decoration: none;' href='/hours.php' id='no-link'>Appointments Available: <font color='green'>" . count($app_hours) . "</font></a></p></td>";
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
