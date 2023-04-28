@extends('frontend.layouts.app')

@section('title') About- {{ config('app.name') }} @endsection

@section('content')
<div class="page-header page-header-small clear-filter" filter-color="orange">
    <div class="page-header-image" data-parallax="true" style="background-image:url('{{asset('img/cover-01.jpg')}}');">
    </div>
    <!--<div class="container">-->
    <!--    <h3 class="title">-->
    <!--      About Us-->
    <!--    </h3>-->
    <!--</div>-->
</div>

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
              <iframe title="Amelia & Francis&amp;rsquo; Wedding Highlights || Terrace On The Green" src="{{ $section_message[0]->section_link }}?h=34b248d9b2&dnt=1&app_id=122963&autoplay=1&loop=1&background=1&autopause=0&controls=2&portrait=0&color=#000000" width="740" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-origwidth="640" data-origheight="360"  ></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
