<?php
include "inc/header.php";
include "inc/sidebar.php"
?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Add New Post</h2>
             <?php

             if($_SERVER['REQUEST_METHOD'] == 'POST') {

                 $title = $format->validation($_POST['title']);
                 $category = $format->validation($_POST['category']);
                 $tags = $format->validation($_POST['tag']);
                 $author = $format->validation($_POST['author']);
                 $body = $format->validation($_POST['body']);

                 $title = mysqli_real_escape_string($db->link, $title);
                 $category = mysqli_real_escape_string($db->link, $category);
                 $tags = mysqli_real_escape_string($db->link, $tags);
                 $author = mysqli_real_escape_string($db->link, $author);
                 $body = mysqli_real_escape_string($db->link, $body);

                 $permitted = array('jpg' , 'jpeg' , 'png' , 'gif');
                 $file_Name = $_FILES['image']['name'];
                 $file_Size = $_FILES['image']['size'];
                 $file_Temp = $_FILES['image']['tmp_name'];
                 $div = explode('.',$file_Name);
                 $file_ext = strtolower(end($div));
                 $unique_image = substr(md5(time()), 0 ,10).'.'.$file_ext;
                 $uploaded_image = "upload/blog_image/".$unique_image;

                 if($title == "" OR $tags == "" OR $category == "" OR $body == "" OR $author == ""){
                     echo "<span class='err'>Input field should not be empty</span>";
                 }if(!empty($file_Name)){
                     if($file_Size > 3048567){
                         echo "<span class='err'>Image should be less then 3MB.</span>";
                     }
                     elseif (in_array($file_ext , $permitted) === false){
                         echo "<span class='err'>you can upload only :-".implode(',' , $permitted)."</span>";
                     }
                     else{
                        /*move_uploaded_file($file_Temp ,$uploaded_image);*/
                        if(move_uploaded_file($file_Temp ,$uploaded_image)){
                         $post_id = $_GET['postEditID'];
                         $query = "UPDATE  post_table SET  
                                 category = '$category',
                                 title = '$title',
                                 body = '$body',
                                 image = '$uploaded_image',
                                 author = '$author',
                                 tag = '$tags'
                                 WHERE id = '$post_id'";
                         $updated_rows = $db->update($query);
                         if($updated_rows){
                             echo  "<span class='succes'>Post Uploaded Successfully.</span>";
                         }
                         else{
                             echo "<span class='err'>Post Not Uploaded.</span>";
                         }
                        }else{
                            echo "Not upload";
                        }

                     }
             }else{
                 $post_id = $_GET['postEditID'];
                 $query = "UPDATE  post_table SET  
                         category = '$category',
                         title = '$title',
                         body = '$body',
                         author = '$author',
                         tag = '$tags'
                         WHERE id = '$post_id'";
                 $updated_rows = $db->update($query);
                 if($updated_rows){
                     echo  "<span class='succes'>Post updated Successfully.</span>";
                 }
                 else{
                     echo "<span class='err'>Post Not updated.</span>";
                 }

             }


        }
             ?>
            <div class="block">
                <?php
                    if(isset($_GET['postEditID'])) {
                        $post_id = $_GET['postEditID'];
                    }
                        $s_query = " SELECT * FROM post_table WHERE id = '$post_id'";
                        $result = $db->select($s_query);
                        if($result){
                            foreach ($result as $value) {
                     ?>
                     <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" class="medium" value="<?php echo $value['title'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tag"  class="medium"  value="<?php echo $value['tag'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label> Author </label>
                            </td>
                            <td>
                                <input type="text" name="author"  class="medium"  value="<?php echo $value['title'];?>"/>
                            </td>
                        </tr>
                       
                         <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                            <select id="select" name="category">
                            <option>Select Category</option>

                             <?php
                            $query = "SELECT * FROM category_table";
                            $catagories  =  $db->select($query);
                            if($catagories){
                                foreach ($catagories as $catagory) {
                            ?>
                                <option <?php if($value['category'] == $catagory['id']){ ?> selected = "selected" <?php } ?>

                                value="<?php echo $catagory['id'] ?>"><?php echo $catagory['category_name'] ?></option>
                                <?php } }?>
                                </select>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Previous Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $value['image'];?>" id="myImg" height="60px" width = "80px">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $value['body']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                 <?php } } ?>
                </div>
            </div>
        </div>
 <div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>
<?php include "inc/footer.php";?>

