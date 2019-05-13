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
                        <li><a href="{{url('/coupon')}}">Coupon</a></li>
                        <li><a href="{{url('/product')}}">Product</a></li>
                        <li><a href="{{url('/shipment')}}">Shipment</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header"></span> Master Location
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="{{url('/province')}}">Provinces</a></li>
                        <li><a href="{{url('/regency')}}">Regencies</a></li>
                        <li><a href="{{url('/district')}}">Districts</a></li>
                        <li><a href="{{url('/village')}}">Villages</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a href="{{url('/customer')}}">Customer
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    <li class="ripple">
                      <a href="{{url('/transaction')}}">Transaction
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    <li class="ripple">
                      <a href="{{url('/report')}}">Report
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                    </li>
                    @if(session()->get('session_id_group') == 1)
                    <li><a href="{{url('/user/password')}}">Change Password <span class="fa-angle-right fa right-arrow text-right"></span></a></li>
                    @else
                    @endif
                  </ul>
                </div>
            </div>