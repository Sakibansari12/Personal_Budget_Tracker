        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        @if (Auth::user()->usertype == 'Superadmin')
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('admin.dashboard') }}" aria-expanded="false"><i
                                    class="mdi me-2 mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('category.index') }}" aria-expanded="false">
                                <i class="mdi me-2 mdi-source-branch"></i><span class="hide-menu">Category</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('transaction.index') }}" aria-expanded="false">
                                <i class="mdi me-2 mdi-source-branch"></i><span class="hide-menu">Transaction</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('monthly.report') }}" aria-expanded="false">
                                <i class="mdi me-2 mdi-source-branch"></i><span class="hide-menu">Monthly Reports</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('recurring-transaction') }}" aria-expanded="false">
                                <i class="mdi me-2 mdi-source-branch"></i><span class="hide-menu">Recurring Transactions</span></a>
                        </li>
                        @endif

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('logout.user') }}" aria-expanded="false"><i
                                    class="mdi me-2 mdi-help-circle"></i><span class="hide-menu">Logout</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
