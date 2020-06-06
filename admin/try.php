<?php

$_SESSION['value1']=TRUE;
$_SESSION["value2"]=TRUE;

echo $_SESSION['value1'] . $_SESSION["value2"];

?>
<?php if(1) : ?>
    <a href="http://yahoo.com">This will only display if $condition is true</a>
<?php endif; ?>

<?php if(0) : ?>
    <a href="http://yahoo.com">This will only display if $condition is true</a>
<?php elseif(0) : ?>
	<a href="http://yahoo.com">elseif</a>
<?php else : ?>
	<a href="http://yahoo.com">else</a>
<?php endif; ?>

