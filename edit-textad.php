
<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: info@codexpresslabs.info

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting

require_once ('config.php');
require_once ('functions.php');

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Upload New Ad - '.APPNAME;
	$site_dsc="Upload New Ad - ".APPNAME;
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');
 
$checkTr=$db->query("SELECT user_id_fk FROM tranfer_request WHERE user_id_fk='$user_id' ");

$countExist=mysqli_num_rows($checkTr);
//if ($countExist) {
?>
<h2 align="center">Modify Ad</h2>
         
<div class="main_box">
    <div class="light_box">
         
         <?php
          $adid = $_GET['adid'];
 
 
 @$queryBoard=$db->query("SELECT * FROM text_ads A, users U WHERE A.uid_fk='$ses_user_id' AND adsId='$adid' ");
  //fetch rows
$bdata=$queryBoard->fetch_assoc();
  $adsName=$bdata['adsName'];
  $baseUrl=$bdata['baseUrl'];
  $adsId=$bdata['adsId'];
  $imgUrl=$bdata['imgUrl'];
  $adsDate=$bdata['adStart'];
  $adsClicks=$bdata['adsClicks'];
  $username=$bdata['username'];
  $adsStatus=$bdata['adsStatus'];
  $uid_fk=$bdata['uid_fk'];
  $adStart=$bdata['adStart'];
  $sub_id=$bdata['sub_id'];
  $catId=$bdata['catId'];
  $adCost=$bdata['adCost'];
  $reason=$bdata['reason'];
  
         if (isset($_POST['submit'])) {
        $adsname=$_REQUEST['adsName'];
        $catId=$_REQUEST['catId'];
        $baseUrl=$_REQUEST['baseUrl'];
        $today=time();

        $result_explode = explode('|', $catId);
         $cat_id=$result_explode[0];
         $sub_cat_id=$result_explode[1];
         $adcost=$result_explode[2];
        
        $db->query("UPDATE text_ads SET adsName='$adsname', adCost='$adcost', catId='$cat_id', sub_id='$sub_cat_id', baseUrl='$baseUrl', adsStatus='review', adsDate='$today' 
            WHERE adsId='$adid' ");
            echo '<hr><h2 style="color:green; font-weight:bolder;">Successfully Modifed, Under review...!</h2> ';
               
            }
         ?>
</div>

<form enctype="multipart/form-data" action="" method="post">
 	<table>
		<tbody><tr>
				<td class="w"><b>Ad Display Name</b>: <input class="expansible_input" id="adsName" required='' name="adsName" type="text" value="<?php echo $adsName; ?>"><br>
				(Will display for users and used to identify if running more than one ads)</td>
			</tr>
			<tr>
				<td class="w"><b>Landing Page</b>:
	<select name="catId" required=""> 
    <option value=''>Select Category</option> 
    <?php
    $queryBoard=$db->query("SELECT * FROM category C, sub_cat S WHERE C.cid=S.cid_fk group by S.sname ORDER BY S.sid");
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
while($bdata=$queryBoard->fetch_assoc()){
$sname=$bdata['sname'];
$sid=$bdata['sid'];
$cid=$bdata['cid'];
$catcost=$bdata['catcost'];

if($sname=='Homepage')
{
 echo '<option value="index|0|'.$catcost.'">'.$sname.'</option>';   
}
else
{
    echo '<option value="'.$cid.'|'.$sid.'|'.$catcost.'">'.$sname.'</option>';
}


}
?>
    </select><br>
				(the website or webpage that your banner ad should lead to when anyone clicks on it)</td>
			</tr>
			
			<tr>
				<td class=""><b>Landing Page</b>: <input class="expansible_input" id="baseUrl" required='' name="baseUrl" type="url" value="http://www."><br>
				(the website or webpage that your banner ad should lead to when anyone clicks on it)</td>
			</tr>
			<tr>
			<td>
			<input type="submit" name="submit" value="Upload Ad" id="upload"></td>
			</tr>
		</tbody>
	</table> 
</form>


  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>


<?php


//load footer from footer.php
require_once ('footer.php');

?>


</body>
</html>
