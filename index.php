<?php

if(isset($_POST['btn'])){
    require 'user.php';
    $obj_user = new User();
    
$message=$obj_user->save_user_info($_POST);
}

?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> ID Card Generator</title>

        <link href="https://fonts.googleapis.com/css?family=Mr+De+Haviland|Roboto:300,400,500,700,900" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        
        
        <script src="assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.qrcode.min.js"></script>



    </head>

    <body>
        <div class="container">
           
            
           
            <div class="row">
                <div class="col-md-5">
                    <div class="form-area">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <br style="clear:both">
                            <h3 style="margin-bottom: 25px; text-align: center;">Besic Info</h3>

                            <div class="form-group">
                                <p style="padding-right:10px;">Image</p>
                                <input type="file" name="user_pro_pic" placeholder="Upload Profile Picture" required>
                            </div>

                            <div class="form-group">
                                <p style="float:left; padding-right:10px">Name</p>
                                <input type="text" class="form-control" name="user_name" placeholder="Name" required>
                            </div>

                            <div class="form-group">
                                <p style="float:left; padding-right:10px">Date of Birth</p>
                                <input type="text" class="form-control" name="date_of_birth" placeholder="Day/Month/Year" required>
                            </div>

                            <div class="form-group">
                                <p style="float:left; padding-right:10px">Nationality</p>
                                <input type="text" class="form-control" name="user_nationality" placeholder="Nationality" required>
                            </div>

                            <div class="form-group">
                                <p style="float:left; padding-right:10px">Place of Birth</p>
                                <input type="text" class="form-control" name="birth_place" placeholder="Place of Birth" required>
                            </div>

                            <div class="form-group">
                                <p style="float:left; padding-right:10px">Email</p>
                                <input type="text" class="form-control" name="user_email" placeholder="Email" required>
                            </div>
                            <?php if(isset($message)){ ?>
                <h2 style="text-align:center; color:#DC4B3F; float:left" ><?php echo $message; unset ($message); ?></h2>
            <?php } ?>
                            <button type="submit" name="btn" class="btn btn-primary pull-right">Generate Card</button>
                        </form>

                    </div>
                </div>

                <?php if(isset($_POST['btn'])){ 
    
                     if(!empty($image)){
                         $user_name = $_POST['user_name'];
                        $date_of_birth = $_POST['date_of_birth'];
                        $user_nationality = $_POST['user_nationality'];
                        $birth_place = $_POST['birth_place'];
                        $user_email = $_POST['user_email'];

                        $image = $_FILES['user_pro_pic'];
                        $image_name = $_FILES['user_pro_pic']['name'];
                        $directory='user-image/';
                        $target_file=$directory.$image_name;
                        
                        
    
                ?>



                <div class="col-md-5">
                    <div class="mycard" id="card-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <h2>Identification</h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card-content">
                                    <h4> <span>Name:</span>
                                        <?php echo $user_name; ?>
                                    </h4>
                                    <h4> <span>Date of birth:</span>
                                        <?php echo $date_of_birth; ?>
                                    </h4>
                                    <h4> <span>Place of birth:</span>
                                        <?php echo $birth_place; ?>
                                    </h4>
                                    <h4> <span>Nationality:</span>
                                        <?php echo $user_nationality; ?>
                                    </h4>
                                    <h4> <span>Email:</span>
                                        <?php echo $user_email; ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="avatar">
                                    <img src="<?php echo $target_file; ?>" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-footer">
                                    <p>&copy; gov.bd</p>
                                </div>
                            </div>
                        </div>

                        <div class="my-rq-code" id="qrcode">

                        </div>

                    </div>
                    <button id="download-btn" class="download-btn" type="button">Download</button>

                    <div id="img" style="display:none;">
                        <img src="" id="newimg" class="downloadable" />
                    </div>
                </div>
                <?php } } ?>

            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-text">
                        <a href="https://www.facebook.com/innocentsanto" target="_blank">&copy; Tamal H</a>
                    </div>
                </div>
            </div>
        </div>







        <script>
            $(document).ready(function() {
                $('#qrcode').qrcode('<?php echo $user_email; ?>');

                $(function() {
                    $("#download-btn").click(function() {
                        html2canvas($("#card-wrap"), {
                            onrendered: function(canvas) {
                                var imgsrc = canvas.toDataURL("image/png");
                                console.log(imgsrc);
                                $("#newimg").attr('src', imgsrc);
                                download(imgsrc);
                            }
                        });
                    });


                });

            });

        </script>



        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/html2canvas.js"></script>
        <script src="assets/js/download.js"></script>
    </body>

    </html>
