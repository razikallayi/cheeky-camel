    <!--Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info" style="background-color:#FDFDFD;">
       {{--          <div class="image">
                    <img src="{{url(config('whyte.project.logo'))}}" width="48" height="48" alt="User" />
                </div> --}}
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{url(config('whyte.project.logo'))}}"  height="70" alt="User" /></div>

                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    @include('admin.layout.partials.sidemenu')
                </ul>
            </div>

            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    <a target="_blank" href="{{ url(config('whyte.admin.copyright_link'))}}">{{config('whyte.admin.copyright')}}</a>
                </div>
                {{-- <div class="version">
                    <b>Version: </b> 1.0.3
                </div> --}}
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar-->