<?php
include "inc/header.php";
include "inc/sidebar.php"
?>
<?php
    if(isset($_GET['languageId'])){
        $languageId = $_GET['languageId'];

        $deleteQuery = "DELETE FROM language_table WHERE id = '$languageId'";
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
                    <th width="30%">Language Name</th>
                    <th width="30%">Language Familiar </th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM language_table ORDER BY id";
                $allData = $db->select($query);
                if ($allData){
                    $i=0;
                    foreach ($allData as  $data) {
                        $i++;

				?>
                <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['language_name']; ?></td>
                    <td><?php echo $data['language_familiar']; ?></td>
                    <td>
                        
                       <a href="languageUpdate.php?languageId=<?php echo $data['id'];?>">Edit</a>||

                        <a onclick="return confirm('are you sure to delete post');" href="?languageId=<?php echo $data['id']?>">Delete</a></td>
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