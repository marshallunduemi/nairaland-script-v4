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
//echo Checkuser();

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
	$page_title='Disclaimer & Copyright ';
	$site_dsc="Disclaimer & Copyright ";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag
require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');


echo '<a id="top" name="top"></a>'; // anchor

##################### verify if post does in databse ########################

$comQuery=$db->query("SELECT * FROM forum_rule WHERE fid='1' ");
$rowR=mysqli_fetch_array($comQuery);
$content_text=$rowR['content_text'];
require 'incfiles/bbparser.php'; // phpbb code parser
?>
<div class="section-title">
    <h1>FORUM RULES AND GUIDELINES</h1>
    <div class="divider"></div>
  </div>
 <!-- the actual blog post: title/author/date/content -->

 <div class = "panel-body">


                    <div class="user-block slide">

                      <h1 style="font-size: 17px; color: darkgreen; font-weight: bold; cursor: pointer;">Please Observe The Following Rules:</h1>
                    </div>
          <!-- post 1 -->
          <div class="box-body" style="display: block; text-align: left;">
<table>
	<tr>
		<td  align="left"> <?php  $bb = new bbParser(); echo $bb->getHtml($content_text); ?>
	</td>
</tr>
</table>
       
    </div>
 <?php


echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->


</body>
</html>
