<?php

    date_default_timezone_set('Asia/Jerusalem');
   
    function encrypt_str($string_to_encrypt,$pw= '1234' ){
        //cryptor from function(decrypt1)
        return $encrypted_string = openssl_encrypt($string_to_encrypt,"AES-128-ECB",$pw);
        //$encrypted_string  K9ml/T5LV12K3hGBfU9pCA== 
    }
    function decrypt_str($encrypted_string, $pw = '1234'){
        //decryptor from function(crypt1)
        return $decrypted_string = openssl_decrypt($encrypted_string,"AES-128-ECB",$pw);
    }
    
    function logout(){
        //logout function
        return header('location:http://localhost/laverie/logout.php');
    }//End logout

    function session_checker(array $sessions){
    //cheking if user or admin has loged In else 'logout'
        foreach ($sessions as $session) {
            if(empty($session)) { 
                logout();
            }
        }
    }//End session_checker


    function makeDir($dir){
    /*Function to check if 'Directory' exits else make 'this'*/
        if (!is_dir($dir)) {
            mkdir($dir,"0777",true);
        }
    }//-End function makeDir

    function allDirMaker(){
    /*function to make all Directories if not exist*/
        $dirs = array('images/','images/user/');
        foreach ($dirs as $dir) {
            makeDir($dir);
        }
    }//End allDirMaker

    function make_avatar($character){

        $character = strtoupper($character[0]);
        //caller 
        //$user_avatar = make_avatar(strtoupper($name[0]));
        $path = 'images/users/av_'.time().'.png';
        //initial 200,200
        $image = imagecreate(200,200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);
        imagettftext($image, 100, 0,55, 150, $textcolor, 'http://localhost/laverie/libs/font-awasome/fonts/fontawasome-webfont.ttf', $character);
        header('Content-type: image/png');
        imagepng($image,$path);
        imagedestroy($image);
        return $path;
        // imagettftext(image, size, angle, x, y, color, fontfile, text)
        // imagettftext(image, 100, 0, 55, 150, color, fontfile, text)
    }

    function get_user_avatar( $avatar ){

        if (file_exists("http://localhost/laverie/".$avatar)) {
          echo '<img src="http://localhost/laverie/'.$avatar.'" width="30" class="img-circle"/>';
        }else{
          echo '<img src="http://localhost/laverie/images/users/img_default.jpg" width="30" class="img-circle"/>';
        }
    }

    function get_sum($array){
        $sum = 0;
        for($i=0;$i<count($array);$i++){
            $sum += $array[$i]; 
        }
        return $sum;
    }

    function get_mult($array){
        $mult = 1;
        for($i=0;$i<count($array);$i++){
            $mult *= $array[$i]; 
        }
        return $mult;
    }

    function get_hab_info($connect,$id,$rowIn){
        $rowIn = trim(mysqli_real_escape_string($connect,$rowIn));
        $select =$connect->query("SELECT $rowIn FROM types WHERE type_id = $id ");
        if (mysqli_num_rows($select)>0) {
            $row=mysqli_fetch_array($select);
            return $row[$rowIn];
        }
    }

?>
