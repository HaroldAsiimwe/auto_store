<?php    
						// These global variables are declared so as to be used to display back what the user has input
						//  in the respective text/radio button fields
		global $cost;
		global $shipping_charge;
		global $total;
		global $sales_tax;
		
		global $state;
		global $oversized;
		global $retail;
		
		global $customer_id;
		global $shipping;
		global $description;
		global $price_per_part;
		global $part_number;
		global $quantity;
		global $name;
	
	// The following table tag is what is used to display the form contents to the browser / USER 
?>

		
<table>
<tr>
	<td id="column1">
		<fieldset>
			<legend>Customer Information</legend>
			<ol>
				<li>
					<label for="form-customer">Customer ID:</label>
					<input type="text" name="customer_id" id="form-customer" class="textinput"  required="true"
					autofocus="true" style="width: 120px;" maxlength="9" autocomplete="off" value="<?php echo $customer_id; ?>"/>
				</li>
				<li>
					<label for="form-name">Name: </label>
					<input type="text" name="customer_name" id="form-name" 
					class="textinput" required="true" value="<?php echo $name; ?>"/>
				</li>
				<li id="inline">
					<label for="form-state">State:</label>
					<input type="text" name="customer_state" id="form-state" 
					class="textinput"  maxlength="3" style="width: 50px;" id="row-inline"  value="<?php echo $state; ?>"/>
				</li>
				<li id="inline">
					<label for="form-retail" id="row-inline">
						<input type="checkbox" name="customer_type"  id="form-retail" 
						value="retail" checked="<?php if(!empty($retail)){echo "checked=\"checked\""; }?>" class="checkbox" /> 
						Retail Customer</label>
				</li>
			</ol>
		</fieldset>
		
	</td>
	<td id="column2">
		<fieldset>
			<legend> Shipping</legend>
			<ol>
				<li id="inline1">
					<label >
						<input type="radio" name="shipping" value="UPS"<?php if($shipping == "UPS"){echo "checked"; }?> checked="checked" />
					UPS</label>
				</li>
				<li id="inline1">
					<label id="inline-label">
						<input type="radio" name="shipping" value="FedGround"<?php if($shipping == "FedGround"){echo "checked"; }?> />
					Fed Ex Ground</label>
				</li>
			</ol>
			<ol>
				<li id="inline2">
					<label>
						<input type="radio" name="shipping" value="UsAir"<?php if($shipping == "UsAir"){echo "checked"; }?>  />
					US Postal Air</label>
				</li>
				<li id="inline2">
					<label id="inline-label2">
						<input type="radio" name="shipping" value="FedAir"<?php if($shipping == "FedAir"){echo "checked"; }?>  />
					Fed Ex Air</label>
					
				</li>
			</ol>
		</fieldset>
	</td>
</tr>
<tr>
	<td id="column1">
		<fieldset>
			<legend>Part Ordered</legend>
			<ol>
				<li>
					<label for="part-number">Part Number:</label>
					<input type="text" name="ordered_part_number" id="part-number" class="textinput" required="true" value="<?php echo $part_number; ?>"/>
				</li>
				<li>
					<label for="description"> Description:</label>
					<input type="text" name="ordered_description" id="description" class="textinput" required="true" value="<?php echo $description; ?>" />
				</li>
				<li>
					<label for="part-price"> Price Per Part:</label>
					<input type="text" name="ordered_part_price" id="part-price" class="textinput" 
					 onblur="checkIntInput()"  value="<?php echo $price_per_part; ?>"  style="width: 80px;"/>
				</li>
				<li id="inline-part">
					<label for="quantity"> Quantity:</label>
					<input type="text" name="ordered_quantity"  id="part-qty"  class="textinput" onblur="checkIntInput()"
					style=" width: 50px; margin-left: 42px;"  value="<?php echo $quantity; ?>" />
				</li>
				<li id="inline-part2">
					<label for="oversize-conatiner" id="oversize">
						<input type="checkbox" name="oversize_container" value="checked"<?php if($oversized == "checked"){echo "checked"; }?> class="checkbox" /> 
						Oversize Container? </label>
				</li>
			</ol>
		</fieldset>
	</td>
	<td id="column2">
		<fieldset>
			<legend>Output</legend>
			<ol>
				<li>
					<label for="output-cost"> Cost:</label>
					<input type="text" name="output-cost" id="cost" class="textinput" value="<?php echo '$'.$cost; ?>" readonly="true"/>
				</li>
				<li>
					<label for="sales-tax"> sales tax:</label>
					<input type="text" name="sales-tax" id="tax" class="textinput" value="<?php echo '$'.$sales_tax; ?>"  readonly="true"/>
				</li>
				<li>
					<label for="shipping-handling"> Shipping &amp; Handling:</label>
					<input type="text" name="shipping-handling" id="shipHandling" class="textinput"  value="<?php echo '$'.$shipping_charge; ?>" readonly="true"/>
				</li>
				<li>
					<label for="output-total"> Total:</label>
					<input type="text" name="output-total" id="total" class="textinput" value="<?php echo'$'.$total; ?>"  readonly="true" />
					</li>
				</ol>
			</fieldset>
		</td>
	</tr>
	
	
</table>	

