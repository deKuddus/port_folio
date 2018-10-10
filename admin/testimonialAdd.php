<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$TestimonialBy = $format->validation($_POST['TestimonialBy']);
			$tesimonialProfession = $format->validation($_POST['tesimonialProfession']);
			$testimonialText = $format->validation($_POST['testimonialText']);
			
			$TestimonialBy = mysqli_real_escape_string($db->link, $TestimonialBy);
            $tesimonialProfession = mysqli_real_escape_string($db->link, $tesimonialProfession); 
            $testimonialText = mysqli_real_escape_string($db->link, $testimonialText);

           
		     if($TestimonialBy == "" OR $tesimonialProfession == "" OR $testimonialText == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }
		     else{
		     	$query_testimonial = "INSERT INTO testimonial_table (testimonial_text,testimonial_by,testimonial_profession) VALUES ('$testimonialText','$TestimonialBy','$tesimonialProfession')";
		     	$inserted_testimonial_rows = $db->insert($query_testimonial);
		     	if($inserted_testimonial_rows){

		             $message =   "<span class='succes'> Testimonial Information Added  Successfully.</span>";
		         }
		         else{
		             $message = "<span class='err'>Testimonial Information not Added</span>";
		         }

		         
		  


		     }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Add Testimonial </h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">               
                  <form action="" method="POST">
					 
                  	 <div class="form-group">
					    <label for="testimonialBy">Testimonial By: </label>
					    <input type="text"class="form-control" id="testimonialBy"   name="TestimonialBy" placeholder="Testimonial By" />
						</div>
						

											    	
					   <div class="form-group">
					    <label for="tesimonialProfession">Tesimonial Given Profession: </label>
					    <input type="text"class="form-control" id="tesimonialProfession"  maxlength = "100" name="tesimonialProfession" placeholder="Testimonial Given Profession" />
						</div>

					

					    <div class="form-group">
					    <label for="testimonialText">Testimonial Text: </label>
					    <textarea rows="5" class="form-control" id="testimonialText" name="testimonialText"></textarea>
						</div>
					    

						
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>        
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>