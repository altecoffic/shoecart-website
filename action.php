<?php
	session_start();
	require 'config.php';

	// Add products into the cart table 
	//this get the data
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = (int)$_POST['pqty'];

	  //this calculates the price of the quantity
	  $total_price = $pprice * $pqty;

	//Prepare the Select statement 
	  $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
	  $stmt->bind_param('s',$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['product_code'] ?? '';
    
      //check if products does not exist in the database table
	  if (!$code) {

		//Prepare the Insert into statement
	    $query = $conn->prepare('INSERT INTO cart (product_name,price,product_image,quantity,total_price,product_code) VALUES (?,?,?,?,?,?)');
	    $query->bind_param('ssssss',$pname,$pprice,$pimage,$pqty,$total_price,$pcode);
	    $query->execute();

        //Otherwise, it will display this message
	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } else {

        //otherwise it will alert this message
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}//End of if-else

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {

	//Prepare the Select statement
	  $stmt = $conn->prepare('SELECT * FROM cart');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}//end of if statement

	// Remove single items from cart
	if (isset($_GET['remove'])) {

	  $id = $_GET['remove'];

	//Prepare the Delete statement
	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();
	
	  //Alert message when the item is remove from the cart
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';

	  //If the item is already remove from the cart, the location will be back to the cart
	  header('location:cart.php');
	}//end of if statement
	
	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  //It will multiply the quantity of the products that the user has selected to the price of that product
	  $tprice = $qty * $pprice;

	//Prepare the Update statement
	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}//end of if statement
	

	
	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {

	//initializing variables
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $address = $_POST['address'];
	  $pmode = $_POST['pmode'];

	  $data = '';

	  //Prepare the Insert into statement
	  $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
	  $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total);
	  $stmt->execute();
	  //Prepare the Delete statement
	  $stmt2 = $conn->prepare('DELETE FROM cart');
	  $stmt2->execute();
	  $data .= '<br><div class="text" style="background-color:white; border-radius:20px;">
								<h2 class=" text-center display-4 mt-2 text-success">Thank You!</h1>
								<h3 class="text-center  text-danger"style=" color:black">Your Order Placed Successfully!</h2>
								<h5 class="display-6 mt-2 text-info"  style="margin-left:100px;">✍Purchased Product : ' . $products . '</h5>
								<h5  class="text-info"style="margin-left:100px;">✍Name : ' . $name . '</h5>
								<h5  class="text-info" style="margin-left:100px;">✍E-mail : ' . $email . '</h5>
								<h5  class="text-info" style="margin-left:100px;" >✍Phone #: ' . $phone . '</h5>
								<h5  class="text-info" style="margin-left:100px;" >✍Address: ' . $address . '</h5>
								<h5 class="text-info" style="margin-left:100px;">✍Total Amount to be Paid : ' . number_format($grand_total,2) . '</h5>
								<h5  class="text-info"style="margin-left:100px;">✍Payment Mode : ' . $pmode . '</h4><br>
						  </div>';
	  echo $data;
	}//end of if statement
	
?>