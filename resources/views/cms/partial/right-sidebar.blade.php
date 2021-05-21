<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-light">
        @yield('breadcrumb')
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content" id="app">

        @yield('content')

    </div>
    <!-- /content area -->


    <!-- Footer -->
    <div class="navbar navbar-expand-lg navbar-light">
        <div class="text-center d-lg-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                    data-target="#navbar-footer">
                <i class="icon-unfold mr-2"></i>
                Footer
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2018. <a href="#">STO Vietnam</a>
					</span>
        </div>
    </div>
    <!-- /footer -->

</div>
<!-- /main content -->