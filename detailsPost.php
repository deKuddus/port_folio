<?php 
    include "inc/header.php";

?>

 
    <div class="container sections-wrapper">
        <div class="row">
            <div class="primary col-lg-8 col-12">
            
    
<section class="about section">
<div class="section-inner">
        <article>
                 
   

                     <?php
                        if(isset($_GET['postId']) && isset($_GET['postTitle']))
                        {
                            $postID = $_GET['postId'];
                            $postTitle = $_GET['postTitle'];
                        }
                        $query  = "SELECT * FROM post_table WHERE id = '$postID' AND title = '$postTitle'";
                        $post = $db->select($query);
                        if($post){
                            foreach ($post as $data) {
                                
                        ?>
                       
                             <h2 class="heading"><?php echo  $data['title']; ?></h2>

                            <p> <?php echo $format->dateFormat($data['date']) ; ?>  By  <a href="#"> <?php echo  $data['author']; ?> </a> </p>

                            <img src="admin/<?php echo  $data['image'];?>" alt="Article image" class="img-thumbnail" height = "100px" width = "500px">

                            <p style="line-height: 35px;font-size: 22px;text-align: justify;"> <?php echo $data['body']; ?> </p>

                    
                        <?php
                        }}else{
                            echo header("Location:404.php");
                        }

                        ?>
                       
        </article>
            </div><!--//section-inner-->                 
        </section><!--//section-->
 </div><!--//primary-->





<?php 
    include "inc/sidevar.php";
    include "inc/footer.php";

?>
