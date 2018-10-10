<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$addGraduation = $format->validation($_POST['addGraduation']);
			$institutionName = $format->validation($_POST['institutionName']);
			$startDate = $format->validation($_POST['startdate']);
			$endDate = $format->validation($_POST['enddate']);
			
			$addGraduation = mysqli_real_escape_string($db->link, $addGraduation);
            $institutionName = mysqli_real_escape_string($db->link, $institutionName); 
            $startDate = mysqli_real_escape_string($db->link, $startDate);
            $endDate = mysqli_real_escape_string($db->link, $endDate);

           
		     if($addGraduation == "" OR $institutionName == "" OR $startDate == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }
		     else{

		         $query = "INSERT INTO   education_table (graduation_title,institution,start_date,end_date) VALUES ('$addGraduation', '$institutionName', '$startDate', '$endDate')";
		         $inserted_rows = $db->insert($query);
		         if($inserted_rows){
		             $message =   "<span class='succes'> Information Added  Successfully.</span>";
		         }
		         else{
		             $message = "<span class='err'>Project Information not Added</span>";
		         }




		     }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Add Education: </h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">               
                  <form action="" method="POST">
					  <div class="form-group">
					    <label for="addGraduation">Add Graduation: </label>
					    <input type="text" class="form-control" id="addGraduation" name="addGraduation"  placeholder="Enter Your Graduation Title">
						</div>

						<div class="form-group">
					    <label for="institutionName">College Or University: </label>
					    <input type="text" class="form-control" id="institutionName"  name="institutionName" placeholder="Enter Your institution">
						</div>

						<div class="form-group">
						    <label>Graduation Time: </label></br>
						    <div class="form-group">
							    <label for="startdate">From: </label>
								<input type="date" class="form-control" id="startdate"  name="startdate">
						    </div>

						     <div class="form-group">
							    <label for="enddate">To:: </label>
								<input type="date" class="form-control" id="enddate"  name="enddate" placeholder="Enter project title">
						    </div>

					    </div>
						<div class="form-group">
					   		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>        
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>