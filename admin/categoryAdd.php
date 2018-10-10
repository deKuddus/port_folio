<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$postCategory = $format->validation($_POST['postCategory']);

            $postCategory = mysqli_real_escape_string($db->link, $postCategory);
           
		     if($postCategory == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }
		     else{
		     	$query_skill = "INSERT INTO category_table (category_name) VALUES ('$postCategory')";
		     	$inserted_skill_rows = $db->insert($query_skill);
		     	if($inserted_skill_rows){
		     		$message = "<span class='succes'>Category Information  Added</span>";
		         }
		         else{
		             $message = "<span class='err'>Category Information not Added</span>";
		         }
		     }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add post category</h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">             
                  <form action="" method="POST">					

					     <div class="form-group">
					    <label for="postCategory">Category: </label>
					    <input type="text" class="form-control" id="postCategory" name="postCategory" placeholder="Enter Your Category" required="required" />
						</div>
					  	
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form> 
					      
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>