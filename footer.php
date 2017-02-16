 <footer>
                <section id="contact">
                    <h3>For phone orders please call 1-800-000. You<br>can also email us at <a href="mailto:office@shop.com">office@shop.com</a></h3>
                </section><!-- end contact -->

                <hr />

                <section id="links">
                    <div id="my-account">
                        <h4>MY ACCOUNT</h4>
                        <ul>
                            <?php if(!$loguser): ?>
                            <li><a href="signin.php">Sign In</a></li>
                            <li><a href="new-account.php">Sign Up</a></li>
                            <?php else: ?>
                            <li><a href="profile.php">My Profile</a></li>
                            <li><a href="#">Order History</a></li>
                            <li><a href="shopping-cart.php">Shopping Cart</a></li>
                        <?php endif; ?>
                        </ul>
                    </div><!-- end my-account -->
                    <div id="info">
                        <h4>INFORMATION</h4>
                        <ul>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div><!-- end info -->
                    <div id="extras">
                        <h4>EXTRAS</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div><!-- end extras -->
                </section><!-- end links -->

                <hr />

                <section class="clearfix">
                    <div id="copyright">
                        <div id="logo">
                            <a href="index.php"><span id="logo-accent">e</span>Commerce</a>
                        </div><!-- end logo -->
                        <p id="store-desc">This is a short description of the store.</p>
                        <p id="store-copy">&copy; 2013 eCommerce. Theme designed by Adi Purdila.</p>
                    </div><!-- end copyright -->
                    <div id="connect">
                        <h4>CONNECT WITH US</h4>
                        <ul>
                            <li class="twitter"><a href="#">Twitter</a></li>
                            <li class="fb"><a href="#">Facebook</a></li>
                        </ul>
                    </div><!-- end connect -->
                    <div id="payments">
                        <h4>SUPPORTED PAYMENT METHODS</h4>
                        <img src="img/payment-methods.gif" alt="Supported Payment Methods">
                    </div><!-- end payments -->
                </section>
            </footer>
        </div><!-- end wrapper -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/jquery-ui.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        <script>
            $(function() {
                $("#datepicker").datepicker({
                    defaultDate: "-20y",
                    changeMonth: true,
                    changeYear: true,
                    minDate: new Date(1917, 1 - 1, 1),
                    maxDate: "-10y",
                    altFormat: "yy-mm-dd",
                    altField: "#datepicker"
                });
                
                $("#emailField").on('change', function() {
                    var span = $("#emailField").siblings("span");
                    span.html("");
                    $.ajax({
                        url: "isvalidemail.php",
                        data: {email: $('#emailField').val()},
                        success: function(result){
                            span.html(JSON.parse(result));
                        },
                    });//end of ajax request
                });//end of on change 


            // $("#search-form").children("form").submit(function(e){
            //         e.preventDefault();
            // });

                // $("#searchbox").on('keyup', function() {

                //     $.ajax({
                //         url: "search.php",
                //         data: {searchbox: $('#searchbox').val()},
                //         success: function(data) {
                            
                //         },
                //     });//end of ajax request
                // });//end of on change 


            });
        </script>
    </body>
</html>
