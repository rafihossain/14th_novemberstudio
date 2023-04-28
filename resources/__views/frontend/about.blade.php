@extends('frontend.layouts.app')

@section('title') About- {{app_name()}} @endsection

@section('content')

<section class="breadcumb_title" style="background:url({{ asset('admin/image/page_image/'.$about_image->page_image) }}) no-repeat">
    <div class="container">
        <h3>About Us</h3>
    </div>
</section>

@if(!empty($bannerlist))
    <section id="banner" class="home_banner">
      <div class="home_banner_video">
        <iframe title="Mary &amp;amp; Jake || Wedding Highlights || Old Mill Toronto" src="{{ $bannerlist[0]->banner_link }}?h=5f1030623c&amp;dnt=1&amp;app_id=122963&autoplay=1&loop=1&background=1&autopause=0&controls=2&portrait=0&color=#000000" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>  
         <a href="javascript:;"  data-video-url="{{ $bannerlist[0]->banner_link }}" class="js-modal-btn video_fullscreen" target="_blank"><img src="assets/img/fullscreen.png" alt="fullscreen"/> </a>
      </div>
      <div class="banner_description">
        <h3> {{ $bannerlist[0]->banner_title }} </h3>
        <p>  {{ $bannerlist[0]->banner_content }}</p>
      </div>
     
    </section>
    @endif
    
@if(!empty($section_message))
 <section class="welocme_home" id="about_us">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
           
              <div class="main-title"> 
                <h2>{!! $section_message[0]->section_message_name !!}</h2>
             
              </div> 
              <div class="welocme_home_description"> 
          {!! $section_message[0]->section_description !!}
          </div>
            
          </div>
          <div class="col-md-6">
            <div class="welocme_home_video"> 
              <iframe title="Amelia & Francis&amp;rsquo; Wedding Highlights || Terrace On The Green" src="{{ $section_message[0]->section_link  }}?h=34b248d9b2&dnt=1&app_id=122963&autoplay=1&loop=1&background=1&autopause=0&controls=2&portrait=0&color=#000000" width="740" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-origwidth="640" data-origheight="360"  ></iframe>
              <a href="javascript:;"  data-video-url="{{ $section_message[0]->section_link  }}" class="js-modal-btn video_fullscreen" target="_blank"><img src="assets/img/fullscreen.png" alt="fullscreen"/> </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
    @if(!empty($cinemas))
       <section class="cinema_list">
      <div class="container">
        <h3 class="main-title center">cinema</h3>
        <div class="row">
            
            @foreach($cinemas as $cinema)
            
          <div class="col-md-4">
            <div class="cinema_item">
              <div class="cinema_item_content">
                <a href="{{route('frontend.cinema')}}" class="cinema_item_icon">  
                  <img src="{{ $cinema->icon }}" alt='cattegory icon'/> 
                </a>
                <a href="{{route('frontend.cinema')}}" class="cinema_item_title">
                 {{ $cinema->category_name }}
                </a>
              </div>
              <div class="cinema_item_image"> 
                  <a href="{{route('frontend.cinema')}}"> 
                    <img src="{{ $cinema->image }}" class="img-fluid" alt='cattegory image'/> 
                  </a>
                </div>
            </div>
          </div>
          @endforeach
        
        </div>
      </div>
    </section>
@endif
@if(!empty($addon))
    <section class="adonlist">
    <div class="adonlist_video">
      <iframe title="Mary & Jake || Wedding Highlights || Old Mill Toronto" src="{{ $addon->addon_link }}?h=5f1030623c&dnt=1&app_id=122963&autoplay=1&loop=1&background=1&autopause=0&controls=2&portrait=0&color=#000000" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-origwidth="640" data-origheight="360"></iframe>
 
     
      </div>
    <div class="adonlist_content">
        <h3> {{ $addon->addon_hedding }}</h3>
        <div>{!! $addon->addon_description !!}
              </div>
        <a href="{{route('frontend.contatus')}}" class="btn btn-light-custom mt-4"> Contact Us </a>
    </div>
