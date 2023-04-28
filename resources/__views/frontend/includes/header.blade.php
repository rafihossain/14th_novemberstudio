

 <header>
     <div class="container">
        <nav class="navbar navbar-expand-lg navbar-ligh ">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{url('/')}}"><img src="assets/img/logo_light.png" class="img-fluid" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="assets/img/menu-bar-light.png" class="img-fluid">
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  m-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link {{ ($header_class == 'home' ? 'active':'') }}" aria-current="page" href="{{url('/')}}">HOME</a>
              </li>  
              <li class="nav-item">
                <a class="nav-link {{ ($header_class == 'about' ? 'active':'') }}" href="{{route('frontend.about')}}">About us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($header_class == 'cinema' ? 'active':'') }}" href="{{route('frontend.cinema')}}">Portfolio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($header_class == 'package' ? 'active':'') }}" href="{{route('frontend.package')}}">PACKAGES</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link {{ ($header_class == 'faq' ? 'active':'') }}" href="{{route('frontend.faq')}}">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($header_class == 'contact' ? 'active':'') }}" href="{{route('frontend.contatus')}}">Contact us</a>
              </li>
              
            </ul>
   
            <div class="header_social">
                <!--<a href="{{ $social_link[0]->settings_value }}" target="_blank"><img src="assets/img/facebook_light.png"/></a>-->
                <a href="{{ $social_link[3]->settings_value }}" target="_blank"><img src="assets/img/instagram_light.png"/></a>
                <a href="{{ $social_link[2]->settings_value }}" target="_blank"><img src="assets/img/vimeo_light.png"/></a>
            </div>
          </div>
        </div>
      </nav>
     </div>
    </header>
    
