<?php 

if (isset($_GET['view'])) {

    echo "<h3>View All zone | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a></h3>

        <div id='pagenation'>";

    $zones = $db->getData("SELECT * FROM zones ORDER BY name");
    foreach ($zones as $zone) {
        echo "<div class='z'><a href='?edit={$zone['id']}'>{$zone['name']}</a></div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}