</section>
@endif
@if(!empty($packages))
 <section class="ourpackage_list" id="our_packages">
      <div class="container">
        <h3 class="main-title center">OUR PACKAGES</h3>
        <br>
        <div class="row mt-4"> 
            <div class="col-md-6 ourpackage_list_left"> 
              <div class="ourpackage_item"> 
                 <div class="ourpackage_item_image">
                  <img src="{{ $packages[0]->image }}" alt="ourpackage"  class="w-100">
                 </div> 
                  <div class="ourpackage_item_content">
                    <h3>{{ $packages[0]->package_name }}</h3>
                    <div class="ourpackage_item_des">  
                     {!! $packages[0]->package_description !!} 
                    </div>
                    <a href="{{route('frontend.contatus')}}" class="btn btn-dark-custom mt-2" >Book Now</a>
                  </div>
              </div>
              <div class="ourpackage_item"> 
                 <div class="ourpackage_item_image">
                  <img src="{{ $packages[1]->image }}" alt="ourpackage"  class="w-100">
                 </div> 
                  <div class="ourpackage_item_content">
                    <h3>{{ $packages[1]->package_name }}</h3>
                    <div class="ourpackage_item_des"> 
                       {!! $packages[1]->package_description !!} 
                    </div>
                    <a href="{{route('frontend.contatus')}}" class="btn btn-dark-custom mt-2" >Book Now</a>
                  </div>
              </div>
            </div>
            <div class="col-md-6 ourpackage_list_right"> 
              <div class="ourpackage_item"> 
                 <div class="ourpackage_item_image">
                  <img src="{{ $packages[2]->image }}" alt="ourpackage"  class="w-100">
                 </div> 
                  <div class="ourpackage_item_content">
                    <h3>{{ $packages[2]->package_name }}</h3>
                    <div class="ourpackage_item_des">  
                      {!! $packages[1]->package_description !!} 
                    </div>
                    <a href="{{route('frontend.contatus')}}" class="btn btn-dark-custom mt-2" >Book Now</a>
                  </div>
              </div>
            </div>
          </div> 
      </div>
    </section>
@endif

@if(!empty($faqs))
 <section class="ourpackage_list" id="about_us">
      <div class="container">
        <h3 class="main-title center">Faqs</h3>
        <br>
         <div class="accordion" id="accordionExample">
              <?php
            $i = 0;
            ?>
            @foreach($faqs as $faq) 
            <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapseOne">
            {!! $faq->faq_question !!}
            </button>
            </h2>
            <div id="collapse{{$i}}" class="accordion-collapse collapse {{ ($i == 0 ? 'show':'')}}" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                     {!! $faq->faq_answare !!}
            </div>
            </div>
            </div>
                <?php $i++ ?>
            @endforeach
         
        </div>
      </div>
    </section>
@endif

