<?php
include "inc/header.php";
include "inc/sidebar.php"
?>
<?php
	if(isset($_GET['userdeleteid'])){
		$userId = $_GET['userdeleteid'];

		$deleteQuery = "DELETE FROM user WHERE id = '$userId'";
		$success = $db->delete($deleteQuery);
		if($success){
			echo "<script>alert('Data deleted success fully');</script>";
			echo "<script>location.window = 'view.php'</script>";
		}else{
			echo "<script>alert('Data not deleted success fully');</script>";
			echo "<script>location.window = 'view.php'</script>";
}

	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>My Data</h2>
        <div class="block">
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="5%">NO.</th>
                    <th width="15%">Name</th>
                    <th width="20%">Tag</th>
                    <th width="25%">About</th>
                    <th width="25%">Image</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM user ORDER BY id";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

				?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['name'] ?></a></td>
                    <td><?php echo $data['tag'] ?></td>
                    <td><?php echo $format->textShort($data['about'],100);  ?></td>
                    <td><img src="<?php echo $data['image'];?>" height="40px" width="40px" alt=""></td>

                    <td>
                        
                       <a href="devInfoUpdate.php?userId=<?php echo $data['id']?>">Edit</a>||

                        <a onclick="return confirm('are you sure to delete post');" href="?userdeleteid=<?php echo $data['id']?>">Delete</a></td>
 				</tr>
            <?php }}?>
            </tbody>
        </table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>


<?php include "inc/footer.php";?>