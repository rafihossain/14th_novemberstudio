@extends('frontend.layouts.app')

@section('title') Package - {{ config('app.name') }} @endsection

@section('content')

<style>
  div#loaderDiv {
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    background: rgba(0, 0, 0, 0.7);
    top: 0;
    bottom: 0;
    z-index: 999;
    height: 100vh;
    padding-top: 200px;
    display: none;
  }

  div#loaderDiv img {
    max-width: 120px;
  }
</style>

<section class="breadcumb_title" style="background:url({{ asset('admin/image/page_image/'.$package_image->page_image) }}) no-repeat">
    <div class="container">
        <h3>Our Packages</h3>
    </div>
</section>

<div class="page-header page-header-small clear-filter" filter-color="orange">
    <div class="page-header-image" data-parallax="true" style="background-image:url('{{asset('img/cover-01.jpg')}}');">
    </div>
</div>

<div id="loaderDiv"> <img src="{{asset('img/spinning-loading.gif')}}"> </div>
<section class="py-4 package_list" id="about_us">
      <div class="container">
        <br>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach($package_categories as $key => $cat)
              <li class="nav-item" role="presentation">
                <button class="nav-link common_tab {{ ($key == $isactive ? 'active' : '' ) }}" newids="{{$cat->id}}" id="tab{{$key}}-tab" data-bs-toggle="tab" data-bs-target="#tab{{$key}}" type="button" role="tab" aria-controls="tab{{$key}}" aria-selected="true">{{$cat->package_name}}</button>
              </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="row mt-4" id="newcontent"></div>
            
            <div class="text-center mt-4 mb-4  pt-4 pb-4">
                <a href="{{route('frontend.contatus')}}" class="btn btn-dark-custom btn-lg" >Book Now</a>
            </div>
        </div>
      </div>
    </section>
    
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
    
    <script type="text/javascript">
      function callpagination() {
        let cat_id = 0;
        $('.common_tab').each(function() {
          if ($(this).hasClass('active')) {
            cat_id = $(this).attr('newids');
          }
        })
    
        $.ajax({
          type: 'POST',
          url: "{{ route('frontend.get-package') }}",
          data: {
            cat_id: cat_id,
            "_token": "{{ csrf_token() }}"
          },
          dataType: 'JSON',
          beforeSend: function() {
            $("#loaderDiv").show();
          },
          success: function(data) {
            $('#newcontent').html(data);
            $("#loaderDiv").hide();
          }
        });
      }
    
    
      $(function() {
        callpagination();
        $('.common_tab').on('click', function() {
          callpagination();
        })
      });
    </script>
    
    
    
@endsection
