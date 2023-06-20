<html>
<head>
 <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
 <style>
  body{font-family: Lato;}
  caption{font-size: 22pt; margin: 10px 0 20px 0; font-weight: 700;}
  table.calendar{width:100%; border:1px solid #000;}
  td.day{width: 14%; height: 140px; border: 1px solid #000; vertical-align: top;}
  td.day span.day-date{font-size: 14pt; font-weight: 700;}
  th.header{background-color: #003972; color: #fff; font-size: 14pt; padding: 5px;}
  .not-month{background-color: #a6c3df;}
  td.today {background-color:#efefef;}
  td.day span.today-date{font-size: 16pt; background-color: red !important;}
 </style>

</head>

</html>
<?php

function build_calendar($month, $year, $dateArray)
{

    $month = date('m');
    $year = date('Y');
    $day = date('d');

    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0, 0, 0, $month, $day + 1, $year);

    // How many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers

    $calendar = "<table class='calendar'>";
    $calendar .= "<caption>$monthName $year</caption>";
    $calendar .= "<tr>";

    // Create the calendar headers

    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    // Create the rest of the calendar
    // Initiate the day counter, starting with the 1st.

    $currentDay = 1;
    $calendar .= "</tr><tr>";

    // The variable $dayOfWeek is used to
    // ensure that the calendar
    // display consists of exactly 7 columns.

    if ($dayOfWeek > 0) {
        $calendar .= "<td colspan='$dayOfWeek' class='not-month'>&nbsp;</td>";
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {
        // Seventh column (Saturday) reached. Start a new row.

        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 1, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        if ($date == date("Y-m-d")) {
            $calendar .= "<td class='day today' rel='$date'><span class='today-date'>$currentDay</span></td>";
        } else {
            $calendar .= "<td class='day' rel='$date'><span class='day-date'>$currentDay</span></td>";

        }
        // Increment counters
        $currentDay++;
        $dayOfWeek++;
    }

    // Complete the row of the last week in month, if necessary

    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        $calendar .= "<td colspan='$remainingDays' class='not-month'>&nbsp;</td>";
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";

    return $calendar;

}

echo build_calendar($month, $year, $dateArray);
?>