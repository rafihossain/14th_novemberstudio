<?php
$nsettings = \App\Models\Setting::where('group_name', 'general_settings')->get();
?>

 <footer>
       <div class="container">
        <div class="footer_left">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-3">
              <div class="text-center mb-2">
                <img src="{{ asset('images/general_settings/'.$general_settings[3]->settings_value)}}" class="img-fluid">
              </div>
               <!--<p>{!! $general_settings[4]->settings_value !!}</p>-->
            </div>
            <!--<div class="col-md-6">-->
            <!--   <h2>Menu</h2>-->
            <!--   <ul>-->
            <!--     <li><a href="{{ url('/') }}">HOME</a></li>-->
            <!--     <li><a href="{{ route('frontend.about') }}">ABOUT</a></li>-->
            <!--     <li><a href="{{ route('frontend.cinema') }}">Portfolio</a></li>-->
            <!--     <li><a href="{{ route('frontend.package') }}">PACKAGES</a></li> -->
            <!--     <li><a href="{{ route('frontend.faq') }}">FAQ</a></li>-->
            <!--     <li><a href="{{ route('frontend.contatus') }}">CONTACT</a></li>-->
            <!--   </ul>-->
            <!--</div>-->
            <div class="col-md-3">
               
                 <h2>CONTACT US</h2>  
                 <!--<p>{{$nsettings[0]->settings_value}}</p>-->
                 <p>{{$nsettings[1]->settings_value}}</p>
                 <p>{{$nsettings[2]->settings_value}}</p>
                
               
            </div>
            <div class="col-md-5"> 
              <h2>Follow Us</h2>  
              <div class="footer_social">
                <p>
                    <!--<a href="{{ $social_link[0]->settings_value }}" target="_blank"><img src="assets/img/facebook_light.png"/></a>-->
                    <a href="{{ $social_link[3]->settings_value }}" target="_blank"><img src="assets/img/instagram_light.png"/></a>
                    <a href="{{ $social_link[2]->settings_value }}" target="_blank"><img src="assets/img/vimeo_light.png"/></a>
                    <!--<a href="#" target="_blank"><img src="assets/img/facebook_light.png"/></a>-->
                    <!--<a href="#" target="_blank"><img src="assets/img/instagram_light.png"/></a>-->
                    <!--<a href="#" target="_blank"><img src="assets/img/vimeo_light.png"/></a>-->
                </p>
                <ul>
                 <li><a href="{{ url('/') }}">HOME</a></li>
                 <li><a href="{{ route('frontend.about') }}">ABOUT</a></li>
                 <li><a href="{{ route('frontend.cinema') }}">Portfolio</a></li>
                 <li><a href="{{ route('frontend.package') }}">PACKAGES</a></li> 
                 <li><a href="{{ route('frontend.faq') }}">FAQ</a></li>
                 <li><a href="{{ route('frontend.contatus') }}">CONTACT</a></li>
               </ul>
              </div>
            <p>&nbsp;</p>
            </div>
          </div>
        </div>
            
       </div>
       <div class="footer_bottom">
         <div class="container text-center">
            © {{ date('Y') }} 14th November Studio . All Rights Reserved
         </div>
       </div>
    </footer>
 <style>
      .choose_type_other, .single_day_packages, .multi_day_packages {
          display:none;
      }
  </style> 
<script type="text/javascript">
    $(window).scroll(function () {
      if($(window).scrollTop() > 100) {
        $("header").addClass('sticky');
      } else {
        $("header").removeClass('sticky');
      }
    });

    $('.choose_type_other').hide();
    $("body").delegate('.choose_type', "change", function() {
        var choosetype = $(this).val(); 
        if(choosetype == '4'){ 
            $(".choose_type_other").show();
        }else{
            $(".choose_type_other").hide();
        }
        
    });
     $("body").delegate('.choose_package', "change", function() {
        var choosepackage = $(this).val();  
        if(choosepackage == '1'){ 
            $(".single_day_packages").show();
             $(".multi_day_packages").hide(); 
        }else if(choosepackage == '2'){
            $(".single_day_packages").hide();
            $(".multi_day_packages").show();
        }else{ 
            $(".single_day_packages").hide();
            $(".multi_day_packages").hide();
        }
        
    });
</script>