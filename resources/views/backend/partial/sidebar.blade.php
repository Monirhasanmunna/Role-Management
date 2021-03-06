<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="material-symbols-outlined">
                        dashboard
                    </i><span class="nav-text">Dashboard</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('app.dashboard')}}">Dashboard 1</a></li>
                </ul>
            </li>


            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="fa-solid fa-circle-check"></i>
                <span class="nav-text">Roles</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('app.roles.index')}}">Role List</a></li>
                </ul>
            </li>


            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="fa-solid fa-user-group"></i>
                <span class="nav-text">User</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('app.user.index')}}">User List</a></li>
                </ul>
            </li>
            
        </ul>
    </div>


</div>
