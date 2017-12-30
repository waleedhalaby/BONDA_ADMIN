<?php
    include ('Handlers/Authenticate.php');

    require_once ('Handlers/UpdateStatus.php');

    Update('ACTIVE');

    echo '<input type="hidden" id="hiddenMemberID" value="'.$_SESSION["id"].'"/>';
	$BASE_URL = getcwd();

    include ('Shared/header.html');
    include ('Shared/footer.html');
?>