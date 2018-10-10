

<?php 

    include "helper/Format.php";
    include "config/config.php";
    include "library/Database.php";
  
  
    $format = new  Format();
    $db = new Database();
  
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home-Web Developer</title>
    <!-- Meta -->
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
    <meta content='portfolio' name='generator'/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web developer portfolio.">
    <meta name="author" content="Md Abdul Kuddus">    
    <link rel="shortcut icon" href="web.png">  
    
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    
    <!-- FontAwesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
    
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">   
    
    <!-- github calendar css -->
    <link rel="stylesheet" href="assets/plugins/github-calendar/dist/github-calendar.css">
    <!-- github acitivity css -->    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
    <link rel="stylesheet" href="assets/plugins/github-activity/github-activity-0.1.5.min.css">
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <link  rel="stylesheet" href="assets/css/external.css">
    <link  rel="stylesheet" href="assets/css/github-calendar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="assets/js/github-calendar.min.js" type="text/javascript"></script>


    
</head> 


<body>
    <!-- ******HEADER****** --> 
<header class="header">
        <div class="container clearfix"> 

             <?php
                $query = "SELECT * FROM user WHERE  id ='1'";
                $user = $db->select($query);
                if($user){
                while ($data = $user->fetch_assoc()){

                ?>

            <img class="profile-image img-fluid new-img float-left" src="admin/<?php echo $data['image'];?>" alt="James Lee" />
            <div class="profile-content float-left">
                <h1 class="name"><?php echo $data['name'];?></h1>
                <h2 class="desc"><?php echo $data['tag'];?></h2>   
                <ul class="social list-inline">
                    <li class="list-inline-item"><a href="https://twitter.com/kuddus137"><i class="fab fa-twitter thover_style"></i></a></li>                   
                    <li class="list-inline-item "><a href="https://plus.google.com/u/1/+mdkuddusmunsi"><i class="fab fa-google-plus-g ghover_style"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/abdulkuddus37/"><i class="fab fa-linkedin-in lhover_style"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-github-alt"></i></a></li>    
                    <li class="list-inline-item"><a href="https://stackoverflow.com/users/7828664/md-kuddus"><i class="fab fa-stack-overflow shover_style"></i></a></li>   
                    <li class="list-inline-item last-item"><a href="#"><i class="fab fa-codepen"></i></a></li>                
                </ul> 
            </div><!--//profile-->
            <a  style="margin-left: 10px" class="btn btn-outline-success float-right" href="contact.php" ><i class="fas fa-paper-plane"></i> Contact Me</a>
             <a class="btn btn-outline-success float-right" href="contact.php" ><i class="fab fa-blogger-b"></i> Blog</a>


                        
        </div><!--//container-->
             <?php }}?>
    </header><!--//header-->