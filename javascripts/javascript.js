
function checkIntInput(){   // This function checks whether a number has been placed into the text field
	var priceInput;
	var quantityInput;
	var priceValue = document.getElementById("part-price").value;
	var quantityVaue = document.getElementById("part-qty").value;
	
	priceInput = parseFloat(priceValue);
	quantityInput = parseFloat(quantityVaue);
	
	if((priceInput || quantityInput) < 0){
		alert("Please Enter a number Greater Than Zero!!");
		
	}else if(!(priceInput || quantityInput)){
		alert("\tSorry!!!\n\nThis Field Takes Numbers!!");
	}else{}
	
}

function clearData(form){                                      // This function is called when the New Order Button is Clicked
	if(confirm('Are You Sure You Want To Clear The Data?')){
		if(form.reset){
			location.href="index.php"
		
		} 
	
	}
}

function maskedTextBox(obj){                                 // This function is used to mask the customer ID text Box
	 string='_ _ _ # _ _ # _ _ _ ##'
	 val=obj.value.replace(/_/g,'');
	 val=val.replace(/#/g,'');
	 val=val.replace(/\s/g,'');
	 val1=''
	 for (zxc0=0;zxc0<val.length;zxc0++){
	  val1+=val.charAt(zxc0)+' ';
	 
	 if (val1.length<7){
	  obj.value=val1+string.substring(val1.length,string.length);
	 }
	 else {
	  val2=val1.substring(0,7)+'# '+val1.substring(7,18);
	  obj.value=val2+string.substring(val2.length,string.length);
	 }
	 
	 }
}