<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center"></div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li>
                    <a href="{{route('backend.dashboard')}}">
                        <i class="fas fa-home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.manage-users') }}">
                        <i class="mdi mdi-account-multiple-outline mdi-18px"></i>
                        <span> Clients </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.event-list') }}">
                        <i class="mdi mdi-calendar mdi-18px"></i>
                        <span> Event </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.package-list') }}">
                        <i class="mdi mdi-calendar mdi-18px"></i>
                        <span> Package </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.manage-testimonial') }}">
                        <i class="mdi mdi-calendar mdi-18px"></i>
                        <span> Testimonial </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.faq-list') }}">
                        <i class="mdi mdi-calendar mdi-18px"></i>
                        <span> Faq </span>
                    </a>
                </li>
                
                <li>
                    <a href="#blog" data-bs-toggle="collapse">
                        <i class="mdi mdi-form-select mdi-24px"></i>
                        <span>Cinema</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="blog">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('backend.manage-category') }}">All Category</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.add-category') }}">Add Category</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.manage-type') }}">All Type</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.add-type') }}">Add Type</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.manage-cinema') }}">All Cinemas</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.add-cinema') }}">Add Cinemas</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('backend.videoprogress-list') }}">
                        <i class="mdi mdi-video-outline mdi-18px"></i>
                        <span> Video Progress </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.payment-list') }}">
                        <i class="mdi mdi-credit-card-outline mdi-18px"></i>
                        <span> Payment </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.announcement-list') }}">
                        <i class="mdi mdi-calendar mdi-18px"></i>
                        <span> Announcement </span>
                    </a>
                </li>
    
                   <li>
                    <a href="#pages" data-bs-toggle="collapse">
                        <i class="mdi mdi-file-document-multiple-outline mdi-24px"></i>
                        <span>Pages</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="pages">
                          <ul class="nav-second-level">
                            <li>
                                <a href="{{route('backend.allpages')}}">All pages</a>
                            </li>
                            <li>
                                <a href="{{route('backend.addpage')}}">Add page</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.manage-section') }}">All Sections</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.add-section') }}">Add Section</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.manage-pageimage') }}">Page Image</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('backend.order-list') }}">
                        <i class="mdi mdi-calendar mdi-18px"></i>
                        <span> ContactList </span>
                    </a>
                </li>
                 <li>
                    <a href="{{ route('backend.setting') }}">
                        <i class="mdi mdi-calendar mdi-18px"></i>
                        <span> Socail settings </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.edit-general') }}">
                        <i class="mdi mdi-calendar mdi-18px"></i>
                        <span> General settings </span>
                    </a>
                </li>
                
                
                    <!-- logout-->
                    <a class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fe-log-out"></i>
                        @lang('Logout')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End