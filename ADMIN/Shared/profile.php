<?php session_start() ?>

<li class="dropdown">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="halflings-icon white user"></i> <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'] ?>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li class="dropdown-menu-title">
            <span>Account Settings</span>
        </li>
        <li style="cursor: pointer;" id="profileBtn"><a><i class="halflings-icon user"></i> Profile</a></li>
        <li><a href="Handlers/Logout.php"><i class="halflings-icon off"></i> Logout</a></li>
    </ul>
</li>

<script>
    $(document).ready(function(){
        $('#profileBtn').on('click',function(){
            $('#content').load('Pages/Profile.php');
        });
    });
</script>