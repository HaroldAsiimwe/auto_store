<?php require_once("includes/connection.php"); //This includes the connection deatils of the database and the tables where data is stored      ?>
<?php require_once("includes/functions.php"); // This includes the functions file that contain functions used to send data to the DB.          ?>

<?php
		//form validation is carried out in this file
		if(isset($_POST['submit'])){
	
				$errors = array();                // This array stores the errors found in the form
				
				$required_fields = array('customer_id', 'customer_name', 'customer_state' );// This array store and is used for Checks for the Required Fields
				foreach($required_fields as $fieldname) {
					if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
					$errors[] = $fieldname;
					}	
				}
				
				$fields_with_length = array('customer_id' => 9 );                       // This checks for the max. length of the customer ID
				foreach ($fields_with_length as $fieldname => $maxlength) {
					if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
						$errors[] = $fieldname;
					}
				}
																		               // This Checks For the fields that have to contain Numbers
				$fields_with_numbers = array('ordered_part_price', 'ordered_quantity', 'ordered_part_number', 'customer_id');
				foreach($fields_with_numbers as $fieldname) {
					if(!doubleval($_POST[$fieldname])){
						$errors[] = $fieldname;
					}
				}
				
				if(empty($errors)){               // If no errors are found, control is transfered to the calculations.php file to  
												  // carry out the calculations for the cost, shipping charge, sales tax and the total of the orders							
						include 'calculations.php';    // If calculations are successful, the info. is sent to the DataBase in the statements below
						
						$name1 = mysql_prep($name);    // mysql_prep is a function in the functions file that is used to make sure the values 
													  //  are valid mysql input values.	
						$state1 = mysql_prep($state);
						$description1 =  mysql_prep($description);
						$part_number1 =  mysql_prep($part_number);
																	// Queries are made to insert data into the DataBase
						$query1 = "INSERT INTO customers    
								(customer_id, name, state, customer_type) 
								VALUES ({$customer_id}, '{$name1}', '{$state1}', '{$retail}')";
						$result = mysql_query($query1);
						
						$query = "INSERT INTO orders
								(customer_id, part_number, description, quantity, transport_type, oversized_cont, cost, sales_tax, transport_charges, total) 
								VALUES ({$customer_id}, {$part_number1}, '{$description1}', {$quantity}, '{$shipping}', '{$oversized}', {$cost}, {$sales_tax}, {$shipping_charge}, {$total})";
						$result = mysql_query($query);
						if (mysql_affected_rows()== 1) {       // If the Customer doesnot exist, data is entered into the Database 
								// Success
								$message = "The Info. was successfully updated.";
							}elseif(mysql_affected_rows()== 0){   // if the customer Exists, Data is entered into the orders table of the Database 
								//Failed
								$query = "INSERT INTO orders
								(part_number, description, quantity, transport_type, oversized_cont, cost, sales_tax, transport_charges, total) 
								VALUES ({$part_number}, '{$description}', {$quantity}, '{$shipping}', '{$oversized}', {$cost}, {$sales_tax}, {$shipping_charge}, {$total})
								 WHERE customer_id={$customer_id} LIMIT 1";
								$result = mysql_query($query);
								
							}else{
										
								$message = "The Info. update failed.";   // If all attempts to insert Data Fail
								$message .= "<br />" . mysql_error();	
								
							}
						
				}else{
					// errors occured
					if(count($errors) > 1){
						$message = "There were " . count($errors). " errors in the form";
					}else{
						$message = "There was " . count($errors). " error in the form";
					}
				
				}
			
		} // end 	if(isset($_POST['submit']))


?>

<?php
      			if(!empty($message)){                     // Display The contents of the Message Variable in color RED
      				
      				echo "<center><b style=\"color: RED;\">" . $message. "</b></center>" ; 
				}
?>
&nbsp; &nbsp; &nbsp;
<br />
<?php
				if(!empty($errors)){                    // Display The Errors and the fields that need to be Checked          
					echo "<center>Please review the following fields: </center><br />";
					foreach($errors as $error){
						echo "<center> - " . $error ."</center><br />";
					}
				}	
		
?>



