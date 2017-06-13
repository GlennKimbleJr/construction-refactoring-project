<?php 

// Starts Script
if (isset($_GET['view'])) {

    echo "<h3>View All Contacts</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><font size='1'><b>company</b></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewf'><b>first</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewl'><b>last</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewc'><b>city</b></a></font></td>
            <td align='center' width='6%'><font size='1'><a href='?views'><b>state</b></a></font></td>
            <td align='center' width='17%'><font size='1'><a href='?viewt'><b>type</b></a></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>

    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact ORDER BY company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }

    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['viewf'])) {
    echo "<h3>View All Contacts - Sort by FIRST</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><font size='1'><a href='?view'><b>company</b></a></font></td>
            <td align='center' width='14%'><font size='1'><b>first</b></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewl'><b>last</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewc'><b>city</b></a></font></td>
            <td align='center' width='6%'><font size='1'><a href='?views'><b>state</b></a></font></td>
            <td align='center' width='17%'><font size='1'><a href='?viewt'><b>type</b></a></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>
    <div id='pagenation'>";


    $selectusercheck = "SELECT * FROM contact ORDER BY first, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }


    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['viewl'])) {
    echo "<h3>View All Contacts - Sort by LAST</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><font size='1'><a href='?view'><b>company</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewf'><b>first</b></a></font></td>
            <td align='center' width='14%'><font size='1'><b>last</b></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewc'><b>city</b></a></font></td>
            <td align='center' width='6%'><font size='1'><a href='?views'><b>state</b></a></font></td>
            <td align='center' width='17%'><font size='1'><a href='?viewt'><b>type</b></a></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>
    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact ORDER BY last, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }

    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['viewc'])) {
    echo "<h3>View All Contacts - Sort by CITY</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><font size='1'><a href='?view'><b>company</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewf'><b>first</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewl'><b>last</b></a></font></td>
            <td align='center' width='14%'><font size='1'><b>city</b></font></td>
            <td align='center' width='6%'><font size='1'><a href='?views'><b>state</b></a></font></td>
            <td align='center' width='17%'><font size='1'><a href='?viewt'><b>type</b></a></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>

    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact ORDER BY city, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['views'])) {
    echo "<h3>View All Contacts - Sort by STATE</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><font size='1'><a href='?view'><b>company</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewf'><b>first</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewl'><b>last</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewc'><b>city</b></a></font></td>
            <td align='center' width='6%'><font size='1'><b>state</b></font></td>
            <td align='center' width='17%'><font size='1'><a href='?viewt'><b>type</b></a></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>
    
    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact ORDER BY state, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }

    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['viewt'])) {
    echo "<h3>View All Contacts - Sort by TYPE</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><font size='1'><a href='?view'><b>company</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewf'><b>first</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewl'><b>last</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewc'><b>city</b></a></font></td>
            <td align='center' width='6%'><font size='1'><a href='?views'><b>state</b></a></font></td>
            <td align='center' width='17%'><font size='1'><b>type</b></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>
    
    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact ORDER BY type, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }

    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['type'])) {
    echo "<h3>SELECT A TYPE</h3>";

    $selectusercheck = "SELECT * FROM type ORDER BY name";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $name = $selectusercheck_row['name'];

        echo "<A href='?t=$name'>$name</a><br>";
    }
}

