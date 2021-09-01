<?php 

$servername  = 'localhost';
$username    = 'root';
$password    =  '';
$dbname      = 'cvautomation';
$conn = new mysqli($servername, $username, $password ,$dbname);
    // Check connection
if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
}
?>
<?php 
$pageno = (isset($_GET['pageno'])) ? $_GET['pageno'] : 1;

$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM cvautomation";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    
if(isset($_POST['submit'])){
    $search = trim($_POST['search']);
    $total_pages_sql = "SELECT COUNT(*) FROM cvautomation WHERE `name` LIKE '%".$search."%' ";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $sql = "SELECT * FROM cvautomation  WHERE `name` LIKE '%".$search."%'";   
}
else{
    $sql = "SELECT * FROM cvautomation LIMIT $offset, $no_of_records_per_page";
}
$res_data = mysqli_query($conn,$sql);
$data = [];
if(mysqli_num_rows($res_data) > 0 ){
    while($row = mysqli_fetch_assoc($res_data)){
        $data[] = $row;
    }
}




    // echo $row['name'];
    mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
    <title>CV pagination</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>

</head>
<body>
    <?php
        // echo '<pre>';
        //     print_r($data);
        // echo '</pre>';
    ?>
    <div class="row bg-blue">
        <div class="col-lg-4">
            <div class="d-flex justify-content-center">
                <img src="../img/header-mask.png"  alt=""><span class="text-white  threerem"> REMOTODOJO</span>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="d-flex justify-content-center">
                <p class="text-white  threerem">CV AUTOMATION</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="d-flex justify-content-center">
                <p class="text-white">Admin</p>
            </div>
        </div>
    </div>
     <!-- end row background blue header-->
    <div class="row mt-4">
        <div class="container bg-blue rounded">
            <div class="d-flex justify-content-between">
                <div class="pl-4 pt-4">
                    <form action="" method="POST">
                        <div class="input-group">
                            <div class="form-outline rounded">
                                <input  id="search-input" type="search" name="search" id="form1" class="form-control" />
                                <label class="form-label" for="form1">Search</label>
                            </div>
                            <button id="search-button" type="submit" name="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="pl-4 pt-4">
                    <a href="../index.php?id=0" id="cv-convert" class="" target="_blank">CV Automation</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="container border rounded">
            <table class="table">
            <thead>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Edit Date</th>
                <th>Edited by</th>
                <th colspan="2" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($data as $tble_data):?>
                <tr id="delete<?=$tble_data['id'];?>" >
                    <td><?=$tble_data['id']?></td>
                    <td><?=$tble_data['name']?></td>
                    <td><?=$tble_data['position']?></td>
                    <td><?=$tble_data['date_edited']?></td>
                    <td><?=$tble_data['date_edited']?></td>
                    <td><a class="edit-data" href="../index.php?id=<?=$tble_data['id'];?>">Edit</a></td>
                    <td><a class="delete-data text-white" href="#" onclick="delete_data(<?=$tble_data['id'];?>)" >Delete</a></td>
                </tr>
              <?php endforeach;?>
            </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="container"> 
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <?php $_GET['pageno'] = 1;?>
                            <a class="page-link" href="?<?= http_build_query($_GET) ?>">First</a>
                        </li>
                        <li class="page-item <?= $pageno <= 1 ? 'disabled' : '';?>">
                            <?php $_GET['pageno'] = $pageno <= 1 ? '' : $pageno - 1;?>
                            <a class="page-link" href="?<?=http_build_query($_GET)?>">Prev</a>
                        </li>
                        <li class="page-item <?=$pageno >= $total_pages ? 'disabled' : '';?> ">
                            <?php $_GET['pageno'] = $pageno >= $total_pages ? '': $pageno + 1;?>
                            <a class="page-link" href="?<?=http_build_query($_GET)?>">Next</a>
                        </li>
                        <li class="page-item <?=$pageno == $total_pages ? 'disabled' : '';?> ">
                            <?php $_GET['pageno'] = $total_pages;?>
                            <a class="page-link" href="?<?=http_build_query($_GET)?>">Last</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> 
</body>

<script>
    function delete_data(id){
        if(confirm('are You Sure?')) {
            $.ajax({
                type:'POST',
                url:'delete.php',
                data:{delete_id:id},
                success: function(data){
                    $('#delete'+id).hide('slow');
                }
            });
        }
    }
</script>
</html>