@if(!empty($section_message[1]))
    <section class="home_aboutus">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="welocme_home_video"> 
                 <iframe title="Courtney & Justin || Teaser || Parkview Manor" src="{{ $section_message[1]->section_link  }}?h=de56b89957&dnt=1&app_id=122963&autoplay=1&loop=1&background=1&autopause=0&controls=2&portrait=0&color=#000000" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-origwidth="640" data-origheight="360"></iframe>
       
             <a href="javascript:;"  data-video-url="{{ $section_message[1]->section_link  }}" class="js-modal-btn video_fullscreen" target="_blank"><img src="assets/img/fullscreen.png" alt="fullscreen"/> </a>
              </div>
            </div>
            <div class="col-md-6">
                <div class="main-title"> {!! $section_message[1]->section_message_name !!} </div> 
                <div class="welocme_home_description"> 
                    {!! $section_message[1]->section_description !!}
                </div>
            </div>
          </div>
        </div>
    </section>
    @endif
    
    @if(!empty($ourteam))
    <section class="home_aboutus">
      <div class="mb-4 pb-4">
        <h3 class="main-title center">Team/Crew members</h3>
      </div>
    
      <div class="container">
        <div class="row align-items-center mt-4">
          <div class="col-md-6">
    
            @if(isset($ourteam->team_image))
            <div class="welocme_home_video welocme_home_img">
              <img src="{{ asset('admin/image/section/team/'.$ourteam->team_image) }}" alt="team" />
            </div>
            @endif
    
            @if(isset($ourteam->team_video_url))
            <div class="welocme_home_video">
               <a href="javascript:;"  data-video-url="{{ $ourteam->team_video_url }}" class="js-modal-btn video_fullscreen" target="_blank"><img src="assets/img/fullscreen.png" alt="fullscreen"/> </a>
              
              <iframe title="Courtney &amp; Justin || Teaser || Parkview Manor" src="{{ $ourteam->team_video_url }}?h=de56b89957&amp;dnt=1&amp;app_id=122963&amp;autoplay=1&amp;loop=1&amp;background=1&amp;autopause=0&amp;controls=2&amp;portrait=0&amp;color=#000000" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-origwidth="640" data-origheight="360"></iframe>
            </div>
            @endif
    
          </div>
          <div class="col-md-6">
            <div class="welocme_home_description">
              <!--<h3>{{ $ourteam->team_title }}</h3>-->
              <p>{!! $ourteam->team_description !!}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
    
    @if(!empty($equipment))
    <section class="welocme_home">
      <div class="container">
        <div class="mb-4 pb-4">
          <h3 class="main-title center">Equipment</h3>
        </div>
        <div class="row align-items-center mt-4">
          <div class="col-md-6">
            <div class="welocme_home_description">
              <!--<h3>{{ $equipment->equipment_title }}</h3>-->
              <p>{!! $equipment->equipment_description !!}</p>
            </div>
          </div>
          <div class="col-md-6">
            
            @if(isset($equipment->equipment_video))
            <div class="welocme_home_video">
             
              <iframe title="Courtney &amp; Justin || Teaser || Parkview Manor" src="{{ $equipment->equipment_video }}?h=de56b89957&amp;dnt=1&amp;app_id=122963&amp;autoplay=1&amp;loop=1&amp;background=1&amp;autopause=0&amp;controls=2&amp;portrait=0&amp;color=#000000" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-origwidth="640" data-origheight="360"></iframe>
               
            <a href="javascript:;"  data-video-url="{{ $equipment->equipment_video }}" class="js-modal-btn video_fullscreen" target="_blank"><img src="assets/img/fullscreen.png" alt="fullscreen"/> </a>
            </div>
            @endif
    
            @if(isset($equipment->equipment_photo))
            <div class="welocme_home_video welocme_home_img">
              <img src="{{ asset('admin/image/section/equipment/'.$equipment->equipment_photo) }}" alt="team" />
            </div>
            @endif
    
          </div>
    
        </div>
      </div>
    </section>
    @endif
    
    @if(!empty($workwith))
    <section class="home_aboutus">
      <div class="mb-4 pb-4">
        <h3 class="main-title center">Vendor we work with </h3>
      </div>
      <div class="container">
        <div class="row align-items-center mt-4">
          <div class="col-md-6">
            
            @if(isset($workwith->workwith_photo))
            <div class="welocme_home_video welocme_home_img">
              <img src="{{ asset('admin/image/section/workwith/'.$workwith->workwith_photo) }}" alt="team" />
            </div>
            @endif
    
            @if(isset($workwith->workwith_video))
            <div class="welocme_home_video">
              <a href="javascript:;"  data-video-url="{{ $workwith->workwith_video }}" class="js-modal-btn video_fullscreen" target="_blank"><img src="assets/img/fullscreen.png" alt="fullscreen"/> </a>
              <iframe title="Courtney &amp; Justin || Teaser || Parkview Manor" src="{{ $workwith->workwith_video }}?h=de56b89957&amp;dnt=1&amp;app_id=122963&amp;autoplay=1&amp;loop=1&amp;background=1&amp;autopause=0&amp;controls=2&amp;portrait=0&amp;color=#000000" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-origwidth="640" data-origheight="360"></iframe>
            </div>
            @endif
    
          </div>
          <div class="col-md-6">
            <div class="welocme_home_description">
              <!--<h3>{{ $workwith->workwith_title }}</h3>-->
              <p>{!! $workwith->workwith_description !!}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
<link rel="stylesheet" type="text/css" href="assets/css/modal-video.min.css">
<script src="assets/js/jquery-modal-video.min.js"></script>
<script>
$('.js-modal-btn').modalVideo({channel:'vimeo'});
</script>
   
@endsection
