<?php

function get_data()
{
    
$connect = mysqli_connect("localhost","root","","trial");
$sql = "SELECT * FROM data";
$result = mysqli_query($connect,$sql);

$json_array = array();

while($row = mysqli_fetch_assoc($result))
{
    $json_array["Data"] = array(
        'portal' => $row['portal'],
        'url'    => $row['url'],
        'price'  => $row['price']
    );
}

return json_encode($json_array);
}

echo '<pre>';
print_r(get_data());
echo '</pre>';

$file_name = "portalInfo.json";

if(file_put_contents($file_name,get_data()))
{
    //echo $file_name . 'File created';
}
else{
    //echo 'problem found';
}

?>