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

			            $p_id = $_GET['projectid'];

			             $permitted = array('jpg' , 'jpeg' , 'png' , 'gif');
					     $file_Name = $_FILES['projectimage']['name'];
					     $file_Size = $_FILES['projectimage']['size'];
					     $file_Temp = $_FILES['projectimage']['tmp_name'];
					     $div = explode('.',$file_Name);
					     $file_ext = strtolower(end($div));
					     $unique_image = substr(md5(time()), 0 ,10).'.'.$file_ext;
					     $uploaded_image = "upload/project_image/".$unique_image;
					     if($projectCategory == "" OR $projectTitle == "" OR $aboutProject == ""){
					         $message = "<span class='err'>Input field should not be empty</span>";
					     }
					     else{
					     		if(!empty($file_Name))
					     		{
					     			if($file_Size > 2048567)
					     			{
					     				$message =   "Image size too long";
					     			}
					     			elseif(in_array($file_ext, $permitted) === false)
					     			{
					     				$message = "<span class='err'>you can upload only :-" . implode(',', $permitted) . "</span>";
					     			}
					     			else
					     			{
					     				 if(move_uploaded_file($file_Temp ,$uploaded_image))
					     				 {
					     				 $query = " UPDATE project_table
					     				 			   SET
					     				 			   category = '$projectCategory',
					     				 			   title = '$projectTitle',
					     				 			   about = '$aboutProject',
					     				 			   image = '$uploaded_image'
					     				 			   WHERE id = '$p_id' ";
					     				  $update_rows = $db->update($query);
					     				  if($update_rows)
					     				  {
					     				  	$message = "Project Information Successfully Updated";
					     				  }
					     				  else
					     				  {
					     				  	$message = "Project Information Not Updated";
					     				  }
					     				}
					     				else
					     				{
					     				  	$message = "not ";
					     				 }

									}
					     		}
					     		else
					     		{
				     				$query = " UPDATE project_table
				     				 			   SET
				     				 			   category = '$projectCategory',
				     				 			   title = '$projectTitle',
				     				 			   about = '$aboutProject'
				     				 			   WHERE id = '$p_id' ";

				     				$update_rows = $db->update($query);

				     				if($update_rows)
				     				{
				     					$message = "Project Information Successfully Updated";
				     				}
				     				else
				     				{
				     					$message = "Project Information Not Updated";

				     				}

					     		}
					   }
				}
			?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Add Project </h2>
                <?php echo $message ; ?>
              
                <div class="block" style="width: 700px;margin:  0 auto;">  

                <?php 

                	if (isset($_GET['projectid']) && $_GET['title'] != NULL ) {
                		$p_id = $_GET['projectid'];
                		$p_title = $_GET['title'];
                	}
                		
                		$query = "SELECT * FROM project_table WHERE id = '$p_id' AND title = '$p_title'";
                		$results = $db->select($query);
                		if($results){
                			foreach ($results as $result) {
                				
                ?>             
                  <form action="" method="POST" enctype="multipart/form-data">

					  <div class="form-group">
					    <label for="projectcat">Project Category: </label>
					    <input type="text" class="form-control" id="projectcat" name="projectcat"  value="<?php echo $result['category'];?>"/>
						</div>

						<div class="form-group">
					    <label for="projecttitle">project Title: </label>
					    <input type="text" class="form-control" id="projecttitle"  name="projecttitle" value="<?php echo $result['title'];?>"">
						</div>
						<div class="form-group">
					    <label for="aboutproject">About Project: </label>
					    <textarea class="form-control" rows="5" id="aboutproject" name="aboutproject"> <?php echo $result['about'];?></textarea>
						</div>
						<div class="form-group">
							<div class="form-group col-md-12">
							<div class="floatleft col-md-6">
							    <label for="image">Previous  Image: </label></br>
							    <img src="<?php echo $result['image'];?>" height = "80px" width = "60px"/>
							</div>
							<div class="floatright col-md-6">
							    <label for="image">Project Image: </label>
							    <input type="file" class="form-control-file" id="projectimage" name="projectimage">
							</div>
							</div>	
						
					  </div>
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>        
					  	<?php }} ?>
                </div>
            </div>

        </div>


<?php include "inc/footer.php";?>