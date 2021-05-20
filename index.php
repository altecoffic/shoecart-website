<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// include the header
include_once 'header.php';
?>


<!-- Masthead-->
<header class="masthead" style="background-image: url('./assets/img/head.jpg')">
    <div class="container">
        <div class="masthead-subheading">Welcome To Clee's Choice!</div>
        <div class="masthead-heading text-uppercase">Your One stop Shop Choice</div>
        <a class="btn btn-primary btn-lg text-uppercase js-scroll-trigger" href="#services">Services</a>&nbsp;
        <a class="btn btn-primary btn-lg text-uppercase js-scroll-trigger" href="#index.php">Products</a>
    </div>

</header>

<!-- Services-->

<section class="page-section" id="services">

    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Services</h2>
            <h3 class="section-subheading text-muted">The best service you'll ever experience.</h3>
        </div>

        <div class="row text-center">
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">E-Commerce</h4>
                <p class="text-muted">Clee's choice is one of the top high class shoe mart in the whole world.</p>
            </div>
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Online Shop</h4>
                <p class="text-muted"> We cater not only online services but also physical services.</p>
            </div>
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Web Security</h4>
                <p class="text-muted">Rest assured that upon purchasing us. Secure service is guaranteed to be offer.
                </p>
            </div>
        </div>
    </div>
</section>
<!--   end of services -->


<!-- Displaying Products Start -->
<div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
        <?php
  			include 'config.php';
              //Prepare the Select statement
  			$stmt = $conn->prepare('SELECT * FROM product');
  			$stmt->execute();
  			$result = $stmt->get_result();
              //it fetch the product from database
  			while ($row = $result->fetch_assoc()):
  		?>

        <div class="col-sm-6 col-md-4 col-lg-3 mb-4" id="index.php">
            <div class="card-deck   mb-5 rounded" style="height:400px; ">
                <div class="card p-2 mb-2 shadow p-3">

                    <!-- displays the image of the product -->
                    <img src="<?= $row['product_image'] ?>" class="card-img-top" height="250">
                    <div class="card-body p-1">

                        <!-- This displays the product name -->
                        <h6 class="card-title text-center text-info"><?= $row['product_name'] ?></h6>

                        <!-- it displays the product price -->
                        <h6 class="card-text text-center text-danger">
                            &#8369;</i>&nbsp;&nbsp;<?= number_format($row['product-price'],2) ?></h6>
                    </div>
                    <div class="card-footer p-1">
                        <!-- form starts -->
                        <form action="" class="form-submit">
                            <div class="row p-2">
                                <div class="col-md-6 py-1 pl-4">
                                    <b>Quantity : </b>
                                </div>
                                <div class="col-md-6">
                                    <!-- The user can choose how many products to buy -->
                                    <input type="number" class="form-control pqty" value="<?= $row['quantity'] ?>">
                                </div>
                            </div>

                            <!-- get the data that the ajax  -->
                            <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                            <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                            <input type="hidden" class="pprice" value="<?= $row['product-price'] ?>">
                            <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                            <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                            <button class="btn btn-block addItemBtn" style="background-color:#FFB61E;"><i
                                    class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                                cart</button>
                        </form>
                        <!-- end form  -->
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Displaying Products End -->
<!-- About-->
<!-- section timeline starts -->
<section class="page-section" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">About Us</h2>
            <h3 class="section-subheading text-muted">Discover more about Clees Choice!</h3>
        </div>
        <!-- this is for the timeline -->
        <ul class="timeline">
            <li>
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/11.jpg"
                        alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>April 26,2021</h4>
                        <h4 class="subheading">Clees Humble Beginnings</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">We started from a scratch and now we are one of the most well-known high
                            quality company. </p>
                    </div>
                </div>
            </li>
              <!-- this is for the timeline -->
            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/3.jpg"
                        alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>May 2, 2021</h4>
                        <h4 class="subheading">Clees Choice Website have started</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">It was never easy to create such amazing website like this.</p>
                    </div>
                </div>
            </li>
            <li>
                  <!-- this is for the timeline -->
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/3.jpg"
                        alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>May 6, 2021</h4>
                        <h4 class="subheading">Why we came up with this kind of website</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted">This website is created because of the undying support of our ever dynamic
                            teacher in GS, Sir Jay Ar Ermino.</p>
                    </div>
                </div>
            </li>
  <!-- this is for the timeline -->
            <li class="timeline-inverted">
                <div class="timeline-image">
                    <h4>
                        Be Part
                        <br /> Of Our
                        <br /> Choice!
                    </h4>
                </div>
            </li>
        </ul>
    </div>
    
