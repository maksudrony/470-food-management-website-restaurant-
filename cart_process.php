<?php
session_start(); //start session
include_once 'dbConnect.php';
include_once("config.inc.php"); //include config file
setlocale(LC_MONETARY,"en_US");
//$_SESSION["$tname"]=$tname;
//$table=$_SESSION["$tname"];// US national format (see : http://php.net/money_format)
############# add products to session #########################
if(isset($_POST["menu"]))
{
	foreach($_POST as $key => $value){
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array
	}

	//we need to get product name and price from database.
	$statement = $mysqli_conn->prepare("SELECT menu, price FROM $table WHERE menu=? LIMIT 1");
	$statement->bind_param('s', $new_product['menu']);
	$statement->execute();
	$statement->bind_result($menu, $price);


	while($statement->fetch()){
		$new_product["menu"] = $menu; //fetch product name from database
		$new_product["price"] = $price;  //fetch product price from database

		if(isset($_SESSION["products"])){  //if session var already exist
			if(isset($_SESSION["products"][$new_product['menu']])) //check item exist in products array
			{
				unset($_SESSION["products"][$new_product['menu']]); //unset old item
			}
		}

		$_SESSION["products"][$new_product['menu']] = $new_product;	//update products with new item array
	}

 	$total_items = count($_SESSION["products"]); //count total items
	die(json_encode(array('items'=>$total_items))); //output json

}

################## list products in cart ###################
if(isset($_POST["load_cart"]) && $_POST["load_cart"]==1)
{

	if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){ //if we have session variable
		$cart_box = '<ul class="cart-products-loaded">';
		$total = 0;
		foreach($_SESSION["products"] as $product){ //loop though items and prepare html content

			//set variables to use them in HTML content below
			$menu = $product["menu"];
			$price = $product["price"];

			$product_qty = $product["product_qty"];

			$product_size = $product["product_size"];

			$cart_box .=  "<li> $menu (Qty : $product_qty | $product_size ) &mdash; $currency ".sprintf("%01.2f", ($price * $product_qty)).
                                " <a href=\"#\" class=\"remove-item\" data-code=\"$menu\">&times;</a></li>";
			$subtotal = ($price * $product_qty);
			$total = ($total + $subtotal);
		}
		$cart_box .= "</ul>";
		$cart_box .= '<div class="cart-products-total">Total : '.$currency.sprintf("%01.2f",$total).' <u><a href="view_cart.php" title="Review Cart and Check-Out">Check-out</a></u></div>';
		die($cart_box); //exit and output content
	}else{
		die("Your Cart is empty"); //we have empty cart
	}
}

################# remove item from shopping cart ################
if(isset($_GET["remove_code"]) && isset($_SESSION["products"]))
{
	$menu   = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove

	if(isset($_SESSION["products"][$menu]))
	{
		unset($_SESSION["products"][$menu]);
	}

 	$total_items = count($_SESSION["products"]);
	die(json_encode(array('items'=>$total_items)));
}
