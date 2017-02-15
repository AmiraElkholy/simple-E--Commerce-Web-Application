 <header>
                <section id="top-area">
                    <p>Phone orders: 1-800-0000 | Email us: <a href="mailto:office@shop.com">office@shop.com</a></p>
                </section><!-- end top-area -->
                <section id="action-bar">
                    <div id="logo">
                        <a href="#"><span id="logo-accent">e</span>Commerce</a>
                    </div><!-- end logo -->

                    <nav class="dropdown">
                        <ul>
                            <li>
                                <a href="#">Shop by Category <img src="img/down-arrow.gif" alt="Shop by Category" /></a>
                                <ul>
                                    <li><a href="#">Laptops</a></li>
                                    <li><a href="#">Desktop PC</a></li>
                                    <li><a href="#">Smartphones</a></li>
                                    <li><a href="#">Tablets</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>

                    <div id="search-form">
                        <form action="#" method="get">
                            <input type="search" name="search" placeholder="Search by keyword" class="search">
                            <input type="submit" value="Search" class="search submit">
                        </form>
                    </div><!-- end search-form -->

                    <div id="user-menu">
                    <?php if($loguser): ?>
                        <nav class="dropdown">
                            <ul>
                                <li>
                                    <a href="#"><img src="img/user-icon.gif" alt="<?= $loguser->name ?>" /> <?= $loguser->name ?> <img src="img/down-arrow.gif" alt="<?= $loguser->name ?>" /></a>
                                    <ul>
                                        <?php if($loguser->isadmin==1): ?>
                                        <li><a href="admin-panel.php">Admin Panel</a></li>
                                        <?php endif; ?>
                                        <li><a href="#">Order History</a></li>
                                        <li><a href="#">Wishlist</a></li>
                                        <li><a href="signout.php">Sign Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    <?php else: ?>
                        <nav id="signin" class="dropdown">
                            <ul>
                                <li>
                                    <a href="#"><img src="img/user-icon.gif" alt="Sign In" /> Sign In <img src="img/down-arrow.gif" alt="Sign In" /></a>
                                    <ul>
                                        <li><a href="signin.php">Sign In</a></li>
                                        <li><a href="new-account.php">Sign Up</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>                        
                    <?php endif; ?>
                    </div><!-- end user-menu -->
                

                    <div id="view-cart">
                        <a href="shopping-cart.php"><img src="img/blue-cart.gif" alt="View Cart"> View Cart</a>
                    </div><!-- end view-cart -->
                </section><!-- end action-bar -->
            </header>