<div class="container">
    <div class="row">
        <nav class="navbar navbar-default" role="navigation">
            
            <div class="navbar-header">
            <?php if($session['user_level'] == 1){ ?>
            <a class="navbar-brand" href="admin">Admin Dashboard</a>
            <?php } else { ?>
            <a class="navbar-brand" href="home">Flower Shop</a>
            <?php } ?>
            </div>
            
            <ul class="nav navbar-nav">
                <li class="<?php if($this->uri->segment(1) == "home") { echo "active"; } ?>"><a href="home">Home</a></li>
                <li class="<?php if($this->uri->segment(1) == "product") { echo "active"; } ?>"><a href="product">Products</a></li>
                <li class="<?php if($this->uri->segment(1) == "package") { echo "active"; } ?>"><a href="package">Packages</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown">
                <?php if($session): ?>
                	<span class="glyphicon glyphicon-user"></span>
				<?php endif; ?>
                <?php echo $session['user_name']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php if($session['user_level'] == 1): ?>
                        <li><a href="admin">Admin</a></li>
                        <li class="divider"></li>
                        <?php endif; ?>
                        <?php if($session): ?>
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