</section>
<!-- end of section -->


<!-- Team-->
<section class="page-section bg-light" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
            <h3 class="section-subheading text-muted">This Website would be impossible without the helping hands of the
                team.</h3>
        </div>
        <!-- for the lead web info -->
        <div class="row">
            <div class="col-lg-4">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="assets/img/team/joy.png" alt="..." />
                    <h4>Christine Joy Ditchon</h4>
                    <p class="text-muted">Lead Web Developer</p>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <!-- lead front-end dev -->
            <div class="col-lg-4">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="assets/img/team/lesh.jpg" alt="..." />
                    <h4>Leslie Marie A. Reyes</h4>
                    <p class="text-muted">Lead Front-end Developer</p>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- lead back-end info -->
            <div class="col-lg-4">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="assets/img/team/mery.jpg" alt="..." />
                    <h4>Mery-An Telez</h4>
                    <p class="text-muted">Lead Back-end Developer</p>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <!-- quote for everyone -->
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <p class="large text-muted">Together Everyone Achieves More.</p>
            </div>
        </div>
    </div>
</section>
<!-- end of team section -->

<!-- Clients/partners icon-->
<div class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 col-sm-6 my-3">
                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg"
                        alt="..." /></a>
            </div>
            <div class="col-md-3 col-sm-6 my-3">
                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg"
                        alt="..." /></a>
            </div>
            <div class="col-md-3 col-sm-6 my-3">
                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg"
                        alt="..." /></a>
            </div>
            <div class="col-md-3 col-sm-6 my-3">
                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg"
                        alt="..." /></a>
            </div>
        </div>
    </div>
</div>
<!-- end Clients-->


<!-- footer starts -->
<footer class="footer">
    <div class="parallax_background parallax-window" data-parallax="scroll"
        style="background-image:url(./assets/imgs/about/footer.jpg" data-speed="0.8"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter">
                    <div class="newsletter_title_container text-center">
                        <div class="newsletter_title">Subscribe to our newsletter to get the latest trends & news</div>
                        <div class="newsletter_subtitle">Join our database NOW!</div>
                    </div>
                    <div class="newsletter_form_container">
                        <form action="#"
                            class="newsletter_form d-flex flex-md-row flex-column align-items-start justify-content-between"
                            id="newsletter_form">
                            <div class="d-flex flex-md-row flex-column align-items-start justify-content-between">
                                <div><input type="text" class="newsletter_input newsletter_input_name"
                                        id="newsletter_input_name" placeholder="Name" required="required">
                                    <div class="input_border"></div>
                                </div>
                                <div><input type="email" class="newsletter_input newsletter_input_email"
                                        id="newsletter_input_email" placeholder="Your e-mail" required="required">
                                    <div class="input_border"></div>
                                </div>
                            </div>
                            <div><button class="newsletter_button">subscribe</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row footer_contact_row">
            <div class="col-xl-10 offset-xl-1">
                <div class="row">

                    <!-- Footer Contact Item -->
                    <div class="col-xl-4 footer_contact_col">
                        <div
                            class="footer_contact_item d-flex flex-column align-items-center justify-content-start text-center">
                            <div class="footer_contact_icon"><img src="./assets/img/logos/sign.svg" alt=""></div>
                            <div class="footer_contact_title">give us a call</div>
                            <div class="footer_contact_list">
                                <ul>
                                    <li>Office Landline: +44 5567 32 664 567</li>
                                    <li>Mobile: +44 5567 89 3322 332</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Contact Item -->
                    <div class="col-xl-4 footer_contact_col">
                        <div
                            class="footer_contact_item d-flex flex-column align-items-center justify-content-start text-center">
                            <div class="footer_contact_icon"><img src="./assets/img/logos/trekking.svg" alt=""></div>
                            <div class="footer_contact_title">come & drop by</div>
                            <div class="footer_contact_list">
                                <ul style="max-width:190px">
                                    <li>Samjung Bldng, Nasipit Road, Talamban Cebu City</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Contact Item -->
                    <div class="col-xl-4 footer_contact_col">
                        <div
                            class="footer_contact_item d-flex flex-column align-items-center justify-content-start text-center">
                            <div class="footer_contact_icon"><img src="./assets/img/logos/around.svg" alt=""></div>
                            <div class="footer_contact_title">send us a message</div>
                            <div class="footer_contact_list">
                                <ul>
                                    <li>leshleereyes@gmail.com</li>
                                    <li>Talamban@travelifer.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col text-center">
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;
        <script>
        document.write(new Date().getFullYear());
        </script> All rights reserved | This website is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by
        Clees Choice Team
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    </div>

