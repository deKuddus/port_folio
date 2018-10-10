<?php 
    include "inc/contactHeader.php";

?>
<?php 

	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$userEmail = $format->validation($_POST['userEmail']);
		$userText = $format->validation($_POST['userText']);

		$userEmail = mysqli_real_escape_string($db->link, $userEmail);
		$userText = mysqli_real_escape_string($db->link, $userText);

		if($userEmail == "" OR $userText == ""){
			$message = "<div class = 'alert alert-danger'>Input Field Can not be <strong>Empty</strong></div>";
		}elseif (filter_var($userEmail , FILTER_VALIDATE_EMAIL) === false){
            $message  = "<div class='btn btn-danger'><strong>Error! </strong> email address is not valid.</div>";
        }else{
        	$query = "INSERT INTO user_contact_table (contact_email,contact_text) VALUES ('$userEmail','$userText')";
        	$insertted_row = $db->insert($query);
        	if($insertted_row){
        		 echo "<script>alert('Thanks for contact with us');</script>";
        		 echo "<script>window.location = 'index.php';</script>";
        		
        		
        	}else{
        		$message = "<div class='btn btn-info'>Sorry!! Something were worng.</div>";
        		
        	}
        }
	}

?>
 
    <div class="container sections-wrapper">
        <div class="row">
            <div class="primary col-lg-8 col-12">
            
    
        	<section class="about section">
                 <div class="section-inner">
                    <h2 class="heading">Contact  Me</h2>
                    <?php echo $message; ?>
                   	<form action="" method="POST">
				 
					 <div class="form-group">
					    <label for="userEmail">Your Email: </label>
					    <input type="email"class="form-control" id="userEmail"   name="userEmail" required="required" placeholder="Write your Email Here..." />
						</div>

						<div class="form-group">
					    <label for="userText">Your Message: </label>
					    <textarea rows="5" class="form-control" id="userText" name="userText">
					    </textarea>
						</div>
					    
					  <button type="submit"  class="btn btn-primary">Submit</button>

					</form> 
            </div><!--//section-inner-->                 
        </section><!--//section-->
 </div><!--//primary-->





<?php 
    include "inc/sidevar.php";
    include "inc/footer.php";

?>
