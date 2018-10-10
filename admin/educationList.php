<?php
include "inc/header.php";
include "inc/sidebar.php"
?>
<?php
    if(isset($_GET['educationID'])){
        $educationID = $_GET['educationID'];

        $deleteQuery = "DELETE FROM education_table WHERE id = '$educationID'";
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
                    <th width="10%">NO.</th>
                    <th width="20%">Graduation Title</th>
                    <th width="20%">Institution Name</th>
                    <th width="20%">Start Date</th>
                    <th width="20%">End Date</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM education_table ORDER BY id DESC";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

				?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['graduation_title'] ?></td>
                    <td><?php echo $data['institution'];  ?></td>
                    <td><?php echo $data['start_date'];  ?></td>
                    <td><?php echo $data['end_date'];  ?></td>

                    <td>
                        
                       <a href="educationUpdate.php?educationID=<?php echo $data['id'];?>&&institution=<?php echo $data['institution'];?>">Edit</a>||

                        <a onclick="return confirm('are you sure to delete post');" href="?educationID=<?php echo $data['id']?>">Delete</a></td>
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