        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="<?php echo e(url('/product')); ?>" class="navbar-brand"> 
                 <b>CMS FIBER CREME</b>
                </a>
           
              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span>Welcome, <?php echo e(session()->get('session_name')); ?></span>
                </li>
                <li class="avatar-dropdown" style="margin-right: 15px">
                  <a href="<?php echo e(url('/logout')); ?>">
                   <img src="<?php echo e(asset('img/logout.png')); ?>" class="img-circle avatar" />
                   </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
<?php /* C:\xampp\htdocs\ninja_cart\ninja_cms\resources\views/include/nav.blade.php */ ?>