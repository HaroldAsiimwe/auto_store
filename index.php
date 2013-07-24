<?php require_once("includes/connection.php"); //This includes the connection deatils of the database and the tables where data is stored ?>
<?php require_once("includes/functions.php"); //This includes the functions that are defined in the functions.php file to be used in this file. ?>
<?php include("calculations.php"); // This includes the calculations and results that are carried out by the calculations.php file ?>

<?php include("includes/header.php"); // This includes the header part of the Html used to display the page contents ?>
<?php require("process.php");  //this requires the process.php contents to be called when the submit/Compute button is clicked ?>

<?php //This is the file that is loaded when the page is called by the host/browser.
	 //	It is the file that is run and all other processing is done through this file.
	 // It has been modularized into different sections or files such that all individual processing is
	 // is carried out individually without intervention of any other section/process.
	 // It has been sectioned into the header, body and footer where each section has its own file thus
	 // header.php, footer.php and the body which contains the form_page.php, process.php and calculations.php.
	 // The body starts with the form tag and then the form contents are within the 'form_page.php' file.
	 // The submit/compute and new order buttons are at the bottom. When the submit button is clicked, the action
	 // of the page is to redirect to it's self hence action="index.php". But once the submit has been hit, control is 
	 // transfered to the "process.php" file which then validates the data, transfers control to the "calculations.php" file
	 // for calculations and then the results are brought back to the "process.php" file which then sends data to the DataBase.
	 // Then again all that is done on the same page "index.php" hence the reason why it is the page that is run in the browser.  
   ?>

<form method="post" action="index.php"  name="auto_store">
	
	<?php include("form_page.php"); ?>
	
	<br />
    <input type="submit" name="submit" value="Compute" id="button" /> &nbsp; &nbsp;
    
    <input type="reset" value="New Order" id="button" name="reset"
    onclick="clearData(this.form)" 
      />

</form>
<br />

<br />

<?php require("includes/footer.php"); ?>