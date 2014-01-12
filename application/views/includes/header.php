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
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span>
                <?php echo $session['user_name']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Homepage</a></li>
                        <?php if($session['user_level'] == 1): ?>
                        <li><a href="admin">Admin</a></li>
                        <?php endif; ?>
                        <li class="divider"></li>
                        <li><a href="settings">Settings</a></li>
                        <li><a href="logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>