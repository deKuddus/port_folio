<?php
include "inc/header.php";
include "inc/sidebar.php"
?>
<?php
    if(isset($_GET['categoryId'])){
        $categoryId = $_GET['categoryId'];

        $deleteQuery = "DELETE FROM category_table WHERE id = '$categoryId'";
        $success = $db->delete($deleteQuery);
        if($success){
            echo "<script>
                    $( document ).ready(function() {
                            alert('Data  deleted success fully');
                            location.window = 'view.php';
                        });
                </script>";
        }else{
            echo "<script>
                    $( document ).ready(function() {
                            alert('Data NOT deleted success fully');
                            location.window = 'view.php';
                        });
                </script>";
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
                    <th width="20%">NO.</th>
                    <th width="60%">Category Name</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM category_table ORDER BY id DESC";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

				?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['category_name'] ?></td>
                    <td>
                        
                       <a href="categoryUpdate.php?categoryId=<?php echo $data['id'];?> ">Edit</a>||

                        <a onclick="return confirm('are you sure to delete post');" href="?categoryId=<?php echo $data['id']?>">Delete</a></td>
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