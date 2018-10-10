<?php
	include "inc/header.php";
	include "inc/sidebar.php"
?>
<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$postCategory = $format->validation($_POST['postCategory']);

            $postCategory = mysqli_real_escape_string($db->link, $postCategory);

           	$categoryId = $_GET['categoryId'];

		     if($postCategory == ""){
		         $message = "<span class='err'>Input field should not be empty</span>";
		    }
		     else{
		     	$query_skill = "UPDATE  category_table SET category_name = '$postCategory' WHERE id = '$categoryId'";
		     	$updated_skill_rows = $db->update($query_skill);
		     	if($updated_skill_rows){

		             $message =   "<span class='succes'> Category Information Updated  Successfully.</span>";
		         }
		         else{
		             $message = "<span class='err'>Category Information not updated</span>";
		         }
		     }

	}
?>


  <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add post category</h2>
                <?php echo $message; ?>
                <div class="block" style="width: 700px;margin:  0 auto;">  
                <?php 
                	if($_GET['categoryId']){
                		$categoryId = $_GET['categoryId'];
                	}
                	$query = "SELECT * FROM category_table WHERE id = '$categoryId'";
                	$selected_rows =  $db->select($query);
                	if($selected_rows){
                		foreach ($selected_rows as $result) {
                		
                 ?>           
                  <form action="" method="POST">					

					     <div class="form-group">
					    <label for="postCategory">Category: </label>
					    <input type="text" class="form-control" id="postCategory" name="postCategory" value="<?php echo $result['category_name'];?>" required="required" />
						</div>
					  	
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form> 
					    <?php }} ?>  
                </div>
            </div>
        </div>


<?php include "inc/footer.php";?>