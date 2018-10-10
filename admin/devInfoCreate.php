<?php
include "inc/header.php";
include "inc/sidebar.php"
?>


<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$name = $format->validation($_POST['name']);
			$tag = $format->validation($_POST['tag']);
			$about = $format->validation($_POST['about']);

			$name = mysqli_real_escape_string($db->link, $_POST['name']);
            $tag = mysqli_real_escape_string($db->link, $_POST['tag']); 
            $about = mysqli_real_escape_string($db->link, $_POST['about']);

             $permitted = array('jpg' , 'jpeg' , 'png' , 'gif');
		     $file_Name = $_FILES['image']['name'];
		     $file_Size = $_FILES['image']['size'];
		     $file_Temp = $_FILES['image']['tmp_name'];
		     $div = explode('.',$file_Name);
		     $file_ext = strtolower(end($div));
		     $unique_image = substr(md5(time()), 0 ,10).'.'.$file_ext;
		     $uploaded_image = "upload/".$unique_image;
		     if($name == "" OR $tag == "" OR $about == ""){
		         echo "<span class='err'>Input field should not be empty</span>";
		     }
		     elseif($file_Size > 1048567){
		         echo "<span class='err'>Image should be less then 1MB.</span>";
		     }
		     elseif (in_array($file_ext , $permitted) === false){
		         echo "<span class='err'>you can upload only :-".implode(',' , $permitted)."</span>";
		     }
		     else{
		         move_uploaded_file($file_Temp ,$uploaded_image);
		         $query = "INSERT INTO   user (name,tag,about,image) VALUES ('$name', '$tag', '$about', '$uploaded_image')";
		         $inserted_rows = $db->Insert($query);
		         if($inserted_rows){
		             echo  "<span class='succes'>Information Added  Successfully.</span>";
		         }
		         else{
		             echo "<span class='err'>Information not Added</span>";
		         }
		     }

	}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2> ADD My Infromation</h2>
                <div class="block" style="width: 600px;margin:  0 auto;">               
                  <form action="" method="POST" enctype="multipart/form-data">
					  <div class="form-group">
					    <label for="name">Name: </label>
					    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name">
						</div>

						<div class="form-group">
					    <label for="tag">Tag: </label>
					    <input type="text" class="form-control" id="tag"  name="tag" placeholder="Enter tag">
						</div>
						<div class="form-group">
					    <label for="about">About Myself: </label>
					    <textarea class="form-control" rows="5" id="about" name="about"></textarea>
						</div>
						<div class="form-group">
					    <label for="image">Image: </label>
					    <input type="file" class="form-control-file" id="image" name="image">
					  </div>
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>        
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?>