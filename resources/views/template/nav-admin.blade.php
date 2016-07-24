    
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo-text-container" href="{{ url('dashboard') }}">
                <div class="logo-text-content">
                    <h1 class="no-padding no-margin logo-text">DESC</h1>
                </div>
            </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void">
                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <!-- <ul class="dropdown-menu dropdown-alerts">
                    <li><a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts 
            </li> -->
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void">
                    <i class="fa fa-user fa-fw"></i> {{ Auth::user()->email }}  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li><a href="{{ url('dashboard') }}" class="text-center">
                        <i class="fa fa-dashboard fa-2x fa-fw"></i><br />
                        Dashboard
                    </a></li>
                    <!-- <li><a href="{{ url('graphs') }}" class="text-center">
                        <i class="fa fa-bar-chart fa-2x fa-fw"></i><br />
                        Graphs
                    </a></li>
                    <li><a href="{{ url('history') }}" class="text-center">
                        <i class="fa fa-history fa-2x fa-fw"></i><br />
                        History
                    </a></li> -->
                    <li><a href="{{ url('cluster') }}" class="text-center">
                        <i class="fa fa-cubes fa-2x fa-fw"></i><br />
                        Cluster
                    </a></li>
                    <li><a href="{{ url('advisory') }}" class="text-center">
                        <i class="fa fa-newspaper-o fa-2x fa-fw"></i><br />
                        Public Advisory
                    </a></li>
                    <li><a href="{{ url('account') }}" class="text-center">
                        <i class="fa fa-user fa-2x fa-fw"></i><br />
                        Accounts
                    </a></li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>