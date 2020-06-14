<?php

$connection = mysqli_connect("https://tpvs.tce.edu/","tpvsuser1",tpvs@userONE");

if($connection)
{
echo "connection sucessfull";
}
else
{
echo " connection failed";
}
?>
