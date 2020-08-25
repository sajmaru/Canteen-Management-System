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
$user=$_SESSION['alogin'];

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

									<div class="panel-body" align="center" style="width:40%;" >
                                      
   <style>
table, td {
  border: 1px solid green; /* Change border color and size here*/
  width: 500px; /* Change width of table here*/
  

}
th /* Only targeting <th> tag for gradient, change this to body to apply to whole */{
	background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
	background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite; /*change time here for gradient*/
	-moz-animation: Gradient 15s ease infinite; /*change time here for gradient*/
	animation: Gradient 15s ease infinite; /*change time here for gradient*/
}
@-webkit-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@-moz-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}
</style>
                                
   <table  class="display table table-striped table-bordered table-hover" style="width:100%;">
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
                            <th class="col-md-3" style="width:20%;">
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
					<b>'.$row['name'].'</b>
                    <br>
                   <i> '.$row['description'].'</i>
                    </td>
                   
                    <td>
                    ₹'.$row['rate'].'
                    </td>
                    
                    
                    <td>
                       
   <div class="center" >
   
      <div class="input-group input-sm">
          <span class="input-group-btn">
              <button onclick="wc()" type="button" class="btn btn-danger btn-number" data-type="minus" style="padding: 3px 3px;" data-field="pid-'.$row['pid'].'">
                  <i class="fa fa-minus"></i>
              </button>
          </span>
          <input type="text" class="form-control input-number" name="pid-'.$row['pid'].'"  value="0" min="0" max="10" style="text-align:center; height: 3px; " >
          <span class="input-group-btn">
              <button onclick="wc()" type="button" class="btn btn-success btn-number" data-type="plus" style="padding: 3px 3px;" data-field="pid-'.$row['pid'].'">
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
  <label class="col-md-5 control-label" for="prependedtext">Gross Amount</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">₹</span>
      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
    </div>
    
  </div>
</div>
                      
                                        <div class="form-group">
  <label class="col-md-5 control-label" for="prependedtext">GST 5%</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">₹</span>
      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled autocomplete="off">
    </div>
    
  </div>
</div>
                      
                      
                      
                      <div class="form-group">
  <label class="col-md-5 control-label" for="prependedtext">Net Amount</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">₹</span>
      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
    </div>
    
  </div>
</div>
      </div>
      <br>
                      
                  

                                     <div class="box-footer">
              
                <button onclick="createorder()" type="button" class="btn btn-primary">Create Order</button>
                <a href="" class="btn btn-warning">Back</a>
              </div>         

			</div>
		</div>
	</div>
                    
 
                

	<script>
                  
    function createorder() {
   var u=<?php echo '"'.$user.'"'?>;
    //alert(billq);
   text="ORDER\n\nUser : "+u+"\nPIDS : "+billpid+"\nQUANTITY : "+billq+"\nGROSS AMOUNT : "+gt+"\nGST : "+gst+"\nNet Amount : "+nt;
                  alert(text);
                  
                  var bpids = billpid.join();
                  var bq = billq.join();
    $.ajax({
      type: "POST",
                    url: 'createorder.php',
                    data: {user:u,
                           pids:bpids,
                           q:bq,
                           amt:nt,
                           status:1
                      }
        
    });

                  
                  
                  
   
  }
  
  
                  var billpid = [];
   var billq= []; 
                   var gst;
    var nt;
   var gt=0;
                  calc(0);
 
  function wc() {
  setTimeout(calc, 500);
  }
              function calc() {
                  
                  var pids = [<?php echo '"'.implode('","', $pid).'"' ?>];
  var rates = [<?php echo '"'.implode('","', $rate).'"' ?>];
  // alert(pids[1]);
 // alert(rates);
    var arr = [];
                 billpid = [];
    billq= [];
  var i;
   gt=0;
                gst=0;
                nt=0;
for (i = 0; i < pids.length; i++) { 

  var aa= document.getElementsByName("pid-"+pids[i])[0].value;
  arr.push(aa);
  
  if(aa>0)
  {
    billpid.push(pids[i]);
    billq.push(aa);
  }
 // alert(aa);
}
  for (i = 0; i < arr.length; i++) { 
     
     gt=gt+(rates[i] * arr[i]);
  }
                    
                    gst=gt*0.05;
                    nt=gst+gt;
  document.getElementById("gross_amount").value = gt;
  document.getElementById("vat_charge").value = gst;
    document.getElementById("net_amount").value = nt;
  
 // alert(arr);
                }
  
  
   
  
  
  
  
  
  
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