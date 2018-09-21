<nav class="navbar navbar-expand-md navbar-dark navbar-custom">
  <div class="container">
    <a class="navbar-brand navbar-brand-custom" href="{{url('/')}}">Larapreango</a>
    <button class="navbar-toggler navbar-toggler-custom" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link {{Request::is('blogs') ? 'active' : ''}}"  href="{{url('/blogs')}}"> <i class="far fa-newspaper"></i> Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('contact') ? 'active' : ''}}" href="{{url('/contact')}}"> <i class="fas fa-phone"></i> Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('about') ? 'active' : ''}}" href="{{url('/about')}}"> <i class="fas fa-info-circle"></i> About</a>
        </li>
      </ul>
      {!! Form::open(['url' => '/search', 'class' => 'form-inline mt-2 mt-md-0', 'method' => 'GET']) !!}
        {{Form::text('search', '', ['class' => 'form-control mr-sm-2'])}}
        {{Form::submit('Search Blog', ['class' => 'btn btn-outline-warning button-custom my-2 my-sm-0'])}}
      {!! Form::close() !!}
    </div>
  </div>
  </nav>