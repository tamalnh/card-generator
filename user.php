<?php 

class User {
 protected $db_connect;

    function __construct() {
        $hostName = 'localhost';
        $userName = 'root';
        $password = '';
        $dbName = 'cards_demo';

        $this->db_connect = mysqli_connect($hostName, $userName, $password, $dbName);

        if (!$this->db_connect) {
            die('Database Connection Faild!' . mysqli_error($this->db_connect));
        }
    }
    
    
    function save_user_info($data){
        
$directory='user-image/'; // set directory where you want to save your image
$image_name = $_FILES['user_pro_pic']['name']; //get uploaded image name

$current_location = $_FILES['user_pro_pic']['tmp_name'];//uploaded image current location
$target_file=$directory.$image_name;

$image_size = $_FILES['user_pro_pic']['size'];
$file_type=pathinfo($target_file, PATHINFO_EXTENSION);//get the file type

$image=getimagesize($current_location);
     
    if($image){

        if(file_exists($target_file)){
            $message = 'File Already Exists.';
            return $message;
        }else{
            if($image_size > 1000000){ 
                $message='Your image is too large. Please Upload an Image within 1MB';
                return $message;
            }else{
               if($file_type != 'jpg' && $file_type != 'png'){
                   $message='File Type Should be JPG or PNG Format';
                   return $message;
               } else{
                   move_uploaded_file($current_location, $target_file);
                   
                   //user data
                    $user_name = $data['user_name'];
                    $date_of_birth = $data['date_of_birth'];
                    $user_nationality = $data['user_nationality'];
                    $birth_place = $data['birth_place'];
                    $user_email = $data['user_email'];
                    $user_pro_pic = $target_file;
        
                    $sql="INSERT INTO 
                        tbl_user(user_name, date_of_birth, user_nationality, birth_place, user_email, user_rq_code, user_pro_pic) 
                        VALUES('$user_name', '$date_of_birth', '$user_nationality', '$birth_place', '$user_email', '$user_email', '$user_pro_pic')";
                   
                   if(mysqli_query($this->db_connect, $sql)){
                       
                   }else{
                       die('Query Problem'. mysqli_error($this->db_connect));
                   }
               }
            }
        }

    }else{
        $message='Please Upload an vaild image whois contain JPG or PNG format';
        return $message;
    }
        
    }
}