</footer>


<!-- footer ends -->
<style>
/*********************************
 Footer css
*********************************/

.footer {
    display: block;
    position: relative;
    padding-top: 136px;
}
 /* newsletter css */
.newsletter_title {
    font-family: 'Oswald', sans-serif;
    font-size: 36px;
    font-weight: 400;
    color: #FFFFFF;
    line-height: 1.2;
}

.newsletter_subtitle {
    font-family: 'Open Sans', sans-serif;
    font-size: 18px;
    color: #FFFFFF;
    font-weight: 300;
    margin-top: 18px;
}

.newsletter_form_container {
    margin-top: 84px;
}

.newsletter_input {
    width: 100%;
    height: 50px;
    background: rgba(255, 255, 255, 0.5);
    border: none;
    outline: none;
    padding-left: 22px;
    color: black;
}

.newsletter_input::-webkit-input-placeholder {
    font-size: 12px !important;
    font-weight: 400 !important;
    font-style: italic;
    color: #FFFFFF !important;
}

.newsletter_input:-moz-placeholder {
    font-size: 12px !important;
    font-weight: 400 !important;
    font-style: italic;
    color: #FFFFFF !important;
}

.newsletter_input::-moz-placeholder {
    font-size: 12px !important;
    font-weight: 400 !important;
    font-style: italic;
    color: #FFFFFF !important;
}

.newsletter_input:-ms-input-placeholder {
    font-size: 12px !important;
    font-weight: 400 !important;
    font-style: italic;
    color: #FFFFFF !important;
}

.newsletter_input::input-placeholder {
    font-size: 12px !important;
    font-weight: 400 !important;
    font-style: italic;
    color: #FFFFFF !important;
}

.newsletter_form>div:not(:last-child) {
    margin-right: 15px;
}

.newsletter_form>div:first-child {
    width: calc(100% - 176px);
}

.newsletter_form>div:first-child>div:first-child {
    width: calc((100% - 15px) * 0.35);
}

.newsletter_form>div:first-child>div:last-child {
    width: calc((100% - 15px) * 0.65);
}

.newsletter_form>div>div>div {
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 100%;
    height: 2px;
    background: #FFFFFF;
    visibility: hidden;
    opacity: 0;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease;
}

.newsletter_button {
    width: 161px;
    height: 50px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.5);
    font-family: 'Oswald', sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #FFFFFF;
    text-transform: uppercase;
    border: none;
    outline: none;
    cursor: pointer;
}

.footer_contact_row {
    margin-top: 80px;
    padding-bottom: 50px;
}

.footer_contact_item {
    width: 100%;
}

.footer_contact_icon {
    width: 68px;
    height: 68px;
}

.footer_contact_icon img {
    max-width: 100%;
}

.cr {
    width: 100%;
    height: 68px;
}

.cr div {
    font-size: 12px;
    font-weight: 400;
    color: rgba(255, 255, 255, 0.48);
}

.footer_contact_title {
    font-family: 'Oswald', sans-serif;
    font-size: 24px;
    color: #FFFFFF;
    font-weight: 400;
    text-transform: uppercase;
    margin-top: 18px;
}

.footer_contact_list {
    margin-top: 19px;
}

.footer_contact_list ul li {
    font-size: 14px;
    color: #FFFFFF;
    line-height: 1.71;
}

.footer_contact_list ul li:not(:last-child) {
    margin-bottom: 7px;
}
</style>

<!-- Portfolio Modals-->

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
// get the document ready
$(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
        e.preventDefault();
        var $form = $(this).closest(".form-submit");
        var pid = $form.find(".pid").val();
        var pname = $form.find(".pname").val();
        var pprice = $form.find(".pprice").val();
        var pimage = $form.find(".pimage").val();
        var pcode = $form.find(".pcode").val();

        var pqty = $form.find(".pqty").val();

        $.ajax({
            url: 'action.php',
            method: 'post',
            data: {
                pid: pid,
                pname: pname,
                pprice: pprice,
                pqty: pqty,
                pimage: pimage,
                pcode: pcode
            },
            success: function(response) {
                $("#message").html(response);
                window.scrollTo(0, 0);
                load_cart_item_number();
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

<!-- end of js -->
</body>
<!-- end of body -->

</html>