<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="/adm/bootstrap/css/bootstrap.min.css" media="screen">

    <!-- jquery-ui Stylesheets -->
    <link rel="stylesheet" href="/adm/assets/jui/css/jquery.ui.all.css" media="screen">
    <link rel="stylesheet" href="/adm/assets/jui/jquery-ui.custom.css" media="screen">
    <link rel="stylesheet" href="/adm/assets/jui/timepicker/jquery-ui-timepicker.css" media="screen">

    <!-- Uniform Stylesheet -->
    <link rel="stylesheet" href="/adm/plugins/uniform/css/uniform.default.css">

    <!-- Plugin Stylsheets first to ease overrides -->

    <!-- iButton -->
    <link rel="stylesheet" href="/adm/plugins/ibutton/jquery.ibutton.css" media="screen">

    <!-- Circular Stat -->
    <link rel="stylesheet" href="/adm/custom-plugins/circular-stat/circular-stat.css">

    <!-- Fullcalendar -->
    <link rel="stylesheet" href="/adm/plugins/fullcalendar/fullcalendar.css" media="screen">
    <link rel="stylesheet" href="/adm/plugins/fullcalendar/fullcalendar.print.css" media="print">

    <!-- End Plugin Stylesheets -->

    <!-- Main Layout Stylesheet -->
    <link rel="stylesheet" href="/adm/assets/css/fonts/icomoon/style.css" media="screen">
    <link rel="stylesheet" href="/adm/assets/css/main-style.css" media="screen">

    @yield('addstyle')

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <title>21 vek - Admin</title>

</head>

<body>

<div id="customizer">
    <div id="showButton"><i class="icon-cogs"></i></div>
    <div id="layoutMode">
        <label class="checkbox"><input type="checkbox" class="uniform" name="layout-mode" value="boxed"> Boxed</label>
    </div>
</div>

<div id="wrapper">
    <header id="header" class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <div class="brand-wrap pull-left">
                    <div class="brand-img">
                        <a class="brand" href="/">
                            21 век - агентство недвижимости
                        </a>
                    </div>
                </div>

                <div id="header-right" class="clearfix">
                    <div id="nav-toggle" data-toggle="collapse" data-target="#navigation" class="collapsed">
                        <i class="icon-caret-down"></i>
                    </div>

                    <div id="header-functions" class="pull-right">
                        <div id="user-info" class="clearfix">
                                <span class="info">
                                	Привет
                                    <span class="name">{{ Auth::user()->name }}</span>
                                </span>
                            <div class="avatar">
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="profile.html"><i class="icol-user"></i> My Profile</a></li>
                                    <li><a href="#"><i class="icol-layout"></i> My Invoices</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/logout"><i class="icol-key"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="logout-ribbon">
                            <a href="/logout"><i class="icon-off"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="content-wrap">
        <div id="content">
            <div id="content-outer">
                <div id="content-inner">
                    <aside id="sidebar">
                        <nav id="navigation" class="collapse">
                            <ul>
                                <li class="active">
                                    	<span title="General">
                                    		<i class="icon-home"></i>
											<span class="nav-title">Главная</span>
                                        </span>
                                    <ul class="inner-nav">
                                        <li @if(Request::path() == 'admin') class="active" @endif><a href="/admin"><i class="icol-dashboard"></i> Все объекты</a></li>
                                        <li @if(Request::path() == 'admin/addobject') class="active" @endif><a href="/admin/addobject"><i class="icol-add"></i> Добавить объект</a></li>
                                        <!--
                                        <li><a href="calendar.html"><i class="icol-calendar-2"></i> Calendar</a></li>
                                        <li><a href="icons.html"><i class="icol-lifebuoy"></i> Icons</a></li>
                                        <li><a href="grids.html"><i class="icol-grid"></i> Grids</a></li>
                                        <li><a href="typography.html"><i class="icol-font"></i> Typography</a></li>
                                        -->
                                    </ul>
                                </li>
                                <!--
                                <li>
                                    	<span title="Table">
                                    		<i class="icon-table"></i>
											<span class="nav-title">Table</span>
                                        </span>
                                    <ul class="inner-nav">
                                        <li><a href="tables.html"><i class="icol-style"></i> Static Tables</a></li>
                                        <li><a href="responsive_tables.html"><i class="icol-hammer-screwdriver"></i> Responsive Tables</a></li>
                                        <li><a href="data_tables.html"><i class="icol-table"></i> Data Tables</a></li>
                                        <li><a href="detail_view.html"><i class="icol-eye"></i> Detail View Table</a></li>
                                    </ul>
                                </li>
                                <li>
                                    	<span title="Statistic">
                                        	<i class="icon-graph"></i>
											<span class="nav-title">Statistic</span>
                                        </span>
                                    <ul class="inner-nav">
                                        <li><a href="statistic.html"><i class="icol-chart-curve"></i> Statistical Elements</a></li>
                                        <li><a href="charts_gallery.html"><i class="icol-chart-pie"></i> Charts Gallery</a></li>
                                    </ul>
                                </li>
                                <li>
                                    	<span title="Form">
                                        	<i class="icon-list"></i>
											<span class="nav-title">Form</span>
                                        </span>
                                    <ul class="inner-nav">
                                        <li><a href="form_layouts.html"><i class="icol-layout-select"></i> Form Layouts</a></li>
                                        <li><a href="form_elements.html"><i class="icol-ui-text-field-password"></i> Form Elements</a></li>
                                        <li><a href="form_wizard.html"><i class="icol-wand"></i> Form Wizard</a></li>
                                        <li><a href="form_validation.html"><i class="icol-accept"></i> Form Validation</a></li>
                                        <li><a href="wysiwyg.html"><i class="icol-pencil"></i> WYSIWYG</a></li>
                                    </ul>
                                </li>
                                <li>
                                    	<span title="Elements">
                                        	<i class="icon-cogs"></i>
											<span class="nav-title">Elements</span>
                                        </span>
                                    <ul class="inner-nav">
                                        <li><a href="ui_bootstrap.html"><i class="icol-ui-tab-content"></i> Bootstrap Elements</a></li>
                                        <li><a href="ui_components.html"><i class="icol-pipette"></i> Other Elements</a></li>
                                        <li><a href="alerts.html"><i class="icol-error"></i> Alerts and Notifications</a></li>
                                        <li><a href="boxes.html"><i class="icol-cog"></i> Widget Boxes</a></li>
                                        <li><a href="buttons.html"><i class="icol-joystick"></i> Buttons</a></li>
                                        <li><a href="file_uploader.html"><i class="icol-computer"></i> File Uploader</a></li>
                                        <li><a href="file_manager.html"><i class="icol-databases"></i> File Manager</a>
                                    </ul>
                                </li>
                                <li>
                                    	<span title="Extra">
                                        	<i class="icon-gift"></i>
											<span class="nav-title">Extra</span>
                                        </span>
                                    <ul class="inner-nav">
                                        <li><a href="profile.html"><i class="icol-user"></i> Profile Page</a></li>
                                        <li><a href="mail.html"><i class="icol-email"></i> Mail Page</a></li>
                                        <li><a href="widgets.html"><i class="icol-ruby"></i> Custom Widgets</a></li>
                                        <li><a href="gallery.html"><i class="icol-images"></i> Image Gallery</a>
                                        <li><a href="contacts.html"><i class="icol-vcard"></i> Contact List</a></li>
                                        <li><a href="404.html"><i class="icol-error"></i> Error Page (404)</a></li>
                                    </ul>
                                </li>
                                -->
                            </ul>
                        </nav>
                    </aside>

                    <div id="sidebar-separator"></div>

                    <section id="main" class="clearfix">
                        @yield('content')
                    </section>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer">
        <div class="footer-left">MoonCake - Responsive Admin Template</div>
        <div class="footer-right"><p>Copyright 2012. All Rights Reserved.</p></div>
    </footer>

