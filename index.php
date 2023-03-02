<?php 

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$url = "https://";   
else  
$url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    

echo '<a target="_blank" href="'.$url.'admin/">Visit Admin</a>';
echo '<br><a target="_blank" href="'.$url.'franchise/">Visit Franchise</a>';
echo '<br><a target="_blank" href="'.$url.'store-user/">Visit Store-user</a>'; 


?>