<?php
include 'index.php';
session_start();
?>

<table class="hours_table" align="center">
    <tr class="hours" align="center">
        <td align="right" width="90"><font color="#dfae38">Name</font></td>
        <td align="left" width="165" ><input name="username" id="username" class="input" type="text" size="16" maxlength="10"></td>
        <td align="left" width="175"><p id="username_info"></p></td>
    </tr>

    <tr class="hours" align="center">
        <td align="right"><font color="#dfae38">Phone</font></td>
        <td align="left"><input name="password" id="password" class="input" type="password" size="16" maxlength="10"></td>
        <td><p id="password_info"></p></td>
    </tr>

    <tr class="hours" align="center">
        <td align="right"><font color="#dfae38">E-Mail</font></td>
        <td align="left"><input name="email" id="email" class="input" type="text" size="20" maxlength="50"></td>
        <td><p id="email_info"></p></td>
    </tr>

    <tr class="hours">
        <td align="right"><font color="#dfae38">Appointment Hour</font></td>
        <td align="left">
            <select size="1" name="item" class="input">
                <optgroup label="Choose an hour for your appointment:">
                    <option value="9">9:00</option>
                    <option value="9_h">9:30</option>
                    <option value="10">10:00</option>
                    <option value="10_h">10:30</option>
                    <option value="11">11:00</option>
                    <option value="11_h">11:30</option>
                    <option value="12">12:00</option>
                    <option value="12_h">12:30</option>
                    <option value="13">13:00</option>
                    <option value="13_h">13:30</option>
                    <option value="14">14:00</option>
                    <option value="14_h">14:30</option>
                    <option value="15">15:00</option>
                    <option value="15_h">15:30</option>
                    <option value="16">16:00</option>
                    <option value="16_h">16:30</option>
                    <option value="17">17:00</option>
                    <option value="17_h">17:30</option>
                </optgroup>
            </select></td>
    </tr>
</table>

</br>

<table class="hours_table" align="center">
    <tr class="hours">
        <td align="center" colspan="2">
        <div id="register_info">

            <input id="name" type="hidden" value="NOK">
            <input id="phone" type="hidden" value="NOK">
            <input id="email" type="hidden" value="NOK">
            <input id="appointment" type="hidden" value="NOK">

            <input id="pick_hour" class="button" type="submit" value="Make Appointment" disabled="enabled">
        </div>
        </td>
    </tr>
</table>
