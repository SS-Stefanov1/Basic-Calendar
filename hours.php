<?php
include getenv('DOCUMENT_ROOT') . "/index.php";
include getenv('DOCUMENT_ROOT') . "/config.php";
session_start();

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

$date_picked = intval($_GET[d]);
#var_dump($date_picked);

$sql = mssql_query("SELECT day,ap_hour FROM CalendarProject WHERE day = $date_picked");

while ($row = mssql_fetch_assoc($sql)) {
    if (array_key_exists($row['ap_hour'], $app_hours)) {
        unset($app_hours[$row['ap_hour']]);
    }
}

if (!isset($_POST["register_appoitment"])) {
    ?>

<script type="text/javascript">
$(function(){
    $('#register_form').submit(function() {
        var str=$(this).serialize();
        $.ajax ({
            url: "/hours.php",
            type: "POST",
            data: "submit=register_appoitment&"+str,
            success: function(data) {
                $("#register_info").hide().html(data).fadeIn("fast");
            }
        });
    return false;
    });
}
</script>

<form method="POST" action="" id="form">
<table class="hours_table" align="center">
    <tr class="hours" align="center">
        <td align="right">Name</td>
        <td align="left"><input name="name" id="name" class="input" type="text" size="16" maxlength="20"></td>
    </tr>

    <tr class="hours" align="center">
        <td align="right">Phone</td>
        <td align="left"><input name="phone" id="phone" class="input" type="text" size="16" maxlength="10"></td>
    </tr>

    <tr class="hours" align="center">
        <td align="right">E-Mail</td>
        <td align="left"><input name="email" id="email" class="input" type="text" size="22" maxlength="50"></td>
    </tr>

    <tr class="hours">
        <td align="right">Appointment Hour</td>
        <td align="left">
            <select size="1" name="ap_hour" class="input">
                <optgroup label="Choose an hour for your appointment:">
                    <?php
foreach ($app_hours as $key => $value) {
        echo "<option value='$key'>" . $value . "</option>";
    }
    ?>
                </optgroup>
            </select>
        </td>
    </tr>
</table>

</br>

<table class="hours_table" align="center">
    <tr class="hours" align="center">
        <td><input id="register_appoitment" name="register_appoitment" class="button" type="submit" value="Make Appointment"></td>
    </tr>
</table>
</form>

<?php
} else {

    $cur_year = date('Y');
    $cur_month = date('m');

    $name = secure($_POST[name]);
    $email = secure($_POST[email]);
    $phone = secure($_POST[phone]);

    $app_hour = intval(secure($_POST[ap_hour]));

    #var_dump($phone);

    if ($name == '') {
        echo "<div style='text-align:center; margin-top: 10%'><font color='#db2531'; size='15px'>Name can't be blank.</font></div>";
        echo "<script>setTimeout(\"window.location='/calendar.php';\",2500);</script>";
    } else if (!is_numeric($phone)) {
        echo "<div style='text-align:center; margin-top: 10%'><font color='#db2531'; size='15px'>Your phone must contain only digits.</font></div>";
        echo "<script>setTimeout(\"window.location='/calendar.php';\",2500);</script>";
    } else if (!preg_match('/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+/', $email)) {
        echo "<div style='text-align:center; margin-top: 10%'><font color='#db2531'; size='15px'>Please enter a valid email.</font></div>";
        echo "<script>setTimeout(\"window.location='/calendar.php';\",2500);</script>";
    } else {
        mssql_query("INSERT INTO CalendarProject VALUES ('$cur_year','$cur_month','$date_picked','$name','$email','$phone','$app_hour')");

        echo "<div style='text-align:center; margin-top: 10%'><font color='#00000'; size='15px'>You successfully saved your appointment for " . date('F') . " " . $date_picked . "" . date('S') . " at " . $app_hours[$app_hour] . ".</font></div>";
        echo "<script>setTimeout(\"window.location='/calendar.php';\",5000);</script>";
    }
}
?>