<?php  
	require_once 'isuser.php';

	$products = false;

	if($_POST) {
		$searchby = $_POST['searchby'];
		$keyword = $_POST['searchbox'];
		if($searchby == "price") {
			$products = product::searchbyprice($keyword);
		}
		else if($searchby == "name") {
			$products = product::searchbyname($keyword);
		}
	}

	else if(isset($_GET['searchbox'])) {

		$productname = $_GET['searchbox'];

		$products = product::searchbyname($productname);

	}


?>

<!DOCTYPE html>
 <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
 <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
 <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
 <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
         <title>eCommerce - Search for products</title>
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width">

         <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

         <link rel="stylesheet" href="css/normalize.css">
         <link rel="stylesheet" href="css/main.css">
         <script src="js/vendor/modernizr-2.6.2.min.js"></script>
     </head>
     <body>
         <!--[if lt IE 7]>
             <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
         <![endif]-->
         <?php  
		    $cat = new category();
		    $categories = $cat->selectind();
		?>

			<?php  
    $cat = new category();
    $categories = $cat->selectind();
?>

<header id="searchpageheader">
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
                                        <li><a href="profile.php">My Profile</a></li>
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

         <div id="wrapper">

            <section id="main-content">
                <h2 id="search2">Search Results</h2>
                <hr class="clearboth">
                <form id="lblform" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            	 	<input type="search" placeholder="Search by product name" class="search" name="searchbox" id="searchbox">
                	<input type="submit" value="Search" class="search submit">
                	<br><br>
                	<input type="radio" name="searchby" value="name" checked>
                	<label class="searchlbl">
                	 Search by NAME</label>
                	<input type="radio" name="searchby" value="price">
                	<label class="searchlbl">
                	 Search by PRICE</label>       	
                </form>
         		<br><br><br><br>
                <div id="products">
                <?php if($products): ?>
                <?php foreach ($products as $product): ?>
                    <?php require 'product.php'; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                </div><!-- end products -->
            </section><!-- end main-content -->

            <hr />

<?php require_once 'footer.php'; ?>