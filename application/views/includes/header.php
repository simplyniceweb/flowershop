<?php $segment = $this->uri->segment(1); ?>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default" role="navigation">
            
            <div class="navbar-header">
            <?php if(isset($session)) if($session['user_level'] == 1){ ?>
            <a class="navbar-brand" href="admin">Admin Dashboard</a>
            <?php } else { ?>
            <a class="navbar-brand" href="home">Flower Shop</a>
            <?php } ?>
            </div>
            
            <ul class="nav navbar-nav">
                <li class="<?php if($segment == "home" || $segment == "") { echo "active"; } ?>"><a href="home">Home</a></li>
                <li class="<?php if($segment == "product") { echo "active"; } ?>"><a href="product">Products</a></li>
                <li class="<?php if($segment == "package") { echo "active"; } ?>"><a href="package">Packages</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown">
                <?php if(isset($session)) if($session): ?>
                	<span class="glyphicon glyphicon-user"></span>
				<?php endif; ?>
                <?php if(isset($session)) echo $session['user_name']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php if(isset($session)) if($session['user_level'] == 1): ?>
                        <li><a href="admin">Admin</a></li>
                        <li class="divider"></li>
                        <?php endif; ?>
                        <?php if(isset($session))  if($session): ?>
                        <li><a href="cart">Cart</a></li>
                        <li><a href="settings">Settings</a></li>
                        <li><a href="logout">Logout</a></li>
                        <?php else: ?>
                        <li><a href="login">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
            
        </nav>
    </div>
</div>