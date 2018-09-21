
<nav class="navbar navbar-expand-md navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand navbar-brand-custom" href="/home">Larapreango</a>
        <button class="navbar-toggler navbar-toggler-custom" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">
            
            <li class="nav-item">
                <a class="nav-link {{Request::is('blogs') ? 'active' : ''}}" href="{{url('/blogs')}}"> <i class="far fa-newspaper"></i> Blogs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Request::is('yourBlogs') ? 'active' : ''}}" href="{{url('/yourBlogs')}}"> <i class="fas fa-pencil-alt"></i> Your Blogs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Request::is('contact') ? 'active' : ''}}" href="{{url('/contact')}}"> <i class="fas fa-phone"></i> Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Request::is('about') ? 'active' : ''}}" href="{{url('/about')}}"> <i class="fas fa-info-circle"></i> About</a>
            </li>

        </ul>

        <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                        <!--Dropdown Heading-->
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->firstName }} <span class="caret"></span>
                        </a>

                        <!--Dropdown Body-->
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/blogs/create')}}"> <i class="fas 3x fa-plus"></i> New Blog</a>
                            <a class="dropdown-item" href="/profile/{{Auth::user()->id}}/edit"> <i class="fas fa-user-edit"></i> Edit Profile</a>

                            <!--Start Logout-->
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <!--End Logout-->
                            
                        </div>
                    </li>
        </ul>     
        </div>
    </div>
</nav>
