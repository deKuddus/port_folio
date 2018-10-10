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
		     if($_GET['userId']){
		     	$id = $_GET['userId'];
		     }
		     if($name == "" OR $tag == "" OR $about == ""){
		         echo "<span class='err'>Input field should not be empty</span>";
		     }
		    else{

		    	if (!empty($file_Name)) {
                    if ($file_Size > 1048567) {
                        echo "<span class='err'>Image should be less then 1MB.</span>";
                    } elseif (in_array($file_ext, $permitted) === false) {
                        echo "<span class='err'>you can upload only :-" . implode(',', $permitted) . "</span>";
                    } else {
                    	if(move_uploaded_file($file_Temp ,$uploaded_image)){
                        
                        $query = "UPDATE user 
                            SET 
                            name = '$name',
                            tag = '$tag',
                            about = '$about',
                            image = '$uploaded_image'
                            WHERE  id ='$id' ";
                        $updated_rows = $db->update($query);
                        if ($updated_rows) {
                            echo "<script>alert('Information  updated Successfully.');</script>";
                        } 

                    }else {
                              echo "<script>alert('Information Not updated Successfully.');</script>";
                        }
                    }


               }else{
               		 $query = "UPDATE user 
                            SET 
                            name = '$name',
                            tag = '$tag',
                            about = '$about',
                            image = '$uploaded_image'
                            WHERE  id ='$id'
                          
                ";
                        $updated_rows = $db->update($query);
                        if ($updated_rows) {
                            echo "<script>alert('Information  updated Successfully.');</script>";
                        } else {
                              echo "<script>alert('Information Not updated Successfully.');</script>";
                        }

               }
		    
		   

	}
}
?>

<?php 
	if(isset($_GET['userId'])){

		$id = $_GET['userId'];
		$query = "SELECT * FROM user WHERE id = '$id'";
		$singleData  =  $db->select($query);
		foreach ($singleData as $data) {
	?>

    <div class="grid_10">
		
            <div class="box round first grid">
                <h2> ADD My Infromation</h2>
                <div class="block" style="width: 600px;margin:  0 auto;">               
                  <form action="" method="POST" enctype="multipart/form-data">
					  <div class="form-group">
					    <label for="name">Name: </label>
					    <input type="text" class="form-control" id="name" name="name"  value="<?php echo $data['name'];?>" >
						</div>

						<div class="form-group">
					    <label for="tag">Tag: </label>
					    <input type="text" class="form-control" id="tag"  name="tag" value="<?php echo $data['tag'];?>">
						</div>
						<div class="form-group">
					    <label for="about">About Myself: </label>
					    <textarea class="form-control" rows="5" id="comment" name="about"><?php echo $data['about'];?></textarea>
						</div>
						<div class="form-group col-md-12">
							<div class="floatleft col-md-6">
						    <label for="image">Image: </label>
						    <input type="file" class="form-control-file" id="image" name="image">
							</div>
							<div class="floatright col-md-6">
								<img src="<?php echo $data['image'];?>" width = "80px" height = "60px" />
							</div>
					  </div>
					  <button   type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>        
                </div>
            </div>
        </div>

    <?php } }?>

   

<?php include "inc/footer.php";?>