 <?php 

 if($_SERVER['PHP_AUTH_USER'] != 'password' && $_SERVER['PHP_AUTH_PW'] != 'username')
 {
    header("WWW-Authenticate: Basic realm='Test Authentication System'");
    header("HTTP/1.0 401 Unauthorised");
    echo "There was an error";
    exit;
 }
 
 /*
    Data present in database are:

    1. Dhinam Oru Nal Vaarthai
        i. video
        ii.Audio
    2. 108il Alwargalin Manam
        i. Audio
        ii. Video
    3. Jodhidam - video
    4. e-Books = pdf
    5. Kadhai Ketkum Neram - Songs
    6. Dhinachariyai
        i. month in tamil
        ii. Tamil date
        iii. day
        iv. thidhi
        v. star
        vi. event
    7. Baby Names
        i. Boy Baby
        ii.Girl Baby
    8. Dance - video
    9. Free Downloads
        i. Audio(Ringtone)
        ii. Texts - pdf
 */
 
 function getData()
 {

    //--------- Server host name ----------
    $host_name = "localhost";
    //--------- Server user name ----------
    $host_user_name = "root";
    //--------- Server Password -----------
    $host_password = "";
    //--------- Server DB Name ------------
    $db_name = "koodal raghavan app";

     //connect Server Database using hostname, username, password, dbname
     $database_connection = mysqli_connect($host_name,$host_user_name,$host_password,$db_name) or die("Connection with server couldn't be established");

     if($database_connection)
     {
         echo "Database Connection with Server Established Sussessfully\n\n";

        $daily_video_query = "SELECT * FROM dailyvideo";
        $daily_auido_query = "SELECT * FROM dailyaudio";
        $jodhidam_query = "SELECT * FROM jodhidam";
        $ebooks_query = "SELECT * FROM ebooks";
        $story_query = "SELECT * FROM dailyaudio";
        $dhinachariyai_query = "SELECT * FROM dhinachariyai";
        $babyname_boy_query = "SELECT * FROM boyname";
        $babyname_girl_query = "SELECT * FROM girlname";
        $dance_query = "SELECT * FROM dance";

        $daily_video_result = mysqli_query($database_connection,$daily_video_query);
        $daily_auido_result = mysqli_query($database_connection,$daily_auido_query);
        $jodhidam_result = mysqli_query($database_connection,$jodhidam_query);
        $ebooks_result = mysqli_query($database_connection,$ebooks_query);
        $story_result = mysqli_query($database_connection,$story_query);
        $dhinachariyai_result = mysqli_query($database_connection,$dhinachariyai_query);
        $babyname_boy_result = mysqli_query($database_connection,$babyname_boy_query);
        $babyname_girl_result = mysqli_query($database_connection,$babyname_girl_query);
        $dance_result = mysqli_query($database_connection,$dance_query);

        //$json_array[] = array();

         while($row = mysqli_fetch_array($daily_video_result))
         {
            $json_array['video'][] = array(
                'portal' => $row["portal"],
                'url' => $row["url"],
            );
         }

         while($audio_row = mysqli_fetch_array($daily_auido_result))
         {
            $json_array['audio'][] = array(
                'portal_audio' => $audio_row["poral"],
                'url_audio' => $audio_row['url'],
            );
         }

         while($jodhidam_row = mysqli_fetch_array($jodhidam_result))
         {
            $json_array['jodhidam'][] = array(
                'title' => $jodhidam_row["title"],
                'url' => $jodhidam_row["url"]
            );
         }

         // code for 108 alwargalin manam has not yet written.
         // skipping to e-books
         
         while($ebook_row = mysqli_fetch_array($ebooks_result))
         {
             $json_array['ebooks'][] = array(
                 'name' => $ebook_row["name"],
                 'url' => $ebook_row["url"],
                 'price' => $ebook_row["price"]
             );
         }

         while($story_row = mysqli_fetch_array($story_result))
         {
             $json_array['story'][] = array(
                 'name' => $story_row["poral"],
                 'url' => $story_row["url"]
             );
         }

         while($dhinachariyai_row = mysqli_fetch_array($dhinachariyai_result))
         {
             $json_array['dhinachariyai'][] = array(
                 'tml_month' => $dhinachariyai_row["tml_month"],
                 'date' => $dhinachariyai_row["date"],
                 'day' => $dhinachariyai_row["day"],
                 'month' => $dhinachariyai_row["month"],
                 'star' => $dhinachariyai_row["star"],
                 'thidhi' => $dhinachariyai_row["thidhi"],
                 'event' => $dhinachariyai_row["event"]
             );
         }

         while($babyname_boy_row =  mysqli_fetch_array($babyname_boy_result))
         {
             $json_array['boysName'][] = array(
                 'name' => $babyname_boy_row["name"]
             );
         }

         while($babyname_girl_row =  mysqli_fetch_array($babyname_girl_result))
         {
             $json_array['girlsName'][] = array(
                 'name' => $babyname_girl_row["name"]
             );
         }

         while($dance_row = mysqli_fetch_array($dance_result))
         {
             $json_array['dance'][] = array(
                 'name' => $dance_row["name"],
                 'url' => $dance_row["url"]
             );
         }
   }

   return json_encode($json_array);
 }

 $file_name = "data.json";

 if(file_put_contents($file_name,getData()))
    {
        echo $file_name . 'File created';
    }
else{
    echo '\nproblem found';
}
 ?>
