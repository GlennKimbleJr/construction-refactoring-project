<?php 

define('TITLE', 'Reports Menu');    
require('../functions/connect.php');
include('../functions/header.php');

//start admin content area
echo "<center>

    <h1>REPORTS MENU</h1>

    <table width='620' cellspacing='1' cellpadding='5' border='0'>
        <tr>
            <td width='120' valign='top' align='center'>
                <font size='1'>
                <img src='images/reports.png' width='48' height='48'><br> 
                <a href='index.php'>back to home</a><br>
                <br>
                <a href='?score'>SCORE</a><br>
                <a href='?bid'>BID</a><br>
                </font>
            </td>
            <td width='40'>&nbsp;</td>
            <td width='660' valign='top' align='left'>";


            require('../functions/reports_bid.php'); 
            require('../functions/reports_score.php'); 

            echo "</td>
        </tr>
    </table>
</center>";

include('../functions/footer.php');
