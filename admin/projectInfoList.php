<?php
include "inc/header.php";
include "inc/sidebar.php"
?>
<?php
    if(isset($_GET['projectid'])){
        $userId = $_GET['projectid'];

        $deleteQuery = "DELETE FROM project_table WHERE id = '$userId'";
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
                    <th width="15%">Category</th>
                    <th width="20%">Title</th>
                    <th width="25%">About</th>
                    <th width="25%">Image</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM project_table ORDER BY id";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

				?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['category'] ?></a></td>
                    <td><?php echo $data['title'] ?></td>
                    <td><?php echo $format->textShort($data['about'],100);  ?></td>
                    <td><img src="<?php echo $data['image'];?>" height="40px" width="40px" alt=""></td>

                    <td>
                        
                       <a href="projectUpdate.php?projectid=<?php echo $data['id'];?>&&title=<?php echo $data['title'];?>">Edit</a>||

                        <a onclick="return confirm('are you sure to delete post');" href="?projectid=<?php echo $data['id']?>">Delete</a></td>
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