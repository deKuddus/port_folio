<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>



  <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Contact Details </h2>
                <div class="block">               
				 <?php 
				 if(isset($_GET['contactId']) && isset($_GET['contactEmail'])){
				 	$contactId = $_GET['contactId'];
				 	$contactEmail = $_GET['contactEmail'];
				 }
				 	$query = "SELECT * FROM user_contact_table WHERE id = '$contactId' AND contact_email = '$contactEmail'";
				 	$contact_data = $db->select($query);
				 	if($contact_data){
				 		foreach ($contact_data as $singleData) {
				  ?>
                  <form action="" method="POST">
					 <div class="form-group">
					    <label for="userEmail">Contact Email: </label>
					    <input type="email"class="form-control" id="userEmail"  readonly="readonly" name="userEmail"  value="<?php echo $singleData['contact_email'];?>" />
						</div>

						<div class="form-group">
					    <label for="userText">Contact Message: </label>
					    <textarea rows="5" class="form-control" readonly="readonly" id="userText" name="userText"><?php echo $singleData['contact_text'];?>
					    </textarea>
						</div>
					    
					  <a  href="inbox.php"  class="btn btn-primary">Back</a>

					</form>
					<?php }} ?>        
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>