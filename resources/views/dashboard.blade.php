@include('layouts.header')

<body>
<style>
.my-card
{
    position:absolute;
    left:40%;
    top:-20px;
    border-radius:50%;
}

</style>


    {{-- START PAGE CONTAINER --}}
    <div class="page-container page-navigation-toggled page-container-wide">
        {{-- START PAGE SIDEBAR --}}


        @include('layouts.sidebar')

        {{-- END PAGE SIDEBAR --}}
        {{-- PAGE CONTENT --}}
        <div class="page-content">
            {{-- START X-NAVIGATION VERTICAL --}}

            @include('layouts.topbar')
            {{-- END X-NAVIGATION VERTICAL --}}
            {{-- START BREADCRUMB --}}

            {{--  END BREADCRUMB  --}}
            {{-- PAGE CONTENT WRAPPER --}}
            <div class="page-content-wrap">
                    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}

                    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/resources/sass/card.css') }}" />
                    {{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
                    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <!------ Include the above in your HEAD tag ---------->

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css
                    ">

                    <div class="jumbotron">
                    <div class="row w-100">
                            <div class="col-md-4">
                                <div class="card border-info mx-sm-1 p-3">
                                    <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-user" aria-hidden="true"></span></div>
                                    <div class="text-info text-center mt-3"><h4>Visiter CheckIn</h4></div>
                                    <div class="text-info text-center mt-2"><h1><?php echo $todaycheckin."/".$allvisiter; ?></h1></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-success mx-sm-1 p-3">
                                    <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-user" aria-hidden="true"></span></div>
                                    <div class="text-success text-center mt-3"><h4>Visitor Checkout</h4></div>
                                    <div class="text-success text-center mt-2"><h1><?php echo $todaycheckout."/".$allvisitercheckout; ?></h1></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-danger mx-sm-1 p-3">
                                    <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-file " aria-hidden="true"></span></div>
                                    <div class="text-danger text-center mt-3"><h4>Invoice</h4></div>
                                    <div class="text-danger text-center mt-2"><h1><?php echo $todayinvoice."/".$allinvoice; ?></h1></div>
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="card border-warning mx-sm-1 p-3">
                                    <div class="card border-warning shadow text-warning p-3 my-card" ><span class="fa fa-inbox" aria-hidden="true"></span></div>
                                    <div class="text-warning text-center mt-3"><h4>Inbox</h4></div>
                                    <div class="text-warning text-center mt-2"><h1>346</h1></div>
                                </div>
                            </div> --}}
                         </div>
                    </div>

            </div>
            {{-- END PAGE CONTENT WRAPPER --}}
        </div>
        {{-- END PAGE CONTENT --}}
    </div>
    {{-- END PAGE CONTAINER --}}
    {{-- MESSAGE BOX--}}

    @include('layouts.message_box')
    {{-- END MESSAGE BOX--}}
    {{-- START SCRIPTS --}}

    @include('layouts.footer_scripts')

    {{-- END SCRIPTS --}}
    <script type="text/javascript">
        $(document).ready(function () {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    });


  var getdashboard="{{url('gettodaycountofall')}}";
    </script>




</body>
<script src="{{ URL::asset('resources/js/myjs/dashboard.js') }}">
</html>
