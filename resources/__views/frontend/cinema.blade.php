@extends('frontend.layouts.app')

@section('title') Cinema- {{ config('app.name') }} @endsection


@section('content')
<link rel="stylesheet" type="text/css" href="assets/css/modal-video.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pagination.css') }}">
<style>
.modal-content {
    background: transparent  !important;
}
.modal-header {
    background: transparent !important;
    border: unset  !important;
    display: flex;
    justify-content: flex-end !important;
}
.modal-header button:before, .modal-header button:after {
  content: '';
    position: absolute;
    height: 2px;
    width: 20px;
    top: 50px;
    margin-top: -1px;
    background: #fff;
    border-radius: 5px;
    margin-top: -6px;
    right: 0;
    cursor: pointer;
}
button.close {
    background: transparent;
    position: absolute;
    height: 70px;
    margin-right: -31px;
    border: transparent;
    z-index: 999;
}
.modal-header button:after {
    transform: rotate(-45deg);
}
.modal-header button:before {
    transform: rotate(45deg);
}
</style>
<style>div#newcontent h3{text-align: center;}div#loaderDiv {position: absolute;left: 0;right: 0;text-align: center;background: rgba(0,0,0,0.7);top: 0;bottom: 0;z-index: 999;height:100vh;padding-top: 200px;display:none;}div#loaderDiv img{max-width:120px;}#myTabContent {position: relative;top: 10px;}.paginationjs{justify-content: center;}</style>
<section class="breadcumb_title" style="background:url({{ asset('admin/image/page_image/'.$portfolio_image->page_image) }}) no-repeat">
    <div class="container">
        <h3>Portfolio</h3>
    </div>
</section>

<div class="page-header page-header-small clear-filter" filter-color="orange">
    <div class="page-header-image" data-parallax="true" style="background-image:url('{{asset('img/cover-01.jpg')}}');">
    </div>
</div>

<div id="loaderDiv"> <img src="{{asset('img/spinning-loading.gif')}}"> </div>
<section class="py-4" id="about_us">
  <div class="container">
   
    <br>
    <div>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
          @foreach($categorys as $key => $cat)
        <li class="nav-item" role="presentation">
          <button class="nav-link common_tab {{ ($key == $isactive ? 'active' : '' ) }}" newids="{{  $cat['id'] }}" id="{{ $cat['category_slug'] }}" data-bs-toggle="tab" data-bs-target="#{{ $cat['category_slug'] }}-tab-pane" type="button" role="tab" aria-controls="{{ $cat['category_slug'] }}-tab-pane" aria-selected="true">{{ $cat['category_name'] }}</button>
        </li>
      @endforeach
      </ul>
      <div class="tab-content" id="myTabContent">
 
          <div class="row"  id="newcontent">
          </div>
            <div class="mt-4">
            <div id="wrapper">
            <section>
            <div id="pagination-demo3" class="d-none"></div>
            </section>
            </div>
         </div>
       
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
                <a href="#" class="cinema_item_icon">  
                  <img src="{{ $cinema->icon }}" alt='cattegory icon'/> 
                </a>
                <a href="#" class="cinema_item_title">
                 {{ $cinema->category_name }}
                </a>
              </div>
              <div class="cinema_item_image"> 
                  <a href="#"> 
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
   
<div class="modal fade" id="instagram-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<iframe width="560" height="315" id="instagram-modal-src" src="" frameborder="0"></iframe>
</div>
</div>
</div>
</div>

 <script src="{{ asset('js/pagination.min.js') }}"></script>
<script src="assets/js/jquery-modal-video.min.js"></script>
<script type="text/javascript">

function callpagination(){
 
 var dataSource =  [1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13];
    $('#pagination-demo3').pagination({
    dataSource:dataSource,
     callback: function (response, pagination) {
         let cat_id = 0;
         $('.common_tab').each(function(){
           if($(this).hasClass('active')){
               cat_id = $(this).attr('newids');
           }
         })
        $.ajax({
               type:'POST',
               url:"{{ route('frontend.getcinema') }}",
               data:{type:cat_id, pageno:pagination.pageNumber,"_token": "{{ csrf_token() }}"},
               dataType:'JSON',
                beforeSend: function() {
                $("#loaderDiv").show();
                },
               success:function(data){
                  dataSource = data.pages;
             $('#newcontent').html(data.html)
              $("#loaderDiv").hide();
                var dataHtml = '<ul>';
                $.each(response, function (index, item) {
                dataHtml += '<li>' + item + '</li>';
                });
                dataHtml += '</ul>';
                $('#data-container').html(dataHtml); 
                $('.js-modal-btn').modalVideo({channel:'vimeo'});
                $('.open_modal_and_play_video').modalVideo();
               }
            });
      }
})    
    
}


$(function() {
    callpagination();
    $('.common_tab').on('click',function(){
     callpagination();
    })
    // $( "body" ).delegate( ".js-modal-btn", "click", function() {
    // $(this).modalVideo({channel:'vimeo'});
    // });

    // $( "body" ).delegate( ".open_modal_and_play_video", "click", function() { 
    // $(this).modalVideo();
    // });

    // $( "body" ).delegate( ".open_modal_and_play_video", "click", function() {
    // let src = $(this).data('video-id')
    // console.log(src,'<!---- src --->');
    // $('#instagram-modal-src').attr('src',src)
    // $('#instagram-modal').modal('show');
    // });

// $('button.close').click(function(){
//   $('#instagram-modal').modal('hide');
// })

})


</script>
@endsection


