<?php
  session_start();

  
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

include_once 'header.php';
?>

<html>

</head>
<!-- body starts here -->

<body>
    <br><br><br><br><br><br>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <!-- It alerts the message  whenever the user delete the item in the cart -->
                <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                    echo $_SESSION['showAlert'];
                   } else {
                        echo 'none';
               } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                    <!-- it close the alert message -->
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php if (isset($_SESSION['message'])) {
                   echo $_SESSION['message'];
                   } unset($_SESSION['showAlert']); ?></strong>
                </div>

                <!-- starts of div class table-title-->
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2> Products in your Cart</h2>
                        </div>
                       
                    </div>
                </div>
                <!-- Ends of div class table-title -->

                <!-- table starts here -->
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <!-- table head namings -->
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- This fetch the data from the database -->
                        <?php
                        require 'config.php';
                        $stmt = $conn->prepare('SELECT * FROM cart');
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $grand_total = 0;
                        while ($row = $result->fetch_assoc()):
                    ?>
                        <!-- end of php -->
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                            <td><img src="<?= $row['product_image'] ?>" width="50"></td>

                            <!-- displays the name of the product -->
                            <td><?= $row['product_name'] ?></td>
                            <td>
                                &#8369;</i>&nbsp;&nbsp;<?= number_format($row['price'],2); ?>
                            </td>
                            <!-- displays the price of the product -->
                            <input type="hidden" class="pprice" value="<?= $row['product-price'] ?>">
                            <td>
                                <!-- user can choose the quantity of the product -->
                                <input type="text" class="form-control" value="<?= $row['quantity'] ?>"
                                    style="width:75px;">

                            </td>
                            <!-- displays the total price of the product -->
                            <td>&#8369;</i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                            <td>
                                <!-- remove the product and if click display a msg -->
                                <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead"
                                    onclick="return confirm('Are you sure want to remove this item?');"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>

                        <!-- calculation of the amount to be paid  -->
                        <?php $grand_total += $row['total_price']; ?>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="3">

                                <!-- anchor to the index.php -->
                                <a href="index.php" class="btn btn-warning"><i
                                        class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                                    Shopping</a>
                            </td>
                            <td colspan="2"><b>Grand Total</b></td>

                            <!-- displays the total amount to be paid-->
                            <td><b>&#8369;</i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                            <td>
                                <!-- anchor to the checkout.php -->
                                <a href="checkout.php"
                                    class="btn btn-warning <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i
                                        class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- end of table  -->

            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- for the deletion of data -->
                <!-- start of form -->
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Products in Cart</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <!-- second confirmation of data removal -->
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <!-- for the delete button -->
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
                <!-- end of form  -->

            </div>
        </div>
    </div>
    <!-- end of Delete Modal HTML -->
    <br><br><br><br><br><br><br>

    <!-- Footer -->

    <!-- includes  the footer.php -->
    <?php include_once 'footer.php' ?>

    <!-- end Footer -->
</body>
<!-- end of body -->
<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
}

.table-responsive {
    margin: 30px 0;
}

.table-wrapper {
    background: #fff;
    padding: 20px 25px;
    border-radius: 3px;
    min-width: 1000px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}

.table-title {
    padding-bottom: 15px;
    background: #FED303;
    color: #fff;
    padding: 16px 30px;
    min-width: 100%;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}

.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}

.table-title .btn-group {
    float: right;
}

.table-title .btn {
    color: #fff;
    float: right;
    font-size: 13px;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    margin-left: 10px;
}

.table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
}

.table-title .btn span {
    float: left;
    margin-top: 2px;
}

table.table tr th,
table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}

table.table tr th:first-child {
    width: 60px;
}

table.table tr th:last-child {
    width: 100px;
}

table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}

table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}

table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}

table.table td:last-child i {
    opacity: 0.9;
    font-size: 22px;
    margin: 0 5px;
}

table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
    outline: none !important;
}

table.table td a:hover {
    color: #2196F3;
}

table.table td a.edit {
    color: #FFC107;
}

table.table td a.delete {
    color: #F44336;
}

table.table td i {
    font-size: 19px;
}

table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
}

.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}

/* Custom checkbox */

.custom-checkbox {
    position: relative;
}

.custom-checkbox input[type="checkbox"] {
    opacity: 0;
    position: absolute;
    margin: 5px 0 0 3px;
    z-index: 9;
}

.custom-checkbox label:before {
    width: 18px;
    height: 18px;
}

.custom-checkbox label:before {
    content: '';
    margin-right: 10px;
    display: inline-block;
    vertical-align: text-top;
    background: white;
    border: 1px solid #bbb;
    border-radius: 2px;
    box-sizing: border-box;
    z-index: 2;
}

.custom-checkbox input[type="checkbox"]:checked+label:after {
    content: '';
    position: absolute;
    left: 6px;
    top: 3px;
    width: 6px;
    height: 11px;
    border: solid #000;
    border-width: 0 3px 3px 0;
    transform: inherit;
    z-index: 3;
    transform: rotateZ(45deg);
}

.custom-checkbox input[type="checkbox"]:checked+label:before {
    border-color: #03A9F4;
    background: #03A9F4;
}

.custom-checkbox input[type="checkbox"]:checked+label:after {
    border-color: #fff;
}

.custom-checkbox input[type="checkbox"]:disabled+label:before {
    color: #b8b8b8;
    cursor: auto;
    box-shadow: none;
    background: #ddd;
}

/* Modal styles */

.modal .modal-dialog {
    max-width: 400px;
}

.modal .modal-header,
.modal .modal-body,
.modal .modal-footer {
    padding: 20px 30px;
}

.modal .modal-content {
    border-radius: 3px;
    font-size: 14px;
}

.modal .modal-footer {
    background: #ecf0f1;
    border-radius: 0 0 3px 3px;
}

.modal .modal-title {
    display: inline-block;
}

.modal .form-control {
    border-radius: 2px;
    box-shadow: none;
    border-color: #dddddd;
}

.modal textarea.form-control {
    resize: vertical;
}

.modal .btn {
    border-radius: 2px;
    min-width: 100px;
}

.modal form label {
    font-weight: normal;
}
</style>


<!-- scripts sources -->

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function() {
        if (this.checked) {
            checkbox.each(function() {
                this.checked = true;
            });
        } else {
            checkbox.each(function() {
                this.checked = false;
            });
        }
    }); //End of if-else

    checkbox.click(function() {

        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        } //end of if
    });
}); //end of document ready

$(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
        var $el = $(this).closest('tr');

        var pid = $el.find(".pid").val();
        var pprice = $el.find(".pprice").val();
        var qty = $el.find(".itemQty").val();
        location.reload(true);
        $.ajax({
            url: 'action.php',
            method: 'post',
            cache: false,
            data: {
                qty: qty,
                pid: pid,
                pprice: pprice
            },
            success: function(response) {
                console.log(response);
            }
        });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
        $.ajax({
            url: 'action.php',
            method: 'get',
            data: {
                cartItem: "cart_item"
            },
            success: function(response) {
                $("#cart-item").html(response);
            }
        });
    }
});
</script>
<!-- end of scripts -->
</body>
<!-- end of body -->

</html>