@extends('backend.layouts.app')
@section('title', 'Edit Section')
@section('content')

<form action="{{route('backend.update_section')}}" id="addsection" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="section_id" value="{{$one_section['id']}}">
    <input type="hidden" name="section_type" value="{{$one_section['section_type']}}">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-2">
                        <label>Section Name</label>
                        <input type="text" class="form-control @error('section_name') is-invalid @enderror" name="section_name" value="{{$one_section['section_name']}}">
                        @error('section_name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Section type </label>
                        <select name="section_type" class="form-control selectsections" disabled>
                            <option value="">Select type</option>
                            <option value="banner" @if($one_section['section_type']=='banner' ) selected @endif>Banner</option>
                            <option value="addon" @if($one_section['section_type']=='addon' ) selected @endif>Add on</option>
                            <option value="section_message" @if($one_section['section_type']=='section_message' ) selected @endif>Section Message</option>
                            <option value="home_aboutus" @if($one_section['section_type']=='home_aboutus' ) selected @endif>Home AboutUS</option>
                            <option value="home_faq" @if($one_section['section_type']=='home_faq' ) selected @endif>Home FAQ</option>
                            <option value="home_testimonial" @if($one_section['section_type']=='home_testimonial' ) selected @endif>Home Testimonial</option>
                            <option value="about_our_team" @if($one_section['section_type']=='about_our_team' ) selected @endif>About Our Team</option>
                            <option value="carrer_section" @if($one_section['section_type']=='carrer_section' ) selected @endif>Carrer</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Edit View Start -->

    @if($one_section['section_type'] == 'banner')
    <div id="new_banner">
        <?php $banner = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($banner);die();
        ?>
        @if(count($banner)>0)
        <h4>Banner</h4>
        <?php

        if (!empty($banner)) {
            foreach ($banner as $key => $sections) {
                //  echo "<pre>";
                // print_r($sections);
                // die();
        ?>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label>Banner Title</label>
                            <input type="text" class="form-control" name="banner_title[]" value="{{$sections['banner_title']}}">
                        </div>
                        <div class="form-group mb-2">
                            <label>Banner Content</label>
                            <textarea class="form-control" name="banner_content[]" placeholder="Description">{{$sections['banner_content']}}</textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label> Banner video Link </label>
                            <input type="text" class="form-control" name="banner_link[]" value="{{$sections['banner_link']}}">
                        </div>
                        <!--<div class="form-group mb-2"> -->
                        <!--    <label> Banner Image or Video </label> -->
                        <!--    <input type="file" class="imageupload" data-height="200" name="banner_image[]" data-default-file=""/> -->
                        <!--    <input type="hidden" name="old_banner_image[]" value="">-->
                        <!--</div>-->

                        <!--<div class="form-group mb-2">-->
                        <!--    <label>Publish Country</label>-->
                        <!--    <select class="form-control form-control @error('country') is-invalid @enderror" name="country[]">-->
                        <!--        <option value="">Select Country</option>-->
                        <!--        <option value="0" {{-- $sections['country'] == 0 ? 'selected' : '' --}}>All</option>-->
                        <!--        <option value="1" {{-- $sections['country'] == 1 ? 'selected' : '' --}}>Australia</option>-->
                        <!--        <option value="2" {{-- $sections['country'] == 2 ? 'selected' : '' --}}>Bangladesh</option>-->
                        <!--        <option value="3" {{-- $sections['country'] == 3 ? 'selected' : '' --}}>Nepal</option>-->
                        <!--        <option value="4" {{-- $sections['country'] == 4 ? 'selected' : '' --}}>Malaysia</option>-->
                        <!--        <option value="5" {{-- $sections['country'] == 5 ? 'selected' : '' --}}>India</option>-->
                        <!--        <option value="6" {{-- $sections['country'] == 6 ? 'selected' : '' --}}>SriLanka</option>-->
                        <!--        <option value="7" {{-- $sections['country'] == 7 ? 'selected' : '' --}}>Pakistan</option>-->
                        <!--        <option value="8" {{-- $sections['country'] == 8 ? 'selected' : '' --}}>China</option>-->
                        <!--    </select>-->
                        <!--    @error('country')-->
                        <!--    <strong class="text-danger">{{ $message }}</strong>-->
                        <!--    @enderror-->
                        <!--</div>-->


                    </div>
                </div>


        <?php }
        } ?>
        <!--<div id="">-->
        <!--        <h3>Add banner</h3>-->
        <!--        <div class="bannercontent">-->

        <!--        </div>-->
        <!--        <div class="addbanner"><i class="mdi mdi-plus"></i> </div>-->
        <!--</div>-->
        @else
        <div id="">
            <h3>Add banner</h3>
            <div class="bannercontent">

            </div>
            <div class="addbanner"><i class="mdi mdi-plus"></i> </div>
        </div>
        @endif
    </div>
    @endif


    @if($one_section['section_type'] == 'addon')
    <div id="new_addon">
        <?php $addons = json_decode($one_section['section_value'], true); ?>
        @if(count($addons)>0)
        <h4>Add On</h4>
        <?php

        if (!empty($addons)) {
            //echo "<pre>";print_r($addons);die();

        ?>
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Addon Hedding</label>
                        <input type="text" class="form-control" name="addon_hedding" value="{{ $addons['addon_hedding'] }}">
                        @error('addon_hedding')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Addon Description</label>
                        <textarea name="addon_description" id="editor9" class="form-control">{{ $addons['addon_description'] }}</textarea>
                        @error('addon_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Addon video link</label>
                        <input type="text" class="form-control" name="addon_link" value="{{ $addons['addon_link'] }}">
                        @error('section_link')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>


        <?php  } ?>
        @else
        <div id="">
            <h3>Add banner</h3>
            <div class="bannercontent">

            </div>
            <div class="addbanner"><i class="mdi mdi-plus"></i> </div>
        </div>
        @endif
    </div>
    @endif


    @if($one_section['section_type'] == 'section_message')
    <div id="new_section_message">
        <?php $section_message = json_decode($one_section['section_value'], true); ?>
        @if(count($section_message)>0)
        <h4>Add On</h4>
        <?php

        if (!empty($section_message)) {
            //echo "<pre>";print_r($addons);die();

        ?>
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Section Name</label>
                        <input type="text" class="form-control" name="section_message_name" value="{{ $section_message['section_message_name'] }}">
                        @error('section_message_name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>section Description</label>
                        <textarea name="section_description" id="editor8" class="form-control">{{ $section_message['section_description'] }}</textarea>
                        @error('section_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Section video link</label>
                        <input type="text" class="form-control" name="section_link" value="{{ $section_message['section_link'] }}">
                        @error('section_link')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>


        <?php  } ?>
        @endif
    </div>
    @endif


    @if($one_section['section_type'] == 'home_aboutus')
    <div id="new_about_us_news">
        <?php $about_us = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($about_us);die();
        ?>
        <h3>Home About Us</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="about_us_title" value="{{$about_us['title']}}">
                        @error('about_us_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Sub Title</label>
                        <textarea class="form-control" name="about_us_sub_title">{{$about_us['sub_title']}}</textarea>
                        @error('about_us_sub_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Trusted</label>
                        <input type="number" class="form-control" name="trusted" value="{{$about_us['trusted']}}">
                        @error('trusted')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Description</label>
                        <textarea id="editor1" class="form-control" name="about_description">{{$about_us['description']}}</textarea>
                        @error('about_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Image</label>
                        <p>{{$about_us['about_image']}}</p>
                        <input type="file" class="imageupload" name="about_us_image" data-default-file="{{ asset('admin/image/section/home_about/thumbnail')}}/{{$about_us['about_image']}}">
                        <input type="hidden" value="{{$about_us['about_image']}}" name="old_about_image">
                        @error('about_us_image')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif

    @if($one_section['section_type'] == 'home_testimonial')
    <?php $testimonial = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($testimonial);die();
    ?>
    <div id="">
        <h3>Home Testimonial</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="testimonial_title" value="{{$testimonial['testimonial_title']}}">
                        @error('testimonial_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Sub Title</label>
                        <input type="text" class="form-control" name="testimonial_sub_title" value="{{$testimonial['testimonial_sub_title']}}">
                        @error('testimonial_sub_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Number of testimonial</label>
                        <input type="number" class="form-control" name="testimonial_no" value="{{$testimonial['testimonial_no']}}">
                        @error('testimonial_no')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif

    @if($one_section['section_type'] == 'faq')
    <?php $faq = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($home_faq);die();
    ?>
    <div id="">
        <h3>Faq</h3>
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-2">
                    <label>Faq title</label>
                    <input type="text" class="form-control @error('faq_title') is-invalid @enderror" name="faq_title" value="{{$faq['faq_title']}}">
                    @error('faq_title')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label>Number Of Faq</label>
                    <input type="number" class="form-control @error('number_of_faq') is-invalid @enderror" name="number_of_faq" value="{{$faq['number_of_faq']}}">
                    @error('number_of_faq')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($one_section['section_type'] == 'cinema')
    <?php $cinema = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($home_faq);die();
    ?>
    <div id="">
        <h3>Cinema</h3>
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-2">
                    <label>Cinema title</label>
                    <input type="text" class="form-control @error('cinema_title') is-invalid @enderror" name="cinema_title" 
                    value="{{$cinema['cinema_title']}}">
                    @error('cinema_title')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label>Number Of Cinema</label>
                    <input type="number" class="form-control @error('number_of_cinema') is-invalid @enderror" name="number_of_cinema" 
                    value="{{$cinema['number_of_cinema']}}">
                    @error('number_of_cinema')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($one_section['section_type'] == 'about_our_team')
    <?php 
    $about_our_team = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($about_our_team);die();
    ?>
    <div id="">
        <h3>About Our Team</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="team_title" value="{{$about_our_team['team_title']}}">
                        @error('team_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Team Description</label>
                         <textarea name="team_description" id="editor10" class="form-control">{{$about_our_team['team_description']}}</textarea>
                        
                        @error('team_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    @if(isset($about_our_team['team_image']))
                        <div class="form-group mb-2 team-image">
                            <label>Section image</label>
                            <input type="file" class="imageupload" name="team_photo">
                        </div>

                        <img src="{{ asset('admin/image/section/team/'.$about_our_team['team_image']) }}" alt="" height="150">
                    @endif
                    @if(isset($about_our_team['team_video_url']))
                    <div class="form-group mb-2 team-video">
                        <label>video link</label>
                        <input type="text" class="form-control" name="team_video" value="{{$about_our_team['team_video_url']}}">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($one_section['section_type'] == 'about_equipment')
    <?php 
    $about_equipment = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($about_equipment);die();
    ?>
    <div id="">
        <h3>About Equipment</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="equipment_title" value="{{$about_equipment['equipment_title']}}">
                        @error('equipment_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Sub Title</label>
                        <input type="text" class="form-control" name="equipment_description" value="{{$about_equipment['equipment_description']}}">
                        @error('equipment_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    @if(isset($about_equipment['equipment_photo']))
                        <div class="form-group mb-2 team-image">
                            <label>Section image</label>
                            <input type="file" class="imageupload" name="equipment_photo">
                        </div>
                        <img src="{{ asset('admin/image/section/equipment/'.$about_equipment['equipment_photo']) }}" alt="" height="150">
                    @endif
                    @if(isset($about_equipment['equipment_video']))
                    <div class="form-group mb-2 team-video">
                        <label>video link</label>
                        <input type="text" class="form-control" name="equipment_video" value="{{$about_equipment['equipment_video']}}">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($one_section['section_type'] == 'about_workwith')
    <?php 
    $about_workwith = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($about_workwith);die();
    ?>
    <div id="">
        <h3>About Workwith</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="workwith_title" value="{{$about_workwith['workwith_title']}}">
                        @error('workwith_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Sub Title</label>
                          <textarea name="workwith_description" class="form-control" id="editor2">{!! $about_workwith['workwith_description'] !!}</textarea>
                        <!--<input type="text" class="form-control" name="workwith_description" value="{{$about_workwith['workwith_description']}}">-->
                        @error('workwith_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    @if(isset($about_workwith['workwith_photo']))
                        <div class="form-group mb-2 team-image">
                            <label>Section image</label>
                            <input type="file" class="imageupload" name="workwith_photo">
                        </div>
                        <img src="{{ asset('admin/image/section/workwith/'.$about_workwith['workwith_photo']) }}" alt="" height="150">
                    @endif
                    @if(isset($about_workwith['workwith_video']))
                    <div class="form-group mb-2 team-video">
                        <label>video link</label>
                        <input type="text" class="form-control" name="workwith_video" value="{{$about_workwith['workwith_video']}}">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($one_section['section_type'] == 'contact_us')
    <?php 
    $contact_us = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($contact_us);die();
    ?>
    <div id="">
        <h3>Contact Us</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    @if(isset($contact_us['contactus_photo']))
                        <div class="form-group mb-2 contactus-photo">
                            <label>Section image</label>
                            <input type="file" class="imageupload" name="contactus_photo">
                        </div>
                        <img src="{{ asset('admin/image/section/contactus/'.$contact_us['contactus_photo']) }}" alt="" height="150">
                    @endif
                    @if(isset($contact_us['contactus_video']))
                    <div class="form-group mb-2 contactus-video">
                        <label>video link</label>
                        <input type="text" class="form-control" name="contactus_video" value="{{$contact_us['contactus_video']}}">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($one_section['section_type'] == 'package')
    <?php
    $package = json_decode($one_section['section_value'], true); //echo '<pre>'; print_r($package);die();
    ?>
    <div id="">
        <h3>Contact Us</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Single Day Packages</label>
                        <textarea name="single_day_packages" class="form-control" id="editor2">{!! $package['single_day_packages'] !!}</textarea>
                        @error('single_day_packages')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Multi Day Packages</label>
                        <textarea name="multi_day_packages" class="form-control" id="editor3">{!! $package['multi_day_packages'] !!}</textarea>
                        @error('multi_day_packages')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="text-center">
        <button class="btn btn-primary" type="submit"> Save Section </button>
    </div>
</form>


<script type="text/javascript">
    $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 220,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
    ClassicEditor.create(document.querySelector('#editor1'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor.create(document.querySelector('#editor2'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor.create(document.querySelector('#editor3'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor.create(document.querySelector('#editor4'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor.create(document.querySelector('#editor5'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor.create(document.querySelector('#editor6'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor.create(document.querySelector('#editor7'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor.create(document.querySelector('#editor7'))
    ClassicEditor.create(document.querySelector('#editor8'))
    ClassicEditor.create(document.querySelector('#editor9'))
    ClassicEditor.create(document.querySelector('#editor10'))

    $('#home_about_us').hide();
    $('#skill_id').hide();
    $('#home_faq').hide();
    $('#home_testimonial').hide();
    $('#home_service').hide();
    $('#home_blog').hide();
    $('#home_partner').hide();
    $('#home_current_scholarship').hide();

    $('.selectsections').change(function() {
        $('#banner_home').hide();
        $('#home_about_us').hide();
        $('#skill_id').hide();
        $('#home_faq').hide();
        $('#home_testimonial').hide();
        $('#home_service').hide();
        $('#home_blog').hide();
        $('#home_partner').hide();

        if ($(this).val() == 'banner') {
            $('#new_about_us_news').css('display', 'none');
            $('#new_banner').show();
        } else if ($(this).val() == 'section_calculator') {
            $('#new_about_us_news').css('display', 'none');
            $('#new_banner').hide();
            $('#single_image').show();
        } else if ($(this).val() == 'home_faq') {
            $('#new_about_us_news').css('display', 'none');
            $('#new_banner').hide();
            $('#home_faq').show();
        } else if ($(this).val() == 'home_aboutus') {

            $('#new_about_us_news').css('display', 'block');
            $('#new_banner').hide();

        } else if ($(this).val() == 'skills') {

            $('#new_about_us_news').css('display', 'none');
            $('#new_banner').hide();
            $('#skill_id').show();

        } else if ($(this).val() == 'home_testimonial') {

            $('#new_about_us_news').css('display', 'none');
            $('#new_banner').hide();
            $('#home_testimonial').show();
        } else if ($(this).val() == 'home_service') {
            $('#new_about_us_news').css('display', 'none');
            $('#new_banner').hide();
            $('#home_service').show();
        } else if ($(this).val() == 'home_blog') {
            $('#new_about_us_news').css('display', 'none');
            $('#new_banner').hide();
            $('#home_blog').show();
        } else if ($(this).val() == 'home_partner') {
            $('#new_about_us_news').css('display', 'none');
            $('#new_banner').hide();
            $('#home_partner').show();
        } else if ($(this).val() == 'home_current_scholarship') {
            $('#new_about_us_news').css('display', 'none');
            $('#new_banner').hide();
            $('#home_current_scholarship').show();
        }
    });


    $(".addcontentslider").click(function() {
        $('.contentslider').append('<h4>Slider 1</h4><div class="card"> <div class="card-body"> <div class="form-group mb-2"> <label>Slider Title</label> <input type="text" class="form-control" name=""> </div> <div class="form-group mb-2"> <label>Slider Description</label> <textarea class="form-control"></textarea> </div> <div class="form-group mb-2"> <label>Slider Image</label> <input type="file" class="imageupload" name=""> </div> </div> </div>');
        $('.imageupload').dropify();
    });
    
    $('.imageupload').dropify();

    $(".addbanner").click(function() {
        $('.bannercontent').append('<h4>Banner</h4><div class="card"> <div class="card-body"> <div class="form-group mb-2"> <label>Banner Title</label> <input type="text" class="form-control" name="banner_title[]" required> </div> <div class="form-group mb-2"> <label>Banner Content</label> <textarea class="form-control" name="banner_content[]" placeholder="Description" required></textarea> </div> <div class="form-group mb-2"> <label> Banner Link </label> <input type="text" class="form-control" name="banner_link[]" required> </div> <div class="form-group mb-2"> <label> Banner Image or Video </label> <input type="file" class="imageupload" name="banner_image[]" data-height="200" multiple required/></div><div class="form-group mb-2"><label>Publish Country</label><select class="form-control" name="country[]"><option value="0">All</option><option value="1">Australia</option><option value="2">Bangladesh</option><option value="3">Nepal</option><option value="4">Malaysia</option><option value="5">India</option><option value="6">SriLanka</option><option value="7">Pakistan</option><option value="8">China</option></select></div></div></div>');
        $('.imageupload').dropify();
    });

    $("body").delegate(".removecontentsection", "click", function() {
        $(this).closest('.card').remove();
    });


    $(".addpagesection").click(function() {
        $('.contentsection').append('<div class="card"> <div class="card-body"> <div class="row align-items-end"><div class="col-5"> <div class="form-group"><label>Partner category</label> <select class="form-control" name="partner_category[]" id="" required><option value="">Select Category</option><option value="australia">Australia</option><option value="canada">Canada</option><option value="partner">Professional Year Partners</option><option value="health">Health Insurance</option><option value="accreditation">Professional Accreditation</option><option value="scholarship">PCurrent Scholarships</option></select></div> </div> <div class="col-5"><div class="form-group"><label>Number of partner</label> <input type="number" class="form-control" name="no_of_partner[]" required></div></div><div class="col-2"> <button class="btn btn-danger removecontentsection" type="button"><i class="mdi mdi-trash-can-outline"></i></button> </div> </div> </div> </div>');
    });
    $("body").delegate(".removecontentsection", "click", function() {
        $(this).closest('.card').remove();
    });

    var quill = new Quill("#editor", {
        theme: "snow",
        modules: {
            toolbar: [
                [{
                    font: []
                }, {
                    size: []
                }],
                ["bold", "italic", "underline", "strike"],
                [{
                    color: []
                }, {
                    background: []
                }],
                [{
                    script: "super"
                }, {
                    script: "sub"
                }],
                [{
                    header: [!1, 1, 2, 3, 4, 5, 6]
                }, "blockquote", "code-block"],
                [{
                    list: "ordered"
                }, {
                    list: "bullet"
                }, {
                    indent: "-1"
                }, {
                    indent: "+1"
                }],
                ["direction", {
                    align: []
                }],
                ["link", "image", "video"],
                ["clean"]
            ]
        }
    })

    $('.delete').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var div_id = $(this).attr('delete-id');
        var image_name = $(this).attr('image-name');


        jQuery.ajax({
            type: 'get',
            url: "",
            data: {
                id: id,
                image_name: image_name,
            },
            success: function(data) {
                $('#delete_current' + div_id).remove();
                // location.reload();
            }
        });
    });

    $('.delete_company_image').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var div_id = $(this).attr('delete-id');
        var image_name = $(this).attr('image-name');


        jQuery.ajax({
            type: 'get',
            url: "",
            data: {
                id: id,
                image_name: image_name,
            },
            success: function(data) {
                $('#delete_company' + div_id).remove();
                // location.reload();
            }
        });
    });
</script>
@endsection