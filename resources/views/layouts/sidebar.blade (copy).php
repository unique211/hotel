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
        <li class="x-active-nav"><a href="{{ url('transaction') }}"><span class="fa fa-tachometer"></span> <span
                    class="xn-text">Dashboard</span></a></li>

        

        <li class=""><a  href="{{url('category')}}"><span class="fa fa-list-alt"></span> <span
                    class="xn-text">Category
                </span></a></li>
                <li class=""><a href="{{url('room')}}"><span class="fa fa-home"></span> <span class="xn-text">Room
                        Master</span>
                </a></li>

                <li class=""><a href="{{url('visiter')}}"><span class="fa fa-dropbox"></span> <span class="xn-text">Visiter
                        Master</span>
                </a></li>
               

        <li class=""><a href="{{ url('user_manage') }}"><span class="fa fa-user"></span> <span class="xn-text">User
                        Management</span></a></li>

                        <li class=""><a href="{{url('service')}}"><span class="fa fa-magic"></span> <span class="xn-text">Extra
                            Service</span></a></li>

                            <li class=""><a href="{{url('allocationservice')}}"><span class="fa fa-magic"></span> <span class="xn-text">Allocate
                                    Service</span></a></li>

                            <li class=""><a href="{{url('visitercheckin')}}"><span class="fa fa-dropbox"></span> <span class="xn-text">Visiter Check In
                            </span></a></li>
                            <li class=""><a href="{{url('visitercheckout')}}"><span class="fa fa-dropbox"></span> <span class="xn-text">Visitor Check Out
                            </span></a></li>
                            <li class=""><a href="{{url('invoice')}}"><span class="fa fa-dropbox"></span> <span class="xn-text">Invoice</span>
                            </a></li>

                            <li class=""><a href="{{url('checkinreport')}}"><span class="fa fa-file"></span> <span class="xn-text">Visitor CheckIn Report</span>
                            </a></li>

                            <li class=""><a href="{{url('chechoutreport')}}"><span class="fa fa-file"></span> <span class="xn-text">Visitor CheckOut Report</span>
                            </a></li>
                            <li class=""><a href="{{url('extraitemreport')}}"><span class="fa fa-file"></span> <span class="xn-text">Extra Service Report</span>
                            </a></li>

                            <li class=""><a href="{{url('invoicereport')}}"><span class="fa fa-file"></span> <span class="xn-text">Invoice Report</span>
                            </a></li>


                           <li class=""><a href="{{url('changelanguges')}}" ><span class="fa fa-language"></span> <span class="xn-text">Languages
                         </span></a></li>


       
       
      

  



    </ul>
    <!-- END X-NAVIGATION -->
</div>
