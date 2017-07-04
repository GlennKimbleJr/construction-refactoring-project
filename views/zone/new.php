<?php $this->layout('zone', ['title' => 'Add New Zone']) ?>
<h3>Start a New Zone | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a></h3>

<form action="/zones" method="POST">
    <p>
        <label>Name: </label>
        <input id="name" type="text" name="name" required placeholder="FL - Northwest" />
    </p>

    <input class="btn register" type="submit" name="submit" value="Create" />
</form>