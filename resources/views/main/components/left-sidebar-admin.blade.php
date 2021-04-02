<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ URL('/admin') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Mutabaah</span></li>

                <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('admin/data/mutabaah/create') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                            class="hide-menu">Buat Jadwal Mutabaah
                        </span></a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('admin/data/mutabaah/manage') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                            class="hide-menu">Manage Jadwal
                        </span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Laporan Mutaba'ah</span></li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('admin/data/mutabaah/report/check') }}"
                        aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Seluruh Santri
                        </span>
                    </a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">MP3 Streaming</span></li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('admin/data/mp3/') }}"
                        aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">MP3 Streaming
                        </span>
                    </a>
                </li>

                {{-- <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('admin/data/mutabaah/preview') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                            class="hide-menu">Preview Mutabaah
                        </span></a>
                </li> --}}

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Data</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ URL('/admin/data/santri/import') }}"
                        aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                            class="hide-menu">Import Data Santri</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ URL('/admin/data/santri/manage') }}"
                        aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                            class="hide-menu">Manage Data Santri</span>
                    </a>
                </li>



                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="../../docs/docs.html"
                        aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                            class="hide-menu">Documentation</span></a></li>
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="authentication-login1.html"
                        aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                            class="hide-menu">Logout</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
