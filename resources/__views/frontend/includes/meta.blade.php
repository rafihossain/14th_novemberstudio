@php
if(!isset($meta_page_type)){
    $meta_page_type = 'website';
}
@endphp

@switch($meta_page_type)
    @case('website')
        <meta property="og:type" content="website" />
        @break

    @case('article')
        {{-- Facebook Meta --}}
        <meta property="og:type" content="article" />
        <meta property="article:published_time" content="5:45 PM Saturday, March 11, 2023" />
        <meta property="article:modified_time" content="5:45 PM Saturday, March 11, 2023" />
        <meta property="article:author" content="14thnovemberstudio" />
        <meta property="article:section" content="14th November Studio | Etobicoke Videography" />
        @foreach ($$module_name_singular->tags as $tag)
        <meta property="article:tag" content="14th November Studio" />
        @endforeach

        @break

    @case('profile')
        <meta property="og:type" content="profile" />
        <meta property="profile:first_name" content="14th November Studio" />
        <meta property="profile:last_name" content="14th November Studio" />
        <meta property="profile:username" content="info@14thnovemberstudio.ca" />
        <meta property="profile:gender" content="Male" />
        @break

    @default

@endswitch

    <!-- Facebook Meta -->
    <meta property="og:url" content="https://www.facebook.com/14ThNovemberStudio/?ref=br_rs" />
    <meta property="og:title" content="14th November Studio | Etobicoke Videography" />
    <meta property="og:site_name" content="14Th November Studio" />
    <meta property="og:description" content="{{ $meta->meta_description }}" />
    <meta property="og:image" content="{{asset('img/logo.png')}}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="14th November Studio">
    <meta name="twitter:url" content="https://www.14thnovemberstudio.ca/" />
    <meta name="twitter:creator" content="{{ setting('meta_twitter_creator') }}">
    <meta name="twitter:title" content="14th November Studio | Etobicoke Videography">
    <meta name="twitter:description" content="{{ $meta->meta_description }}">
    <meta name="twitter:image" content="{{asset('img/logo.png')}}">

    <!--canonical link-->
    <link type="text/plain" rel="author" href="{{asset('humans.txt')}}" />
    <link rel="canonical" href="{{url()->full()}}">
