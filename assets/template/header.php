<?php

function createButton() {
    if(($_SESSION["userContractor"] == 1) && (!isset($_GET))) {
        echo '<a style="color:red;" href="?create"><i class="far fa-plus-square"></i></a>';
    }
}

function returnButton() {
    if(isset($_GET)) {
        echo `<input type="button" value="Return" onclick="location.href='` . $_SERVER[PHP_SELF] . `';">`;
    }
}

?>
<div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
        <?php createButton() ?>
        <?php returnButton() ?>
    </div>
</div>