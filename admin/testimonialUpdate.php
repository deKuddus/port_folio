<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$testimonialBy = $format->validation($_POST['testimonialBy']);
			$testimonialProfession = $format->validation($_POST['testimonialProfession']);
			$testimonialText = $format->validation($_POST['testimonialText']);
			
			$testimonialBy = mysqli_real_escape_string($db->link, $testimonialBy);
            $testimonialProfession = mysqli_real_escape_string($db->link, $testimonialProfession); 
            $testimonialText = mysqli_real_escape_string($db->link, $testimonialText);

            $testimonialId = $_GET['testimonialId'];
            $testimonial_By = $_GET['testimonial_By'];

		     if($testimonialBy == "" OR $testimonialProfession == "" OR $testimonialText == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }
		     else{
		     	$query_testimonial = "UPDATE  testimonial_table SET 
		     	testimonial_text  = '$testimonialText',
		     	testimonial_by = '$testimonialBy',
		     	testimonial_profession = '$testimonialProfession' 
		     	WHERE id = '$testimonialId' AND  testimonial_by = '$testimonial_By'";

		     	$updated_testimonial_rows = $db->update($query_testimonial);
		     	if($updated_testimonial_rows){

		             $message =   "<span class='succes'> Testimonial Information Updated  Successfully.</span>";
		         }
		         else{
		             $message = "<span class='err'>Testimonial Information not Updated</span>";
		         }

		         
		  


		     }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Add Testimonial </h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">  
                <?php
                if(isset($_GET['testimonialId']) && isset($_GET['testimonial_By'])){
                	$testimonialId = $_GET['testimonialId'];
                	$testimonial_By = $_GET['testimonial_By'];
                }
                $query = "SELECT * FROM testimonial_table WHERE id = '$testimonialId' AND testimonial_by = '$testimonial_By'";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

				?>             
                  <form action="" method="POST">
					 
                  	 <div class="form-group">
					    <label for="testimonialBy">Testimonial By: </label>
					    <input type="text"class="form-control" id="testimonialBy"   name="testimonialBy" value="<?php echo $data['testimonial_by'];?>" />
						</div>
						

											    	
					   <div class="form-group">
					    <label for="testimonialProfession">Tesimonial Given Profession: </label>
					    <input type="text"class="form-control" id="testimonialProfession"  maxlength = "100" name="testimonialProfession" value = "<?php echo $data['testimonial_profession'];?>" />
						</div>

					

					    <div class="form-group">
					    <label for="testimonialText">Testimonial Text: </label>
					    <textarea rows="5" class="form-control" id="testimonialText" name="testimonialText"><?php echo $data['testimonial_text'];?></textarea>
						</div>
					    

						
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>  
					<?php } } ?>      
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>