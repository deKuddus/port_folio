<?php
include "inc/header.php";
include "inc/sidebar.php"
?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>View Single Post</h2>

            <div class="block">
                <?php
                    if(isset($_GET['viewpostid'])) {
                        $post_id = $_GET['viewpostid'];
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
                                <input type="text" name="title" readonly="readonly" class="medium" value="<?php echo $value['title'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tag"  class="medium" readonly="readonly" value="<?php echo $value['tag'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label> Author </label>
                            </td>
                            <td>
                                <input type="text" name="author"  class="medium" readonly="readonly"  value="<?php echo $value['title'];?>"/>
                            </td>
                        </tr>
                       
                         <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                            <select id="select" name="category" >
                            <option>Select Category</option>

                             <?php
                            $query = "SELECT * FROM category_table";
                            $catagories  =  $db->select($query);
                            if($catagories){
                                foreach ($catagories as $catagory) {
                            ?>
                                <option  <?php if($value['category'] == $catagory['id']){ ?> selected = "selected" <?php } ?>

                                value="<?php echo $catagory['id'] ?>"><?php echo $catagory['category_name'] ?></option>
                                <?php } }?>
                                </select>
                            </td>

                        </tr>

                       
                         <tr>
                            <td>
                                <label> Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $value['image'];?>" id="myImg" height="100px" width = "100px">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly="readonly" name="body"><?php echo $value['body']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <a href="postList.php" class="btn btn-info">Back To List</a>  
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

