@extends('frontend.layouts.app')

@section('title') {{app_name()}} @endsection

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

<style>
  .btn-light-custom.btn-sm{
    font-size: 13px;
    padding: 5px 15px;
  }
</style>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@if(!empty($bannerlist))
    <section id="banner" class="home_banner">
      <div class="home_banner_video">
        <iframe title="Mary &amp;amp; Jake || Wedding Highlights || Old Mill Toronto" src="{{ $bannerlist[0]->banner_link }}?h=5f1030623c&amp;dnt=1&amp;app_id=122963&autoplay=1&loop=1&background=1&autopause=0&controls=2&portrait=0&color=#000000" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> 
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
        <h3 class="main-title center">Portfolio</h3>
        <div class="row">
            
            @foreach($cinemas as $key => $cinema)
            
          <div class="col-md-4">
            <div class="cinema_item">
                <a href="{{route('frontend.cinema', ['id'=>$key]) }}"> 
                    <div class="cinema_item_content">
                        <span class="cinema_item_title">
                         {{ $cinema->category_name }}
                        </span>
                    </div>
                    <div class="cinema_item_image">  
                        <img src="{{ $cinema->image }}" class="img-fluid" alt='cattegory image'/> 
                     
                    </div>
                </a>
            </div>
          </div>
          @endforeach
        
        </div>
      </div>
    </section>
@endif
<section class="home_list" id="our_packages">
    <div class="container">
        <h3 class="main-title light center">OUR PACKAGES</h3>
        <br>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-4">
                <div class="ourpackage_item">
                    <div>
                        {!! $packagelist->single_day_packages !!}
                        <a href="{{ route('frontend.package', ['id' => 0]) }}" class="btn btn-light-custom btn-sm mt-2" >Details</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ourpackage_item">
                    <div>
                        {!! $packagelist->multi_day_packages !!}
                        <a href="{{ route('frontend.package', ['id' => 1]) }}" class="btn btn-light-custom btn-sm mt-2" >Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
@if(!empty($addon))
<section class="adonlist"> 
    <div class="adonlist_content">
        <h3 class="main-title center"> {{ $addon->addon_hedding }}</h3>
        <div>{!! $addon->addon_description !!}
              </div>
        <a href="{{route('frontend.contatus')}}" class="btn btn-light-custom mt-4"> Contact Us </a>
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
              </div>
            </div>
            <div class="col-md-6">
               
                <div class="main-title"> {!! $section_message[1]->section_message_name !!} </div> 
                <div class="welocme_home_description"> 
                    {!! $section_message[1]->section_description !!}   </div>
              
            </div>
            
          </div>
        </div>
    </section>
    @endif
   <section id="testmonials">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="testmonial_list">
                    @foreach($testimonials as $testimonial)
                    <div>                        
                        <div class="testmonial_item">
                            <div class="testmonial_deatails">
                                {!! $testimonial->user_comment !!}
                            </div>
                            <div class="testmonial_userinfo"> 
                                <div class="testmonial_userinfo_details">
                                    <h3> {{ $testimonial->user_name }} </h3>
                                    <p> {{ $testimonial->user_designation }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" type="text/css" href="assets/css/modal-video.min.css">
<script src="assets/js/jquery-modal-video.min.js"></script>
<script>
	$('.js-modal-btn').modalVideo({channel:'vimeo'});
 
   $( document ).ready(function() {
       $('.testmonial_list').slick({
          dots: true,
          arrows: true,
          infinite: true,
          speed: 500,
          fade: true,
          cssEase: 'linear'
        });
    });
       
   </script>
 
@endsection
