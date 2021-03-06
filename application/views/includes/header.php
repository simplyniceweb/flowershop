<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=223633884496335";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
<style> .panel { background: #fce0ec !important; } .nav .caret { border-top-color: #FFF !important; border-bottom-color: #FFF !important }</style>
        <div class="container">
        <div class="row">
            <div class="col-md-5" style="z-index:999;">
                <img src="assets/images/header.jpg" alt="Keanna's Flowershop" style="background: #fce0ec;">
            </div>
        </div>
        </div>
        <nav class="navbar navbar-default" role="navigation"> <!--  navbar-static-top -->
            <div class="container">
            <div class="navbar-header">
            <?php if(isset($session)) if($session['user_level'] == 1){ ?>
            <a class="navbar-brand" href="admin">Admin Dashboard</a>
            <?php } else { ?>
            <a class="navbar-brand" href="home">Keanna's Flower shop</a>
            <?php } ?>
            </div>
            
            <ul class="nav navbar-nav">
                <li class="<?php if($segment == "home" || $segment == "") { echo "active"; } ?>"><a href="">Home</a></li>                
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
                <li class="<?php if($segment == "gallery") { echo "active"; } ?>"><a href="gallery">Gallery</a></li>
                <li class="<?php if($segment == "company") { echo "active"; } ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Company <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  <li><a href="#" data-toggle="modal" data-target="#fbModal">Feedback</a></li>
                    <li><a href="company/about">About us</a></li>
                    <li><a href="company/location">Location</a></li>
                    <li><a href="company/terms_conditons">Terms & Conditions</a></li>
                  </ul>
                </li>
                <?php if(isset($session) && isset($session["logged"])) { ?>
                <li><a href="cart">Cart</a></li>
                <li><a href="orders">Orders</a></li>
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
         <div class="modal fade" id="fbModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Feedback</h4>
              </div>
              <div class="modal-body">
				<div class="fb-comments" data-href="<?php echo base_url(); ?>/home" data-width="540" data-numposts="15" data-colorscheme="light"></div>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->