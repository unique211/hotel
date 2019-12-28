<?php
    //echo '<pre>'.print_R($this->data,1).'</pre>';
?>
<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="javascript:void(0);">&nbsp;</a>
            <a href="#" class="x-navigation-control"></a>
        </li>

        <li class="xn-title text-right">

            <ul>
                <!-- TOGGLE NAVIGATION -->
                <li class="xn-icon-button">
                    {{--  <span class="logo-text">

                        <h4 style="margin-top:10px;">Ans The Solution</h4>

                    </span>  --}}
                    <a href="#" class="x-navigation-minimize"><span class="fa fa-bars"></span></a>
                </li>
                <!-- END TOGGLE NAVIGATION -->
            </ul>
        </li>
        <li class="x-active-nav"><a href="{{ url('dashboard') }}"><span class="fa fa-tachometer"></span> <span
                    class="xn-text">Dashboard</span></a></li>

        <li class="openable open  <?php  echo 'active';?>">
            <a href="#"><span class="fa fa-plus"></span> <span class="xn-text"> Master</span>
                <span class="menu-hover"></span>
            </a>
            <ul class="submenu">

                <li ><a href="{{url('category')}}"><span class="fa fa-list-alt"></span> <span
                    class="submenu-label">Category
                        </span></a></li>
                <li ><a href="{{url('room')}}"><span class="fa fa-home"></span> <span class="submenu-label">Room
                            Master</span>
                    </a></li>

                <li><a href="{{url('visiter')}}"><span class="fa fa-dropbox"></span> <span
                    class="submenu-label">Visitor
                            Master</span>
                    </a></li>


                <li><a href="{{ url('user_manage') }}"><span class="fa fa-user"></span> <span
                    class="submenu-label">User
                            Management</span></a></li>

                <li><a href="{{url('service')}}"><span class="fa fa-magic"></span> <span class="submenu-label">Extra
                            Service</span></a></li>
            </ul>
        </li>




        <li class=""><a href="{{url('allocationservice')}}"><span class="fa fa-magic"></span> <span
                    class="xn-text">Allocate
                    Service</span></a></li>

                    <li class=""><a href="{{url('advancebooking')}}"><span class="fa fa-dropbox"></span> <span
                        class="xn-text">Advance Booking
                    </span></a></li>

        <li class=""><a href="{{url('visitercheckin')}}"><span class="fa fa-dropbox"></span> <span
                    class="xn-text">Visitor Check In
                </span></a></li>
        {{-- <li class=""><a href="{{url('visitercheckout')}}"><span class="fa fa-dropbox"></span> <span
                    class="xn-text">Visitor Check Out
                </span></a></li> --}}
        <li class=""><a href="{{url('invoice')}}"><span class="fa fa-dropbox"></span> <span
                    class="xn-text">Invoice</span>
            </a></li>

        <li class="openable open  <?php  echo 'active';?>">
            <a href="#"><span class="fa fa-file"></span> <span class="xn-text">Report</span>
                <span class="menu-hover"></span>
            </a>
            <ul class="submenu">
                <li class=""><a href="{{url('checkinreport')}}"><span class="fa fa-file"></span> <span
                    class="submenu-label">Visitor
                            CheckIn Report</span>
                    </a></li>

                <li class=""><a href="{{url('chechoutreport')}}"><span class="fa fa-file"></span> <span
                    class="submenu-label">Visitor
                            CheckOut Report</span>
                    </a></li>
                <li class=""><a href="{{url('extraitemreport')}}"><span class="fa fa-file"></span> <span
                    class="submenu-label">Extra
                            Service Report</span>
                    </a></li>

                <li class=""><a href="{{url('invoicereport')}}"><span class="fa fa-file"></span> <span
                    class="submenu-label">Invoice
                            Report</span>
                    </a></li>
            </ul>
        </li>

       
        <li class="openable open  <?php  echo 'active';?>">
                <a href="#"><span class="fa fa-cog fa-fw"></span> <span class="xn-text">Settings</span>
                    <span class="menu-hover"></span>
                </a>
                <ul class="submenu">
                        <li class=""><a href="{{url('changelanguges')}}"><span class="fa fa-language"></span> <span
                            class="submenu-label">Languages
                                    </span>
                            </a></li>
                            <li class=""><a href="{{url('settime')}}"><span class="fa fa-time"></span> <span
                                class="submenu-label">Set Time & Currency
                                        </span>
                                </a></li>
                            
                </ul>
            </li>

        {{-- <li class=""><a href="{{url('changelanguges')}}"><span class="fa fa-language"></span> <span
                    class="xn-text">Languages
                </span></a></li> --}}










    </ul>
    <!-- END X-NAVIGATION -->
</div>