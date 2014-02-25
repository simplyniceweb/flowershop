<?php
	if(isset($session)){
		$this->db->where("user_id", $session['user_id']);
		$me = $this->db->get("users");
		foreach($me->result() as $me) { }
	}

	$this->db->where("category_type", 1);
	$product = $this->db->get("category");
	$this->db->where("category_type", 2);
	$package = $this->db->get("category");
	$segment = $this->uri->segment(1);
?>
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
            <div class="navbar-header">
            <?php if(isset($session)) if($session['user_level'] == 1){ ?>
            <a class="navbar-brand" href="admin">Admin Dashboard</a>
            <?php } else { ?>
            <a class="navbar-brand" href="home">Flower Shop</a>
            <?php } ?>
            </div>
            
            <ul class="nav navbar-nav">
                <li class="<?php if($segment == "home" || $segment == "") { echo "active"; } ?>"><a href="home">Home</a></li>                
                <li class="<?php if($segment == "product") { echo "active"; } ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  <?php foreach($product->result() as $pro) { ?>
                    <li><a href="product/<?php echo $pro->category_id; ?>"><?php echo $pro->category_name; ?></a></li>
                  <?php } ?>
                  </ul>
                </li>
                <li class="<?php if($segment == "package") { echo "active"; } ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Packages <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  <?php foreach($package->result() as $pack) { ?>
                    <li><a href="package/<?php echo $pack->category_id; ?>"><?php echo $pack->category_name; ?></a></li>
                  <?php } ?>
                  </ul>
                </li>
                <li class="<?php if($segment == "gallery") { echo "active"; } ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gallery <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  <?php foreach($product->result() as $pro) { ?>
                    <li><a href="gallery/<?php echo $pro->category_id; ?>"><?php echo $pro->category_name; ?></a></li>
                  <?php } ?>
                  <?php foreach($package->result() as $pack) { ?>
                    <li><a href="gallery/<?php echo $pack->category_id; ?>"><?php echo $pack->category_name; ?></a></li>
                  <?php } ?>
                  </ul>
                </li>
                <li class="<?php if($segment == "company") { echo "active"; } ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Company <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="company/about">About us</a></li>
                    <li><a href="company/location">Location</a></li>
                    <li><a href="company/terms_conditons">Terms & Conditions</a></li>
                  </ul>
                </li>
                 <?php if(isset($session)) { ?>
                <li><a href="orders">Orders</a></li>
                <li><a href="cart">Cart</a></li>
                <li><a href="message/<?php if(isset($session)) echo $session['user_id']; ?>">Messages</a></li>
                <?php } ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown">
                <?php if(isset($session)) if($session): ?>
                	<span class="glyphicon glyphicon-user"></span>
				<?php endif; ?>
                <?php if(isset($session) && $session) echo $me->user_name; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php if(isset($session)) if($session['user_level'] == 1): ?>
                        <li><a href="admin">Admin</a></li>
                        <li class="divider"></li>
                        <?php endif; ?>
                        <?php if(isset($session))  if($session): ?>
                        <li><a href="settings">Settings</a></li>
                        <li><a href="logout">Logout</a></li>
                        <?php else: ?>
                        <li><a href="login">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
          </div>
        </nav>