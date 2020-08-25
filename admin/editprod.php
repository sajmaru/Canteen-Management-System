<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_GET['edit']))
	{
		$editid=$_GET['edit'];
	}


	
if(isset($_POST['submit']))
  {
    
    $name=$_POST['name'];
    $cname=$_POST['cname'];
    $rate=$_POST['rate'];
    $description=$_POST['description'];
   
	
	
	$sql="UPDATE items SET name=(:name), cname=(:cname), rate=(:rate), description=(:description) WHERE pid=(:editid)";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':name', $name, PDO::PARAM_STR);
    $query-> bindParam(':cname', $cname, PDO::PARAM_STR);
    $query-> bindParam(':rate', $rate, PDO::PARAM_STR);
    $query-> bindParam(':description', $description, PDO::PARAM_STR);
    $query-> bindParam(':editid', $editid, PDO::PARAM_STR);
	$query->execute();
    
     
	$msg="Information Updated Successfully";
}    
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Edit Product</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

	<script type= "text/javascript" src="../vendor/countries.js"></script>
	<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
</head>

<body>
<?php
		$sql = "SELECT * from items where pid = :editid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':editid',$editid,PDO::PARAM_INT);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">Edit Product <?php echo htmlentities($result->name); ?></h3>
                        <?php echo htmlentities($resulti->cid);?>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">
<div class="form-group">
<label class="col-sm-2 control-label" >Name</label>
<div class="col-sm-4">
<input type="text" name="name" class="form-control" value="<?php echo htmlentities($result->name);?>">
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Category</label>
<div class="col-sm-4">

  <?php
$query = $dbh->query("select * from categories"); // Run your query

echo '<select class="form-control" name="cname">'; // Open your drop down box
echo '<option value="">Select Category </option>';
// Loop through the query results, outputing the options one by one
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
   echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
}

echo '</select>';
?>
</div>
</div>
<label class="col-sm-2 control-label">Rate</label>
<div class="col-sm-4">
<input type="text" name="rate" class="form-control"  value="<?php echo htmlentities($result->rate);?>">
</div>
<label class="col-sm-2 control-label">Description</label>
<div class="col-sm-4">
<input type="text" name="description" class="form-control"  value="<?php echo htmlentities($result->description);?>">
</div>
</div>


<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
	</div>
</div>

</form>
									</div>
								</div>
							</div>
						</div>
						
					

					</div>
				</div>
				
			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
	</script>

</body>
</html>
<?php } ?>