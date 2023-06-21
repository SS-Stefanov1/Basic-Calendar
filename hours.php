<?php
include getenv('DOCUMENT_ROOT') . "/index.php";
include getenv('DOCUMENT_ROOT') . "/config.php";
session_start();

if (!isset($_POST["register_appoitment"])) {?>

<script type="text/javascript">
$(function(){
    $('#register_form').submit(function() {
        var str=$(this).serialize();
        $.ajax ({
            url: "/hours.php",
            type: "POST",
            data: "submit=register_appoitment&"+str,
            success: function(data) {
                //$('#name,#phone,#email,#ap_hour');
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
                    <option value="1">9:00</option>
                    <option value="2">9:30</option>
                    <option value="3">10:00</option>
                    <option value="4">10:30</option>
                    <option value="5">11:00</option>
                    <option value="6">11:30</option>
                    <option value="7">12:00</option>
                    <option value="8">12:30</option>
                    <option value="9">13:00</option>
                    <option value="10">13:30</option>
                    <option value="11">14:00</option>
                    <option value="12">14:30</option>
                    <option value="13">15:00</option>
                    <option value="14">15:30</option>
                    <option value="15">16:00</option>
                    <option value="16">16:30</option>
                    <option value="17">17:00</option>
                    <option value="18">17:30</option>
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
    $cur_day = date('d');

    $name = secure($_POST[name]);
    $email = secure($_POST[email]);
    $phone = secure($_POST[phone]);

    $app_hour = intval(secure($_POST[ap_hour]));

    switch ($app_hour) {
        case '1':$hour = '09:00';
            break;
        case '2':$hour = '09:30';
            break;
        case '3':$hour = '10:00';
            break;
        case '4':$hour = '10:30';
            break;
        case '5':$hour = '11:00';
            break;
        case '6':$hour = '11:30';
            break;
        case '7':$hour = '12:00';
            break;
        case '8':$hour = '12:30';
            break;
        case '9':$hour = '13:00';
            break;
        case '10':$hour = '13:30';
            break;
        case '11':$hour = '14:00';
            break;
        case '12':$hour = '14:30';
            break;
        case '13':$hour = '15:00';
            break;
        case '14':$hour = '15:30';
            break;
        case '15':$hour = '16:00';
            break;
        case '16':$hour = '16:30';
            break;
        case '17':$hour = '17:00';
            break;
        case '18':$hour = '17:30';
            break;
    }

    #var_dump($phone);

    if (!is_numeric($phone)) {
        echo "<div style='text-align:center; margin-top: 10%'><font color='#db2531'; size='15px'>Your phone must contain only digits.</font></div>";
        echo "<script>setTimeout(\"window.location='/hours.php';\",2500);</script>";

    } else if (!preg_match('/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+/', $email)) {
        echo "<div style='text-align:center; margin-top: 10%'><font color='#db2531'; size='15px'>Please enter a valid email.</font></div>";
        echo "<script>setTimeout(\"window.location='/hours.php';\",2500);</script>";
    }

    #else if (!preg_match('/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+/', $email)) {
    #    echo "<div style='text-align:center; margin-top: 10%'><font color='#db2531'; size='15px'>Hour has already been reserved by another patient.</font></div>";
    #    echo "<script>setTimeout(\"window.location='/hours.php';\",2500);</script>";
    #}

    else {
        mssql_query("INSERT INTO CalendarProject VALUES ('$cur_year','$cur_month','$cur_day','$name','$email','$phone','$app_hour')");

        echo "<div style='text-align:center; margin-top: 10%'><font color='#00000'; size='15px'>You successfully saved your appointment for " . date('F jS') . " at " . $hour . ".</font></div>";
        echo "<script>setTimeout(\"window.location='/calendar.php';\",5000);</script>";
    }
}
?>