</div>

<!-- Core Scripts -->
<script src="/adm/assets/js/libs/jquery-1.8.2.min.js"></script>
<script src="/adm/bootstrap/js/bootstrap.min.js"></script>
<script src="/adm/assets/js/libs/jquery.placeholder.min.js"></script>
<script src="/adm/assets/js/libs/jquery.mousewheel.min.js"></script>

<!-- Template Script -->
<script src="/adm/assets/js/template.js"></script>
<script src="/adm/assets/js/setup.js"></script>

<!-- Customizer, remove if not needed -->
<script src="/adm/assets/js/customizer.js"></script>

<!-- Uniform Script -->
<script src="/adm/plugins/uniform/jquery.uniform.min.js"></script>

<!-- jquery-ui Scripts -->
<script src="/adm/assets/jui/js/jquery-ui-1.8.24.min.js"></script>
<script src="/adm/assets/jui/jquery-ui.custom.min.js"></script>
<script src="/adm/assets/jui/timepicker/jquery-ui-timepicker.min.js"></script>
<script src="/adm/assets/jui/jquery.ui.touch-punch.min.js"></script>

<!-- Plugin Scripts -->

<!-- Flot -->
<!--[if lt IE 9]>
<script src="/adm/assets/js/libs/excanvas.min.js"></script>
<![endif]-->
<script src="/adm/plugins/flot/jquery.flot.min.js"></script>
<script src="/adm/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
<script src="/adm/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
<script src="/adm/plugins/flot/plugins/jquery.flot.resize.min.js"></script>

<!-- Circular Stat -->
<script src="/adm/custom-plugins/circular-stat/circular-stat.min.js"></script>

<!-- SparkLine -->
<script src="/adm/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- iButton -->
<script src="/adm/plugins/ibutton/jquery.ibutton.min.js"></script>

<!-- Full Calendar -->
<script src="/adm/plugins/fullcalendar/fullcalendar.min.js"></script>

<!-- DataTables -->
<script src="/adm/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adm/plugins/datatables/TableTools/js/TableTools.min.js"></script>
<script src="/adm/plugins/datatables/dataTables.bootstrap.js"></script>

<!-- Demo Scripts -->
<script src="/adm/assets/js/demo/dashboard.js"></script>

@yield('addscript')

</body>

</html>