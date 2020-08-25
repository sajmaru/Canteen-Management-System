<?php
session_start();
error_reporting(0);
$pid=array();
$rate=array();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{


  if(isset($_POST['submit']))
  {
    
    $name=$_POST['name'];
    $catname=$_POST['cname'];
    
    $result_explode = explode(',', $catname);

    $cname=$result_explode[0];
    $cid=$result_explode[1];
    $rate=$_POST['rate'];
    $description=$_POST['description'];
    
    $sql1="insert into items (cid,cname,name,rate,description,status) values($cid,:cname,:name,:rate,:description,1)";
	$query1 = $dbh->prepare($sql1);
    $query1-> bindParam(':cname', $cname, PDO::PARAM_STR);
    $query1-> bindParam(':name', $name, PDO::PARAM_STR);
	$query1-> bindParam(':rate', $rate, PDO::PARAM_STR);
    $query1-> bindParam(':description', $description, PDO::PARAM_STR);
    
	$query1->execute();
	
	#$sql="insert into $cname (name,rate,description,status) values(:name,:rate,:description,1)";
	#$query = $dbh->prepare($sql);
	#$query-> bindParam(':name', $name, PDO::PARAM_STR);
	#$query-> bindParam(':rate', $rate, PDO::PARAM_STR);
    #$query-> bindParam(':description', $description, PDO::PARAM_STR);
    
   # $query->execute();
    
    
	$msg="Information Added Successfully";

	
    
    
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
	
	<title>Menu</title>

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
    padding: 8px;
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
		$sql = "SELECT * from categories where id = :editid ";
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
						<h3 class="page-title" style="padding: 8px;">MENU<?php echo htmlentities($result->name); ?></h3>
						<div class="row">
							<div class="col-md-12" style="padding: 8px;">
								<div class="panel panel-default" style="padding: 8px;">
									<div class="panel-heading"  >Menu</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body" style="width:40%;">
   <table class="display table table-striped table-bordered table-hover" style="padding: 8px;">
					<?php
					$sql1 = $dbh->query("SELECT * FROM categories where status=1 ORDER BY id asc ");
				
  					
					
 					 while ($row = $sql1->fetch(PDO::FETCH_ASSOC)) {
                       
                      $categoryId=$row['id'];
                       
  						 echo'
                        
                         <thead style="background:#535456; color:#ffffff;" >
                           
						  <th class="col-md-2"  style="text-transform: uppercase; width:10%;">
                            '.$row['name'].'
                         
						  
						  </th>
                            <th style="width:10%;" >
                              RATE
                              </th>
                            <th class="col-md-3" style="width:10%;" >
                              QUANTITY
                              </th>
						
                           </thead>'
                            
                            ;
                            
                     
					
					//$categoryId='.$row['cid'].';
//  WHERE cid='$categoryId'
					$sql2 = $dbh->query("SELECT * FROM items WHERE cid='$categoryId' AND status=1");
					
                    
					while ($row = $sql2->fetch(PDO::FETCH_ASSOC)) {
                      array_push($pid,$row['pid']);
                      array_push($rate,$row['rate']);
					echo '
                   
                      
					<td style="text-transform: capitalize;">
					'.$row['name'].'
                    </td>
                    <td>
                      
                      
                     <div class="form-group">
  <label class="col-md-4 control-label" for="prependedtext"></label>
  <div class="col-md-5">
    <div class="input-group">
      <span class="input-group-addon">₹</span>
      <input id="prependedtext" name="prependedtext" class="form-control" value="'.$row['rate'].'" type="text" disabled autocomplete="off">
    </div>
    
  </div>
</div>
                      
                    </td>
                    <td>
                       
   <div class="center" >
   
      <div class="input-group input-sm">
          <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="pid-'.$row['pid'].'">
                  <i class="fa fa-minus"></i>
              </button>
          </span>
          <input type="text" class="form-control input-number" name="pid-'.$row['pid'].'"  value="0" min="0" max="10">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="pid-'.$row['pid'].'">
                  <i class="fa fa-plus"></i>
              </button>
          </span>
      </div>
	<p></p>
</div>
                      </td>
                
					</tr>';

					
                     }
                     }
  
  
					?>
		
					</table>
	


</form>
									</div>
								</div>
							</div>
						</div>
						
					

					</div>
				</div>
				
			<div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
                    </div>
                  </div>   
                      
                      
                                        <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">GST  5%</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" autocomplete="off">
                    </div>
                  </div>
                      
                      <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                    </div>
                  </div>

                                     <div class="box-footer">
              
                <button type="submit" class="btn btn-primary">Create Order</button>
                <a href="" class="btn btn-warning">Back</a>
              </div>         

			</div>
		</div>
	</div>
                    
 
                

	<script>
                  var pids = [<?php echo '"'.implode('","', $pid).'"' ?>];
  var rates = [<?php echo '"'.implode('","', $rate).'"' ?>];
  // alert(pids[1]);
 // alert(rates);
    var arr = [];
  var i;
  var gt=0;
for (i = 0; i < pids.length; i++) { 

  var aa= document.getElementsByName("pid-"+pids[i])[0].value;
  arr.push(aa);
 
 // alert(aa);
}
  for (i = 0; i < arr.length; i++) { 
     
     gt=gt+(rates[i] * arr[i]);
  }
  
  alert(gt);
  
  document.getElementById("net_amount").innerHTML = gt;
 // alert(arr);
  
                  </script>

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js" ></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>




	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
    <script src="bootstrap-number-input.js" ></script>
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