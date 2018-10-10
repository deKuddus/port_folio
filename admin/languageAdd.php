<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$languageName = $format->validation($_POST['languageName']);
			$laguageFamiliar = $format->validation($_POST['laguageFamiliar']);
			
			$languageName = mysqli_real_escape_string($db->link, $languageName);
            $laguageFamiliar = mysqli_real_escape_string($db->link, $laguageFamiliar); 


           
		     if($languageName == "" OR $laguageFamiliar == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }
		     else{
		     	$query_language = "INSERT INTO language_table (language_name,language_familiar) VALUES ('$languageName','$laguageFamiliar')";
		     	$inserted_language_rows = $db->insert($query_language);
		     	if($inserted_language_rows){

		             $message =   "<span class='succes'> Language Information Added  Successfully.</span>";
		         }
		         else{
		             $message = "<span class='err'>Language Information not Added</span>";
		         }

		      }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Add Language </h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">               
                  <form action="" method="POST">
					 
                  	 <div class="form-group">
					    <label for="languageName">Language Name: </label>
					    <input type="text"class="form-control" id="languageName"   name="languageName" placeholder="Lnagugage Name" />
						</div>
						
						 <div class="form-group">
					    <label for="laguageFamiliar">Familiar with: </label>
					    <textarea rows="5" class="form-control" id="laguageFamiliar" name="laguageFamiliar"></textarea>
						</div>
					    

						
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>        
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>