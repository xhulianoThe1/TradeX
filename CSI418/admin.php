<!--CSI 410 - Intro to Databases Final Project
    Luke LeBel, Michael Nicholas, Natalie Bates
    
    This script creates the administrative landing page. It contains links to all of the 
    Administrative functions, listed below-->
if(!isset($_POST['submit']){
	header('Location: index.php');
	exit();
}else{
<?php include "templates/header.php"; ?>

<ul>
  <li>
  
      <a href="doesntexistyet"><strong>You're on the admin page! This link doesn't go anywhere!</strong></a>
  </li>

</ul>

<?php include "templates/footer.php"; ?>
}