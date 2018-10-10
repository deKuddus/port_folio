<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$projectCategory = $format->validation($_POST['projectcat']);
			$projectTitle = $format->validation($_POST['projecttitle']);
			$aboutProject = $format->validation($_POST['aboutproject']);

			$projectCategory = mysqli_real_escape_string($db->link, $projectCategory);
            $projectTitle = mysqli_real_escape_string($db->link, $projectTitle); 
            $aboutProject = mysqli_real_escape_string($db->link, $aboutProject);

             $permitted = array('jpg' , 'jpeg' , 'png' , 'gif');
		     $file_Name = $_FILES['projectimage']['name'];
		     $file_Size = $_FILES['projectimage']['size'];
		     $file_Temp = $_FILES['projectimage']['tmp_name'];
		     $div = explode('.',$file_Name);
		     $file_ext = strtolower(end($div));
		     $unique_image = substr(md5(time()), 0 ,10).'.'.$file_ext; 
		     $uploaded_image = "upload/project_image/".$unique_image;
		     if($projectCategory == "" OR $projectTitle == "" OR $aboutProject == ""){
		         $message =  "<span class='err'>Input field should not be empty</span>";
		     }
		     elseif($file_Size > 1048567){
		         $message =  "<span class='err'>Image should be less then 1MB.</span>";
		     }
		     elseif (in_array($file_ext , $permitted) === false){
		         $message =  "<span class='err'>you can upload only :-".implode(',' , $permitted)."</span>";
		     }
		     else{

		     	if(move_uploaded_file($file_Temp ,$uploaded_image)){

		         $query = "INSERT INTO   project_table (category,title,about,image) VALUES ('$projectCategory', '$projectTitle', '$aboutProject', '$uploaded_image')";
		         $inserted_rows = $db->Insert($query);
		         if($inserted_rows){
		             $message =   "<span class='succes'>Project Information Added  Successfully.</span>";
		         }
		         else{
		             $message =  "<span class='err'>Project Information not Added</span>";
		         }



		         }else{
		         	$message =  "Not upload";
		         }

		     }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Add Project </h2>
                <?php echo $message; ?>
                <div class="block" style="width: 600px;margin:  0 auto;">               
                  <form action="" method="POST" enctype="multipart/form-data">
					  <div class="form-group">
					    <label for="projectcat">Project Category: </label>
					    <input type="text" class="form-control" id="projectcat" name="projectcat"  placeholder="Enter project category">
						</div>

						<div class="form-group">
					    <label for="projecttitle">project Title: </label>
					    <input type="text" class="form-control" id="projecttitle"  name="projecttitle" placeholder="Enter project title">
						</div>
						<div class="form-group">
					    <label for="aboutproject">About Project: </label>
					    <textarea class="form-control" rows="5" id="aboutproject" name="aboutproject"></textarea>
						</div>
						<div class="form-group">
					    <label for="image">Project Image: </label>
					    <input type="file" class="form-control-file" id="projectimage" name="projectimage">
					  </div>
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>        
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>