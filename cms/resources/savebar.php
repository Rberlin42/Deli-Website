<div class="d-flex justify-content-center align-items-center" id="save-bar">
    <button class="btn btn-success w-25 h-75" id="save" onclick="save(<?php getArgs() ?>)">Save</button>
    <div class="alert alert-success" id="save-success" role="alert">
    Saved Successfully <i class="fas fa-check"></i>
    </div>
    <div class="alert alert-danger" id="save-fail" role="alert">
    Save Failed <i class="fas fa-times"></i>
    </div>
</div>
<script src="/cms/resources/save.js"></script>

<?php
    function getArgs() {
        echo "'" . SAVE_METHOD . "'"; 
        if(defined('MENU_TYPE')) 
            echo ",'" . MENU_TYPE . "'";
    }
?>