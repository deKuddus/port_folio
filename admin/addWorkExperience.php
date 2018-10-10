<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$workPosition = $format->validation($_POST['workposition']);
			$companyName = $format->validation($_POST['companyname']);
			$startDate = $format->validation($_POST['startdate']);
			$endDate = $format->validation($_POST['enddate']);
			$aboutJob = $format->validation($_POST['aboutjob']);

			$workPosition = mysqli_real_escape_string($db->link, $workPosition);
            $companyName = mysqli_real_escape_string($db->link, $companyName); 
            $startDate = mysqli_real_escape_string($db->link, $startDate);
            $endDate = mysqli_real_escape_string($db->link, $endDate);
            $aboutJob = mysqli_real_escape_string($db->link, $aboutJob);

           
		     if($workPosition == "" OR $companyName == "" OR $startDate == "" && $aboutJob == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }
		     else{

		         $query = "INSERT INTO   experience_table (position,company_name,start_date,end_date,about_job) VALUES ('$workPosition', '$companyName', '$startDate', '$endDate','$aboutJob')";
		         $inserted_rows = $db->Insert($query);
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
                <h2> Add Working Experience </h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">               
                  <form action="" method="POST">
					  <div class="form-group">
					    <label for="workposition">Working Position: </label>
					    <input type="text" class="form-control" id="workposition" name="workposition"  placeholder="Enter working Position">
						</div>

						<div class="form-group">
					    <label for="companyname">Company Name: </label>
					    <input type="text" class="form-control" id="companyname"  name="companyname" placeholder="Enter Company Name">
						</div>
						<div class="form-group">
						<div class="col-md-12">
					    <label>Working Time: </label></br>
					    <div class="floatleft col-md-6">
					    <label for="startdate">From: </label>
						<input type="date" class="form-control" id="startdate"  name="startdate">
					    </div>
					     <div class="floatleft col-md-6">
					    <label for="enddate">To:: </label>
						<input type="date" class="form-control" id="enddate"  name="enddate" placeholder="Enter project title">
					    </div>	
					    </div>
						</div>
						<div class="form-group">
					    <label for="aboutjob">Qoute about the Job: </label>
					    <textarea class="form-control" rows="5" id="aboutjob" name="aboutjob"></textarea>
						</div>

						
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>        
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>