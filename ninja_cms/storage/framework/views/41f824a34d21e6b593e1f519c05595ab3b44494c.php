      <div id="mimin-mobile" class="reverse">
        <div class="mimin-mobile-menu-list">
            <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
                <ul class="nav nav-list">
                    <li class="active ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa-home fa"></span>Master Data 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="<?php echo e(url('/coupon')); ?>">Coupon</a></li>
                        <li><a href="<?php echo e(url('/product')); ?>">Product</a></li>
                        <li><a href="<?php echo e(url('/shipment')); ?>">Shipment</a></li>
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
      </div>
      <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
        <span class="fa fa-bars"></span>
      </button>
<?php /* /var/www/html/ninja_cms_new/resources/views/include/mobile.blade.php */ ?>