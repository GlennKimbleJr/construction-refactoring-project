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

    $contacts = $db->getData("SELECT * FROM contact ORDER BY company");

    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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


    $contacts = $db->getData("SELECT * FROM contact ORDER BY first, company");
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact ORDER BY last, company");

    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact ORDER BY city, company");
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact ORDER BY state, company");

    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact ORDER BY type, company");

    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM type ORDER BY name");
    
    foreach ($contacts as $contact) {
        $name = $contact['name'];

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

    $contacts = $db->getData("SELECT * FROM contact WHERE type = ? ORDER BY company", [$t]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact WHERE type = ? ORDER BY first, company", [$tf]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact WHERE type = ? ORDER BY last, company", [$tl]);

    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact WHERE type = ? ORDER BY city, company", [$tc]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact WHERE type = ? ORDER BY state, company", [$ts]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM zone ORDER BY name");
    
    foreach ($contacts as $contact) {
        $name = $contact['name'];

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

    $contacts = $db->getData("SELECT * FROM contact WHERE (zone = ? OR zone2 = ? OR zone3 = ? OR zone4 = ? OR zone5 = ? OR zone6 = ? OR zone7 = ? OR zone8 = ? OR zone9 = ?) ORDER BY company", [$z, $z, $z, $z, $z, $z, $z, $z, $z]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact WHERE (zone = ? OR zone2 = ? OR zone3 = ? OR zone4 = ? OR zone5 = ? OR zone6 = ? OR zone7 = ? OR zone8 = ? OR zone9 = ?) ORDER BY first, company", [$zf, $zf, $zf, $zf, $zf, $zf, $zf, $zf, $zf]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact WHERE (zone = ? OR zone2 = ? OR zone3 = ? OR zone4 = ? OR zone5 = ? OR zone6 = ? OR zone7 = ? OR zone8 = ? OR zone9 = ?) ORDER BY last, company", [$zl, $zl, $zl, $zl, $zl, $zl, $zl, $zl, $zl]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact WHERE (zone = ? OR zone2 = ? OR zone3 = ? OR zone4 = ? OR zone5 = ? OR zone6 = ? OR zone7 = ? OR zone8 = ? OR zone9 = ?) ORDER BY city, company", [$zc, $zc, $zc, $zc, $zc, $zc, $zc, $zc, $zc]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact WHERE (zone = ? OR zone2 = ? OR zone3 = ? OR zone4 = ? OR zone5 = ? OR zone6 = ? OR zone7 = ? OR zone8 = ? OR zone9 = ?) ORDER BY state, company", [$zs, $zs, $zs, $zs, $zs, $zs, $zs, $zs, $zs]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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

    $contacts = $db->getData("SELECT * FROM contact WHERE (zone = ? OR zone2 = ? OR zone3 = ? OR zone4 = ? OR zone5 = ? OR zone6 = ? OR zone7 = ? OR zone8 = ? OR zone9 = ?) ORDER BY type, company", [$zt, $zt, $zt, $zt, $zt, $zt, $zt, $zt, $zt]);
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $first2 = $contact['first'];
        $first = substr($first2, 0, 10);
        $last2 = $contact['last'];
        $last = substr($last2, 0, 10);
        $city2 = $contact['city'];
        $city = substr($city2, 0, 10);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 10);
        $company2 = $contact['company'];
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
