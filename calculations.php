<?php require_once("includes/functions.php");  //This includes the functions that are defined in the functions.php file to be used in this file. ?> 
<?php
			// This file contains the logic that carries out the calculatations for the cost, sales tax, shipping & handling and the Total.
			// It calls the sales_tax($state, $retail, $cost); & shipping_charge($quantity, $shipping, $oversized); functions
			// from the functions.php file to carry out the calculations. 
			// Control of this file is passed on to from the process.php file 
				
			if(isset($_POST['submit'])){   // The "If" checks if the compute/submit button has been clicked.
			 
				global $state;			   // These global variables hold the values from the text fields of the form. 	
				global $oversized;         // They are made global so that their values are made accessible to the other, 
				global $retail;            // files that use the values given i.e transfer values to the process.php file and back. 
				global $customer_id;
				global $shipping;
				global $description;
				global $price_per_part;
				global $part_number;
				global $quantity;
				global $name;
				
				$name = $_POST['customer_name'];    // The $_POST variable holds the user's values which are stored in the respective variables
				$customer_id = $_POST['customer_id'];
				$state = $_POST['customer_state'];
				
				if(isset($_POST['customer_type'])){  // The "if" checks if the cutomer_type variable in the $_POST has been set or given 
					$retail = $_POST['customer_type'];
				}else{ $retail = ""; }

				$shipping = $_POST['shipping'];
				$description = $_POST['ordered_description'];
				
				if(isset($_POST['oversize_container'])){   // The "if" checks if the oversize_container variable in the $_POST has been set or given 
					$oversized = $_POST['oversize_container'];
				}else{ $oversized = ""; }
				
				$price_per_part = $_POST['ordered_part_price'];
				$part_number = $_POST['ordered_part_number'];
				$quantity = $_POST['ordered_quantity'];
		
 					
				global $cost;						// The $cost variable holds the value of the Cost calculated
				 $cost = $price_per_part * $quantity;     
		
				sales_tax($state, $retail, $cost);                 // function calls to the sales_tax and shipping_charge functions 
				shipping_charge($quantity, $shipping, $oversized); // in the functions.php file which is included at the top of the file.
				
				global $total;                                  // The $total variable holds the value of the Total calculated
				$total = $cost + $sales_tax + $shipping_charge; 
			
				}		
									
			
?>