if (isset($_GET['t'])) {
    $t = $_GET['t'];

    echo "<h3>View Contacts - $t</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><a href='?t=$t'><font size='1'><b>company</b></a></font></td>
            <td align='center' width='14%'><a href='?tf=$t'><font size='1'><b>first</b></a></font></td>
            <td align='center' width='14%'><a href='?tl=$t'><font size='1'><b>last</b></a></font></td>
            <td align='center' width='14%'><a href='?tc=$t'><font size='1'><b>city</b></a></font></td>
            <td align='center' width='6%'><a href='?ts=$t'><font size='1'><b>state</b></a></font></td>
            <td align='center' width='17%'><font size='1'><b>type</b></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>

    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE type = '$t' ORDER BY company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['tf'])) {
    $tf = $_GET['tf'];
    echo "<h3>View Contacts - $tf</h3>

        <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='25%'><a href='?t=$tf'><font size='1'><b>company</b></a></font></td>
                <td align='center' width='14%'><a href='?tf=$tf'><font size='1'><b>first</b></a></font></td>
                <td align='center' width='14%'><a href='?tl=$tf'><font size='1'><b>last</b></a></font></td>
                <td align='center' width='14%'><a href='?tc=$tf'><font size='1'><b>city</b></a></font></td>
                <td align='center' width='6%'><a href='?ts=$tf'><font size='1'><b>state</b></a></font></td>
                <td align='center' width='17%'><font size='1'><b>type</b></font></td>
                <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
            </tr>
        </table>
    
    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE type = '$tf' ORDER BY first, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['tl'])) {
    $tl = $_GET['tl'];
    echo "<h3>View Contacts - $tl</h3>

        <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='25%'><a href='?t=$tl'><font size='1'><b>company</b></a></font></td>
                <td align='center' width='14%'><a href='?tf=$tl'><font size='1'><b>first</b></a></font></td>
                <td align='center' width='14%'><a href='?tl=$tl'><font size='1'><b>last</b></a></font></td>
                <td align='center' width='14%'><a href='?tc=$tl'><font size='1'><b>city</b></a></font></td>
                <td align='center' width='6%'><a href='?ts=$tl'><font size='1'><b>state</b></a></font></td>
                <td align='center' width='17%'><font size='1'><b>type</b></font></td>
                <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
            </tr>
        </table>
        
    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE type = '$tl' ORDER BY last, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['tc'])) {
    $tc = $_GET['tc'];
    echo "<h3>View Contacts - $tc</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><a href='?t=$tc'><font size='1'><b>company</b></a></font></td>
            <td align='center' width='14%'><a href='?tf=$tc'><font size='1'><b>first</b></a></font></td>
            <td align='center' width='14%'><a href='?tl=$tc'><font size='1'><b>last</b></a></font></td>
            <td align='center' width='14%'><a href='?tc=$tc'><font size='1'><b>city</b></a></font></td>
            <td align='center' width='6%'><a href='?ts=$tc'><font size='1'><b>state</b></a></font></td>
            <td align='center' width='17%'><font size='1'><b>type</b></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>

    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE type = '$tc' ORDER BY city, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['ts'])) {
    $ts = $_GET['ts'];
    echo "<h3>View Contacts - $ts</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><a href='?t=$ts'><font size='1'><b>company</b></a></font></td>
            <td align='center' width='14%'><a href='?tf=$ts'><font size='1'><b>first</b></a></font></td>
            <td align='center' width='14%'><a href='?tl=$ts'><font size='1'><b>last</b></a></font></td>
            <td align='center' width='14%'><a href='?tc=$ts'><font size='1'><b>city</b></a></font></td>
            <td align='center' width='6%'><a href='?ts=$ts'><font size='1'><b>state</b></a></font></td>
            <td align='center' width='17%'><font size='1'><b>type</b></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>
    
    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE type = '$ts' ORDER BY state, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['zone'])) {
    echo "<h3>SELECT A ZONE</h3>";

    $selectusercheck = "SELECT * FROM zone ORDER BY name";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $name = $selectusercheck_row['name'];

        echo "<A href='?z=$name'>$name</a><br>";
    }
}

