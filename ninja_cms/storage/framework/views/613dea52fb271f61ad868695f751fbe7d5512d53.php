            <div id="left-menu">
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                    <!--<li><div class="left-bg"></div></li>-->
                    <li class="time">
                      <h1 class="animated fadeInLeft">21:00</h1>
                      <p class="animated fadeInRight">Sat,October 1st 2029</p>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header"></span>Master Data
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="<?php echo e(url('/coupon')); ?>">Coupon</a></li>
                        <li><a href="<?php echo e(url('/product')); ?>">Product</a></li>
                        <li><a href="<?php echo e(url('/shipment')); ?>">Shipment</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header"></span> Master Location
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="<?php echo e(url('/province')); ?>">Provinces</a></li>
                        <li><a href="<?php echo e(url('/regency')); ?>">Regencies</a></li>
                        <li><a href="<?php echo e(url('/district')); ?>">Districts</a></li>
                        <li><a href="<?php echo e(url('/village')); ?>">Villages</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a href="<?php echo e(url('/customer')); ?>">Customer
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    <li class="ripple">
                      <a href="<?php echo e(url('/transaction')); ?>">Transaction
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    <li class="ripple">
                      <a href="<?php echo e(url('/report')); ?>">Report
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    <?php if(session()->get('session_id_group') == 1): ?>
                    <li><a href="<?php echo e(url('/user/password')); ?>">Change Password <span class="fa-angle-right fa right-arrow text-right"></span></a></li>
                    <?php else: ?>
                    <?php endif; ?>
                  </ul>
                </div>
            </div>
<?php /* C:\xampp\htdocs\ninja_cms_new\resources\views/include/left_menu.blade.php */ ?>