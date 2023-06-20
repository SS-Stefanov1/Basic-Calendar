<?php
include 'index.php';
session_start();

if (!isset($_POST["submit"])) {?>

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
        <td><p id="username_info"></p></td>
    </tr>

    <tr class="hours" align="center">
        <td align="right">Phone</td>
        <td align="left"><input name="phone" id="phone" class="input" type="text" size="16" maxlength="10"></td>
        <td><p id="password_info"></p></td>
    </tr>

    <tr class="hours" align="center">
        <td align="right">E-Mail</td>
        <td align="left"><input name="email" id="email" class="input" type="text" size="20" maxlength="50"></td>
        <td><p id="email_info"></p></td>
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
            </select></td>
    </tr>
</table>

</br>

<table class="hours_table" align="center">
    <tr class="hours" align="center">
        <td><input id="register_appoitment" class="button" type="submit" value="Make Appointment"></td>
    </tr>
</table>
</form>

<?php
} else {
    mssql_query("INSERT INTO CalendarProject (year,month,day,name,email,phone,ap_hour) VALUES ('date('Y')','date('m')''date('d')','$_POST[name]','$_POST[email]','$_POST[phone]','$_POST[ap_hour]')");
    echo "<font color='#56910f'>You successfully saved an appointment for " . $_POST[ap_hour] . "'.</font>";
    echo "<script>setTimeout(\"window.location.reload();\",2500);</script>";
}
?>