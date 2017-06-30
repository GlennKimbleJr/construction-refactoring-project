<?php $this->layout('project', ['title' => $title]) ?>
<?php if (count($project)): ?>
    <b>[ <a href='?choose=<?=$this->e($projectId)?>'>GO BACK</a> ]</b><br>
    <br>
    <b>Choose a <u>{$category['name']}</u> Sub-Contractor</b><br>
    <br>

    <form action='' method='POST'>
        <input id='did' type='hidden' name='did' required value='<?=$this->e($projectId)?>' />
        <input id='c' type='hidden' name='c' required value='<?=$this->e($category['id'])?>' />
        <p>
            <select name='company' required>
        
            <?php foreach($zoneContacts as $contact): ?>
                <option value='<?=$this->e($contact['id'])?>'>
                    <?=$this->e($contact['company'])?>
                </option>
            <?php endforeach ?>

            </select>
        </p>

        <input class='btn register' type='submit' name='submit' value='Submit' />
    </form><br>
    <br>

    <b>Sub-Contractors already selected:</b><br><br>

    <?php foreach($bidders as $bidder): ?>
        - <?=$this->e($bidder['company'])?><br>
    <?php endforeach ?>

    <?php if (! count($bidders)): ?>
        <i>none</i>
    <?php endif ?>

<?php else: ?>
    Could not get data
<?php endif ?>