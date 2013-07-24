<?php 
// This file is the place to store all basic functions

	function mysql_prep($value){   // This function is used to make sure data stored in the DB is valid 
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysql_real_escape_string"); // i.e PHP V4.3.0
		if($new_enough_php){
			// undo anymagic quotes effects so mysql_real_escape_string cand do the work
			if($magic_quotes_active){$value = stripcslashes($value);}
			
		}else{
				// if magic qoutes are not active,than add slashes manually 
				if(!$magic_quotes_active){$value = addslashes($value);}
				//if magic qoutes are active, then slashes already exist
			}
		
		return $value;
		
	}
	
	function redirect_to($location = NULL){      // This function is used when a redirect to a another location is required
		if($location != NULL){
		header("Location: {$location}");
		exit;
		}
	}
	
	function confirm_query($result_set){    // This function is used to confirm queries that are sent to the Database
		if(!$result_set){
		 die("Database query failed: " . mysql_error());
		 }
		
		}
		
 
	function get_customer_by_id($customer_id){   // This is used to select the Customers by Their id's
			 $query = "SELECT * 
					   FROM customers WHERE customer_id={$customer_id} 
					   ORDER BY id ASC"; 	
								
			 $customer_set= mysql_query($query);
			 confirm_query($customer_set);
			 return $customer_set;
		}
	function get_orders($customer_id){            // This is used to get orders based on a customer id
		
		$query = "SELECT * ";
		$query .= "FROM orders ";
		$query .= "WHERE customer_id=" . $customer_id. " ";
		$query .= "LIMIT 1";
		
		$order_set = mysql_query($query);
		
		// REMEMBER:::::
		// If no rows are returned, fetch array will return NULL	
		if($order = mysql_fetch_array($order_set)){
			return $order;
		}else{
			return NULL;
			
		}	
	}
	
	function sales_tax($state, $retail, $cost){    // This function calculates the sales tax and it takes cost,retail and state as arguments
		global $sales_tax;
		if(($state == "kla") && ($retail == "retail")){
				$sales_tax = 0.1 * $cost; 
				return $sales_tax;
		}elseif(($state == ("ebs" || "mbr")) && ($retail == "retail")){
				$sales_tax = 0.05 * $cost;
				return $sales_tax;	
		}else{
				$sales_tax = 0;
				return $sales_tax;
		}
						
	}
	
	function shipping_charge($quantity, $shipping, $oversized){ // Calculates the shipping Charge
					global $shipping_charge;
					if($shipping == "UPS"){
						if($oversized == "checked"){
							 $shipping_charge = $quantity * 7.00 + 5.00; 
							 }else{
							 	$shipping_charge = $quantity * 7.00;
							 }
						return $shipping_charge;
						
					}elseif($shipping == "FedGround"){
						if($oversized == "checked"){
							 $shipping_charge = $quantity * 8.50 + 5.00;
							  }else{
							  	$shipping_charge = $quantity * 8.50;
							  }
						return $shipping_charge;
						
					}elseif($shipping == "UsAir"){
						if($oversized == "checked"){
							 $shipping_charge = $quantity * 9.25 + 5.00;
							  }else{
							  	$shipping_charge = $quantity * 9.25;
							  }
						return $shipping_charge;
						
					}elseif($shipping == "FedAir"){
						
						if($oversized == "checked"){
							 $shipping_charge = $quantity * 12.00 + 5.00;
							 }else{
							 	$shipping_charge = $quantity * 12.00;
							 }
						return $shipping_charge;
					}
			
	}


	function check_required_fields($required_array){   // This is used in form validation 
		$errors = array();
		foreach($required_array as $fieldname) {
			if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
				$errors[] = $fieldname;
			}	
		}
		return $errors;
	}
	
	function check_max_field_lengths($field_length_array){   // This is used in form validation 
		$errors = array();
		foreach ($field_length_array as $field_name => $maxlength) {
			if(strlen(trim(mysql_prep($_POST[$field_name]))) > $maxlength){
				$errors[] = $field_name;
			}
		}
		return $errors;
	}
	
	function display_errors($error_array){      // This is used to display errors found in the form
		echo "Please review the following fields:<br />";
		foreach ($error_array as $error) {
			echo " - " . $error . "<br />";
		}
	}
				

   

?>