if (isset($_GET['z'])) {
    $z = $_GET['z'];
    echo "<h3>View Contacts - $z</h3>

        <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='25%'><a href='?z=$z'><font size='1'><b>company</b></a></font></td>
                <td align='center' width='14%'><a href='?zf=$z'><font size='1'><b>first</b></a></font></td>
                <td align='center' width='14%'><a href='?zl=$z'><font size='1'><b>last</b></a></font></td>
                <td align='center' width='14%'><a href='?zc=$z'><font size='1'><b>city</b></a></font></td>
                <td align='center' width='6%'><a href='?zs=$z'><font size='1'><b>state</b></a></font></td>
                <td align='center' width='17%'><a href='?zt=$z'><font size='1'><b>type</b></a></font></td>
                <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
            </tr>
        </table>

        <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE (zone = '$z' OR zone2 = '$z' OR zone3 = '$z' OR zone4 = '$z' OR zone5 = '$z' OR zone6 = '$z' OR zone7 = '$z' OR zone8 = '$z' OR zone9 = '$z') ORDER BY company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['zf'])) {
    $zf = $_GET['zf'];

    echo "<h3>View Contacts - $zf</h3>

        <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='25%'><a href='?z=$zf'><font size='1'><b>company</b></a></font></td>
                <td align='center' width='14%'><a href='?zf=$zf'><font size='1'><b>first</b></a></font></td>
                <td align='center' width='14%'><a href='?zl=$zf'><font size='1'><b>last</b></a></font></td>
                <td align='center' width='14%'><a href='?zc=$zf'><font size='1'><b>city</b></a></font></td>
                <td align='center' width='6%'><a href='?zs=$zf'><font size='1'><b>state</b></a></font></td>
                <td align='center' width='17%'><a href='?zt=$zf'><font size='1'><b>type</b></a></font></td>
                <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
            </tr>
        </table>
    
        <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE (zone = '$zf' OR zone2 = '$zf' OR zone3 = '$zf' OR zone4 = '$zf' OR zone5 = '$zf' OR zone6 = '$zf' OR zone7 = '$zf' OR zone8 = '$zf' OR zone9 = '$zf') ORDER BY first, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['zl'])) {
    $zl = $_GET['zl'];

    echo "<h3>View Contacts - $zl</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><a href='?z=$zl'><font size='1'><b>company</b></a></font></td>
            <td align='center' width='14%'><a href='?zf=$zl'><font size='1'><b>first</b></a></font></td>
            <td align='center' width='14%'><a href='?zl=$zl'><font size='1'><b>last</b></a></font></td>
            <td align='center' width='14%'><a href='?zc=$zl'><font size='1'><b>city</b></a></font></td>
            <td align='center' width='6%'><a href='?zs=$zl'><font size='1'><b>state</b></a></font></td>
            <td align='center' width='17%'><a href='?zt=$zl'><font size='1'><b>type</b></a></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>

    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE (zone = '$zl' OR zone2 = '$zl' OR zone3 = '$zl' OR zone4 = '$zl' OR zone5 = '$zl' OR zone6 = '$zl' OR zone7 = '$zl' OR zone8 = '$zl' OR zone9 = '$zl') ORDER BY last, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['zc'])) {
    $zc = $_GET['zc'];

    echo "<h3>View Contacts - $zc</h3>

        <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='25%'><a href='?z=$zc'><font size='1'><b>company</b></a></font></td>
                <td align='center' width='14%'><a href='?zf=$zc'><font size='1'><b>first</b></a></font></td>
                <td align='center' width='14%'><a href='?zl=$zc'><font size='1'><b>last</b></a></font></td>
                <td align='center' width='14%'><a href='?zc=$zc'><font size='1'><b>city</b></a></font></td>
                <td align='center' width='6%'><a href='?zs=$zc'><font size='1'><b>state</b></a></font></td>
                <td align='center' width='17%'><a href='?zt=$zc'><font size='1'><b>type</b></a></font></td>
                <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
            </tr>
        </table>

        <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE (zone = '$zc' OR zone2 = '$zc' OR zone3 = '$zc' OR zone4 = '$zc' OR zone5 = '$zc' OR zone6 = '$zc' OR zone7 = '$zc' OR zone8 = '$zc' OR zone9 = '$zc') ORDER BY city, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['zs'])) {
    $zs = $_GET['zs'];

    echo "<h3>View Contacts - $zs</h3>

        <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='25%'><a href='?z=$zs'><font size='1'><b>company</b></a></font></td>
                <td align='center' width='14%'><a href='?zf=$zs'><font size='1'><b>first</b></a></font></td>
                <td align='center' width='14%'><a href='?zl=$zs'><font size='1'><b>last</b></a></font></td>
                <td align='center' width='14%'><a href='?zc=$zs'><font size='1'><b>city</b></a></font></td>
                <td align='center' width='6%'><a href='?zs=$zs'><font size='1'><b>state</b></a></font></td>
                <td align='center' width='17%'><a href='?zt=$zs'><font size='1'><b>type</b></a></font></td>
                <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
            </tr>
        </table>
    
    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE (zone = '$zs' OR zone2 = '$zs' OR zone3 = '$zs' OR zone4 = '$zs' OR zone5 = '$zs' OR zone6 = '$zs' OR zone7 = '$zs' OR zone8 = '$zs' OR zone9 = '$zs') ORDER BY state, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details=$id'>$company</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>$first</font></td>
                    <td align='center' width='14%'><font size='1'>$last</font></td>
                    <td align='center' width='14%'><font size='1'>$city</font></td>
                    <td align='center' width='6%'><font size='1'>$state</font></td>
                    <td align='center' width='17%'><font size='1'>$type</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['zt'])) {
    $zt = $_GET['zt'];

    echo "<h3>View Contacts - $zt</h3>

    <table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><a href='?z=$zt'><font size='1'><b>company</b></a></font></td>
            <td align='center' width='14%'><a href='?zf=$zt'><font size='1'><b>first</b></a></font></td>
            <td align='center' width='14%'><a href='?zl=$zt'><font size='1'><b>last</b></a></font></td>
            <td align='center' width='14%'><a href='?zc=$zt'><font size='1'><b>city</b></a></font></td>
            <td align='center' width='6%'><a href='?zs=$zt'><font size='1'><b>state</b></a></font></td>
            <td align='center' width='17%'><a href='?zt=$zt'><font size='1'><b>type</b></a></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>

    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM contact WHERE (zone = '$zt' OR zone2 = '$zt' OR zone3 = '$zt' OR zone4 = '$zt' OR zone5 = '$zt' OR zone6 = '$zt' OR zone7 = '$zt' OR zone8 = '$zt' OR zone9 = '$zt') ORDER BY type, company";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $first2 = $selectusercheck_row['first'];
        $first = substr($first2, 0, 10);
        $last2 = $selectusercheck_row['last'];
        $last = substr($last2, 0, 10);
        $city2 = $selectusercheck_row['city'];
        $city = substr($city2, 0, 10);
        $state = $selectusercheck_row['state'];
        $type2 = $selectusercheck_row['type'];
        $type = substr($type2, 0, 10);
        $company2 = $selectusercheck_row['company'];
        $company = substr($company2, 0, 16);

        echo "<div class='z'>

        <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='25%'><font size='1'><a href='?details=$id'>$company</a></font></td>
                <td align='center' width='14%'><font size='1'>$first</font></td>
                <td align='center' width='14%'><font size='1'>$last</font></td>
                <td align='center' width='14%'><font size='1'>$city</font></td>
                <td align='center' width='6%'><font size='1'>$state</font></td>
                <td align='center' width='17%'><font size='1'>$type</font></td>
                <td align='center' width='10%'><font size='1'><a href='?edit=$id'>EDIT</a></font></td>
            </tr>
        </table>
        
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}
