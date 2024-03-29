<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile">
    <!--begin::Logo-->
    <a href="index.html">
        <img alt="Logo" src="../assets/logo/white-version-logo.png" class="max-h-30px" />
        <strong class="logo-default logo-font">COMS</strong>
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button>
        <button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
            <span class="svg-icon svg-icon-xl">
                <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path
                            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        <path
                            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                            fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </button>
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->

<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Left-->
        <div class="d-none d-lg-flex align-items-center mr-3">
            <!--begin::Logo-->
            <a href="#" class="mr-20">
                <img alt="Logo" src="../assets/logo/white-version-logo.png" class="logo-default max-h-60px" />
                <strong class="logo-default logo-font">Concessionaire Operations Monitoring System</strong>
            </a>
            <!--end::Logo-->
        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
        <div class="topbar topbar-minimize">
            <!--begin::Search-->
            <!-- <div class="topbar-item mr-3 w-100 w-lg-auto justify-content-start">
                <div class="quick-search quick-search-inline w-auto w-lg-200px" id="kt_quick_search_inline">
                    
                    <form method="get" class="quick-search-form">
                        <div class="input-group rounded bg-light">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="svg-icon svg-icon-lg">
                                        
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        
                                    </span>
                                </span>
                            </div>
                            <input type="text" class="form-control h-40px" placeholder="Search..." />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="quick-search-close ki ki-close icon-sm"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    
                    
                    <div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,1px"></div>
                    
                   
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-lg dropdown-menu-anim-up">
                        <div class="quick-search-wrapper scroll" data-scroll="true" data-height="350"
                            data-mobile-height="200"></div>
                    </div>
                    
                </div>
            </div> -->
            <!--end::Search-->

            <!--begin::Quick panel-->
            <div class="topbar-item mr-3">
                <div class="btn btn-icon btn-clean h-40px w-40px" id="kt_quick_panel_toggle">
                    <div class="d-flex flex-column">
                        <div id="notif-number-parent">
                            <div id="notif-number-child"></div>
                        </div>
                        <div>
                            <i class="flaticon2-notification icon-lg menu-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Quick panel-->
            <!--begin::User-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="btn btn-icon btn-clean h-40px w-40px btn-dropdown">
                    <i class="flaticon2-user icon-lg menu-icon"></i>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center p-8 rounded-top">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
                            <img src="../assets/img/user/mayki.jpg" alt="" id="NavProfilePhoto" />
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5" id="NavFullName">Mayki Neri</div>
                        <!--end::Text-->
                    </div>
                    <div class="separator separator-solid"></div>
                    <!--end::Header-->
                    <!--begin::Nav-->
                    <div class="navi navi-spacer-x-0 pt-5">
                        <!--begin::Item-->
                      <a href="profile.php" class="navi-item px-8">
                            <div class="navi-link">
                                <div class="navi-icon mr-2">
                                    <i class="flaticon2-calendar-3 text-success"></i>
                                </div>
                                <div class="navi-text">
                                    <div class="font-weight-bold">My Profile</div>
                                    <div class="text-muted">Account settings
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!--end::Item-->
                        <!--begin::Footer-->
                        <div class="navi-separator mt-3"></div>
                        <div class="navi-footer px-8 py-5">
                            <a href="../index.php"
                                class="btn btn-light-primary font-weight-bold" onclick="SignOut()">Sign Out</a>
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->

<!--begin::Header Menu Wrapper-->
<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
    <div class="container">
        <!--begin::Header Menu-->
        <div id="kt_header_menu"
            class="header-menu header-menu-left header-menu-mobile header-menu-layout-default header-menu-root-arrow">
            <!--begin::Header Nav-->
            <ul class="menu-nav" id="menu-nav">
                <!-- <li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here"
                    data-menu-toggle="click" aria-haspopup="true">
                    <a href="#" class="menu-link menu-toggle">
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Concourse</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a target="_blank" href="https://preview.keenthemes.com/metronic/demo8/builder.html"
                                    class="menu-link">
                                    <i class="flaticon2-map text-danger icon-lg menu-icon"></i>
                                    <span class="menu-text">List of Concourse</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a target="_blank" href="https://preview.keenthemes.com/metronic/demo8/builder.html"
                                    class="menu-link">
                                    <i class="flaticon2-avatar text-danger icon-lg menu-icon"></i>
                                    <span class="menu-text">List of Tenants</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a target="_blank" href="https://preview.keenthemes.com/metronic/demo8/builder.html"
                                    class="menu-link">
                                    <i class="flaticon2-mail-1 text-danger icon-lg menu-icon"></i>
                                    <span class="menu-text">Space Applications</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Utility</span>
                        <span class="menu-desc"></span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a target="_blank" href="https://preview.keenthemes.com/metronic/demo8/builder.html"
                                    class="menu-link">
                                    <i class="flaticon-notepad text-danger icon-lg menu-icon"></i>
                                    <span class="menu-text">Bills summary</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
            </ul>
            <!--end::Header Nav-->
        </div>
        <!--end::Header Menu-->
    </div>
</div>
<!--end::Header Menu Wrapper-->
