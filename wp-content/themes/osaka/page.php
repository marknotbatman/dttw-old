<?php 
if(!is_front_page())
{
    header("Location:".home_url());
}
else
{
    die('Please set "Front page displays" to "Your latest posts" inside "Settings > Reading" panel.');
}
?>