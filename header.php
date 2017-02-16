<?php  
    $cat = new category();
    $categories = $cat->selectind();
?>
<header>
                <section id="top-area">
                    <p>Phone orders: 1-800-0000 | Email us: <a href="mailto:office@shop.com">office@shop.com</a></p>
                </section><!-- end top-area -->
                <section id="action-bar">
                    <div id="logo" <?php if($loguser&&$loguser->isadmin==1) echo "class='admin-view'"; ?>>
                        <a href="index.php"><span id="logo-accent">e</span>Commerce</a>
                    </div><!-- end logo -->

                    <nav class="dropdown">
                        <ul>
                            <li>
                                <a href="#">Shop by Category <img src="img/down-arrow.gif" alt="Shop by Category" /></a>
                                <ul>
                            <?php if($categories): ?>
                                <?php foreach ($categories as $category): ?>
                                    <li>
                                    <a href="category.php?id=<?= $category->idcategory ?>"><?= $category->name; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                                </ul>
                            </li>
                        </ul>
                    </nav>

                    <div id="search-form">
                        <form action="search.php" method="get">
                            <input type="search" placeholder="Search by product name" class="search" name="searchbox" id="searchbox">
                            <input type="submit" value="Search" class="search submit">
                        </form>
                    </div><!-- end search-form -->

                    <div id="user-menu">
                    <?php if($loguser): ?>
                        <nav class="dropdown">
                            <ul>
                                <li>
                                    <a href="profile.php"><img src="img/user-icon.gif" alt="<?= $loguser->name?>" /> <?= $loguser->name ?> <img src="img/down-arrow.gif" alt="<?= $loguser->name ?>" /></a>
                                    <ul>
                                        <?php if($loguser&&$loguser->isadmin==1): ?>
                                        <li><a href="admin-panel.php">Admin Panel</a></li>
                                        <?php endif; ?>
                                        <li><a href="profile.php">My Account</a></li>
                                        <li><a href="update-user-info.php">Update My Info</a></li>
                                        <li><a href="#">Order History</a></li>
                                        <li><a href="signout.php">Sign Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    <?php else: ?>
                        <nav id="signin" class="dropdown">
                            <ul>
                                <li>
                                    <a href="signin.php"><img src="img/user-icon.gif" alt="Sign In" /> Sign In <img src="img/down-arrow.gif" alt="Sign In" /></a>
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
                        <?php if($loguser&&$loguser->isadmin==1): ?>
                        <a href="admin-panel.php" id="admin-panel"><img src="img/admin.ico" alt="Admin Panel"> Admin Panel</a>
                        <?php endif; ?>
                        <a href="shopping-cart.php"><img src="img/blue-cart.gif" alt="View Cart"> View Cart</a>
                    </div><!-- end view-cart && admin-panel -->
                </section><!-- end action-bar -->
            </header>