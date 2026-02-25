<?php
/* admin panel template */
?>

<div class="gp--container">
    <div class="gp--row">
        <div class="gp--col">
            <div class="gp--data-info">
                <span class="gp--last-update-holder">Last updated: <span class="gp--last-update-date"><?php echo $data['last_updated'];?></span></span>
            </div>
        </div>
    </div>
    <div class="gp--row">
        <div class="gp--col">
            <div class="gp--btn-holder">
                <button class="gp--btn gp--btn-update-data">Update data</button>
            </div>
        </div>
    </div>
</div>