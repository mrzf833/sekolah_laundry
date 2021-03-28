<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Laundry</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
        @yield('css_plugin')
      
        <!-- Theme Styles -->
        <link href="{{ asset('assets/css/connect.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/dark_theme.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
        @yield('css_custom')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        @include('layouts.loader')
        <div class="connect-container align-content-stretch d-flex flex-wrap">

            @include('layouts.admin-sidebar')

            <div class="page-container">
                @include('layouts.topbar')
                <div class="page-content">
                    <div class="page-info">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    </div>
                    <div class="main-wrapper">
                        @if (Session::has('success') === true)
                            @component('components.alert-success')
                                @slot('message')
                                    {{ Session::get('success') }}
                                @endslot
                            @endcomponent
                        @elseif(Session::has('failed') === true)
                            @component('components.alert-danger')
                                @slot('message')
                                {{ Session::get('failed') }}
                                @endslot
                            @endcomponent
                        @elseif(Session::has('failed_import') === true)
                            @component('components.alert-danger')
                                @slot('message')
                                <br><br>
                                    @forelse (Session::get('failed_import') as $index => $values)
                                        <strong>Row : </strong> <span>{{ $values->row() }}</span> <br>
                                        <strong>attribute : </strong> <span>{{ $values->attribute() }}</span> <br>
                                        <strong>Errors</strong>
                                        <ul>
                                            @foreach ($values->errors() as $value)
                                                <li>{{ $value }}</li>
                                            @endforeach
                                        </ul> <br>
                                        <strong>Values</strong>
                                        <ul>
                                            @foreach ($values->values() as $key => $value)
                                                <li>{{ $key }} : {{ $value }}</li>
                                            @endforeach
                                        </ul>
                                        -------------------------------------
                                        <br>
                                    @empty
                                        
                                    @endforelse
                                @endslot
                            @endcomponent
                        @elseif(count($errors) > 0)
                            @component('components.alert-danger')
                                @slot('message')
                                    <br><br>
                                    @forelse ($errors->messages() as $index => $values)
                                        <strong>{{ $index }}</strong>
                                        <ul>
                                            @foreach ($values as $value)
                                                <li>{{ $value }}</li>
                                            @endforeach
                                        </ul>
                                    @empty
                                        
                                    @endforelse
                                @endslot
                            @endcomponent
                        @endif
                        @yield('content')
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
        
        <!-- Javascripts -->
        <script src="{{ asset('assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/apexcharts/dist/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/blockui/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot/jquery.flot.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot/jquery.flot.time.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot/jquery.flot.symbol.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot/jquery.flot.resize.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
        @yield('script_plugin')
        <script src="{{ asset('assets/js/connect.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
        <script src="{{ asset('assets/js/pages/format-waktu-indo.js') }}"></script>
        <script src="{{ asset('assets/js/pages/format-number.js') }}"></script>
        <script src="{{ asset('assets/js/pages/mysql-datetime-to-js-datetime.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        @yield('script_custom')
    </body>
</html>