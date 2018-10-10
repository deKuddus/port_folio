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
                 }
                 elseif($file_Size > 1048567){
                     echo "<span class='err'>Image should be less then 1MB.</span>";
                 }
                 elseif (in_array($file_ext , $permitted) === false){
                     echo "<span class='err'>you can upload only :-".implode(',' , $permitted)."</span>";
                 }
                 else{
                   /* move_uploaded_file($file_Temp ,$uploaded_image);*/
                    if(move_uploaded_file($file_Temp ,$uploaded_image)){
                     $query = "INSERT INTO   post_table (category,title,body,image,author,tag) VALUES ('$category', '$title', '$body', '$uploaded_image', '$author', '$tags')";
                     $inserted_rows = $db->Insert($query);
                     if($inserted_rows){
                         echo  "<span class='succes'>Post Uploaded Successfully.</span>";
                     }
                     else{
                         echo "<span class='err'>Post Not Uploaded.</span>";
                     }
                    }else{
                        echo "Not upload";
                    }

                 }
                 }
             ?>
            <div class="block">
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tag" placeholder="Enter tags" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label> Author </label>
                            </td>
                            <td>
                                <input type="text" name="author" placeholder="Enter Author Name" class="medium" />
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
                                <option value="<?php echo $catagory['id'] ?>"><?php echo $catagory['category_name'] ?></option>
                                <?php }}?>
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
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
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
                </div>
            </div>
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
<?php include "inc/footer.php";?>

