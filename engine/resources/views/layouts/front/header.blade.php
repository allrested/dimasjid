<header class="wf100 header-two">
      <div class="h3-logo-row wf100">
        <div class="container">
          <div class="row">
            <div class="col-md-2 col-sm-4">
              <div class="h3-logo"> <a href="index.html"><img src="{{asset('assets-front')}}/images/logo_skc.png" alt="" width="150px"></a></div>
            </div>
            <div class="col-md-10 col-sm-4">
              <ul class="header-contact">
                <li><span>Kontak Kami:</span> <strong>info@sekoci-jabar.com</strong></li>
                <li class="city-exp"> <i class="fas fa-street-view"></i> <strong>Lokasi<br>SEKOCI</strong> </li>
                <li> <a href="{{ url('login') }}" class="btn btn-success">Login</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="h3-navbar wf100">
        <div class="container">
          <nav class="navbar">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle
                  navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span
                  class="icon-bar"></span> </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li> <a href="{{url('/')}}">Beranda</a></li>
                <li> <a href="{{url('/program')}}">Program</a></li>
                <li> <a href="{{url('/tentang')}}">Tentang Kami</a></li>
                <li> <a href="{{url('/berita')}}">Berita</a></li>
                <li> <a href="{{url('/agenda')}}">Agenda</a></li>
                <li> <a href="{{url('/album')}}">Album Galeri</a></li>
                <li> <a href="{{url('/kontak')}}">Kontak Kami</a></li>

              </ul>
              <ul class="navbar-right">
                <li class="search-form">
                  <form class="navbar-form">
                    <input type="text" class="form-control" placeholder="Search">
                    <button type="submit"><i class="fas fa-search"></i></button>
                  </form>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>