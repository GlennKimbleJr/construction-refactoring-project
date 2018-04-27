<?php $this->layout('project', ['title' => $title]) ?>
<a href="/projects/<?=$this->e($project['id'])?>/delete" class="btn btn-danger">Delete</a>
<hr>

<form action="/projects/<?=$this->e($project['id'])?>" method="POST">
    <input id="id2" type="hidden" name="id2" required value="<?=$this->e($project['id'])?>" />

    <div class="form-group">
        <label>Project Name: </label>
        <input class="form-control" id="name" type="text" name="name" required value="<?=$this->e($project['name'])?>" />
    </div>

    <div class="form-group">
        <label>Plan Directory: </label>

        <div class="form-row">
            <div class="col">
                <input class="form-control" size='35' id="plans" type="text" name="plans" required value="<?=$this->e($project['plans'])?>" placeholder="directory name">
            </div>

            <div class="col">
                <input class="form-control" size='10' id="planuser" type="text" name="planuser" required value="<?=$this->e($project['planuser'])?>" placeholder="user name">
            </div>

            <div class="col">
                <input class="form-control" size='10' id="planpass" type="text" name="planpass" required value="<?=$this->e($project['planpass'])?>" placeholder="password">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Owner: </label><br>

        <div class="form-row">
            <div class="col">
                <input class="form-control" id="owner_name" type="text" name="owner_name" required placeholder="name" value="<?=$this->e($project['owner_name'])?>"/>
            </div>

            <div class="col">
                <input class="form-control" id="owner_phone" type="text" name="owner_phone" required placeholder="phone" value="<?=$this->e($project['owner_phone'])?>"/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Bid Due By: </label>

        <div class="form-row">
            <div class="col">
                <select name="due1" class="form-control">
                    <option value="<?=$this->e($date1)?>"><?=$this->e($date4)?></option>
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
            </div>

            <div class="col">
                <select name="due2" class="form-control">
                    <option value="<?=$this->e($date2)?>"><?=$this->e($date2)?></option>
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
            </div>

            <div class="col">
                <input id="due3" class="form-control" type="text" name="due3" required value="<?=$this->e($date3)?>" maxlength="4" size="4"/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Select Superintendent:</label><br>
        <select name="super" class="form-control">
            <?php foreach($supers as $super): ?>
                <option value='<?=$this->e($super['id'])?>'
                    <?php if ($project['super_id'] == $super['id']): ?>
                        selected
                    <?php endif ?>
                ><?=$this->e($super['name'])?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Project Location: </label>
        <input class="form-control" id="location" type="text" name="location" required value="<?=$this->e($project['location'])?>" />
    </div>

    <input class="btn btn-success register" type="submit" name="submit" value="Update" /><br>
</form>
<br>
