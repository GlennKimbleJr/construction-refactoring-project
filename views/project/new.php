<?php $this->layout('project', ['title' => $title]) ?>
<h3>Start a New Project</h3>
<form action="/projects" method="POST">

    <p>
        <label>Project Name: </label>
        <input id="name" type="text" name="name" required placeholder="Joe Bob's Remodel" />
    </p>
    
    <p>
        <label>Plan Directory Name: </label>
        <input size='35' id="plans" type="text" name="plans" required placeholder="dunkin_donut" />
    </p>
    
    <p>
        <label>Directory Login: </label>
        <input size='10' id="planuser" type="text" name="planuser" required placeholder="user" />
        <input size='10' id="planpass" type="text" name="planpass" required placeholder="pass" />
    </p>
    
    <p>
        <label>Owner Contact: </label><br>
        <input id="owner_name" type="text" name="owner_name" required placeholder="Name" />
        <input id="owner_phone" type="text" name="owner_phone" required placeholder="Phone" />
    </p>

    <p>
        <label>Bid Due By: </label>

        <select name="due1">
            <option value="01">Jan</option>
            <option value="02">Feb</option>
            <option value="03">Mar</option>
            <option value="04">Apr</option>
            <option value="05">May</option>
            <option value="06">Jun</option>
            <option value="07">Jul</option>
            <option value="08">Aug</option>
            <option value="09">Sep</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
        </select>

        <select name="due2">
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
        </select>

        <input id="due3" type="text" name="due3" required placeholder="2014" maxlength="4" size="4"/>
    </p>

    <p>
        <label>Zone: <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a></label><br>
        
        <select name="zone">
            <?php foreach($zones as $zone): ?>
                <option value='<?=$this->e($zone['id'])?>'>
                    <?=$this->e($zone['name'])?>
                </option>
            <?php endforeach ?>
        </select>
    </p>

    <p>
        <label>Select Superintendent:</label><br>
        <select name="super">   
            <option value=""></option>
             <?php foreach($supers as $super): ?>
                <option value='<?=$this->e($super['id'])?>'>
                    <?=$this->e($super['name'])?>
                </option>
            <?php endforeach ?>
        </select>
    </p>

    <p>
        <label>Project Location: </label>
        <input id="location" type="text" name="location" required placeholder="City, State" />
    </p>

    <input class="btn register" type="submit" name="submit" value="Create" />
</form>