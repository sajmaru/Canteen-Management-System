    <?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
  
if(isset($_GET['del']) && isset($_GET['name']))
{
$id=$_GET['del'];
$name=$_GET['name'];

$sql = "delete from users WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();

$sql2 = "insert into deleteduser (email) values (:name)";
$query2 = $dbh->prepare($sql2);
$query2 -> bindParam(':name',$name, PDO::PARAM_STR);
$query2 -> execute();

$msg="Data Deleted successfully";
}

if(isset($_REQUEST['unconfirm']))
	{
	$aeid=intval($_GET['unconfirm']);
	$memstatus=1;
	$sql = "UPDATE users SET status=:status WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Changes Sucessfully";
	}

	if(isset($_REQUEST['confirm']))
	{
	$aeid=intval($_GET['confirm']);
	$memstatus=0;
	$sql = "UPDATE users SET status=:status WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
	$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query -> execute();
	$msg="Changes Sucessfully";
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
	
	<title>Order History</title>

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
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Order History</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">List Orders</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
                                				<th>Order No.</th>
                                                
                                          		<th>Items</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Order Confirmation</th>
											    	
										</tr>
									</thead>
									
									<tbody>

<?php
 $umail=$_SESSION['alogin'];
  echo ("EMAIL: ".$umail);                                               
$sql = "SELECT * from orders where name=:mail ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':mail',$umail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	$itemid=$result->items;
$str_arr = explode (",", $itemid); 

  $a=array();
  $sql1="select * from items where pid=:nn";
for ($x = 0; $x < sizeof($str_arr); $x++)
{
  $nn=$str_arr[$x];

  	$sql1="select * from items where pid=:nn";
$query1 = $dbh -> prepare($sql1);
  $query1-> bindParam(':nn',$nn, PDO::PARAM_STR);
$query1->execute();

  $results1=$query1->fetchAll(PDO::FETCH_OBJ);
 # echo ($nn);
 # print_r($a);
foreach($results1 as $result1)
{
  array_push($a,$result1->name);
  
}
 
}
 
   ?>

										<tr>
  											<td><?php echo htmlentities($cnt);?></td>
  											<td><?php echo htmlentities($result->order_id);?>												</td>
  											
                                            
                                           
                                            <td><?php echo implode(" , ",$a);?> </td>
                                            
                                            <td><?php echo htmlentities($result->quantity);?></td>
                                            <td><?php echo htmlentities($result->amount);?></td>
                                            <td>
                                            
                                            <?php if($result->status == 1)
                                                    {?>
                                                    <a>Confirmed <i class="fa fa-check-circle"></i></a> 
                                                    <?php } else {?>
                                                    <a>Un-Confirmed <i class="fa fa-times-circle"></i></a>
                                                    <?php } ?>
</td>
                                            </td>
											

										</tr>
										<?php $cnt=$cnt+1; }}?>
										
									</tbody>
								</table>
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
