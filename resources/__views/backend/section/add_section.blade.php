@extends('backend.layouts.app')
@section('title', 'Add Section')
@section('content')
<style>
    #banner_home,
    #single_image,
    #testmonilalist,
    #partnerlist,
    #contentdescription,
    #content_slider,
    #bloglist,
    #servicelist {
        display: none;
    }
</style>

<form action="{{route('backend.save-section')}}" id="addsection" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-2">
                        <label>Section Name</label>
                        <input type="text" class="form-control @error('section_name') is-invalid @enderror" name="section_name" value="{{old('section_name')}}">
                        @error('section_name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Section type </label>
                        <select name="section_type" class="form-control selectsections">
                            <option value="">Select type</option>
                            <option value="banner">Banner</option>
                            <option value="addon">Add on</option>
                            <option value="section_message">Section Message</option>
                            <option value="faq">FAQ</option>
                            <option value="cinema">Cinema</option>
                            <option value="package">Package</option>
                            <option value="home_testimonial">Home Testimonial</option>
                            <option value="about_our_team">About Our Team</option>
                            <option value="about_equipment">About Equipment</option>
                            <option value="about_workwith">About Work With</option>
                            <option value="contact_us">Contact Us</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- banner start -->
    <div id="banner_home">
        <h3>Add banner</h3>
        <div class="bannercontent">

        </div>
        <div class="addbanner"><i class="mdi mdi-plus"></i> </div>
    </div>

    <div id="addon_home">
        <h3>Add On</h3>
        <div class="addoncontent">
            <div class="contentslider">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label>Addon Hedding</label>
                            <input type="text" class="form-control" name="addon_hedding">
                            @error('addon_hedding')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Addon Description</label>
                            <textarea name="addon_description" id="editor9" class="form-control"></textarea>
                            @error('addon_description')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Addon video link</label>
                            <input type="text" class="form-control" name="addon_link">
                            @error('section_link')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content slider start-->
    <div id="home_about_us">
        <h3>Home About Us</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Title</label> <input type="text" class="form-control" name="about_us_title">
                        @error('about_us_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Sub Title</label>
                        <textarea class="form-control" name="about_us_sub_title"></textarea>
                        @error('about_us_sub_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Trusted</label>
                        <input type="number" class="form-control" name="trusted">
                        @error('trusted')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Description</label>
                        <textarea id="editor1" class="form-control" name="about_description"></textarea>
                        @error('about_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Image</label> <input type="file" class="imageupload" name="about_us_image">
                        @error('about_us_image')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills Start -->
    <div id="skill_id">
        <h3>Skill Set</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Student</label>
                        <input type="number" class="form-control" name="student">
                        @error('student')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Global Office</label>
                        <input type="number" class="form-control" name="global_office">
                        @error('global_office')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Visa</label>
                        <input type="number" class="form-control" name="visa">
                        @error('visa')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Scholarship</label>
                        <input type="number" class="form-control" name="scholarship">
                        @error('scholarship')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Skills End -->

    <!-- banner start -->
    <div id="faq">
        <h3>Faq</h3>
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-2">
                    <label>Faq title</label>
                    <input type="text" class="form-control @error('faq_title') is-invalid @enderror" name="faq_title">
                    @error('faq_title')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label>Number Of Faq</label>
                    <input type="number" class="form-control @error('number_of_faq') is-invalid @enderror" name="number_of_faq">
                    @error('number_of_faq')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>

        <!-- <div class="addbanner"><i class="mdi mdi-plus"></i> </div> -->
    </div>
    <!-- banner end -->
    <!-- Cinema start -->
    <div id="cinema">
        <h3>Cinema</h3>
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-2">
                    <label>Cinema title</label>
                    <input type="text" class="form-control @error('cinema_title') is-invalid @enderror" name="cinema_title">
                    @error('cinema_title')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label>Number Of Cinema</label>
                    <input type="number" class="form-control @error('number_of_cinema') is-invalid @enderror" name="number_of_cinema">
                    @error('number_of_cinema')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <!-- Cinema End -->
    <!-- Cinema start -->
    <div id="package">
        <h3>Package</h3>
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-2">
                    <label>Single Day Packages</label>
                    <textarea name="single_day_packages" class="form-control" id="editor2"></textarea>
                    @error('single_day_packages')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label>Multi Day Packages</label>
                    <textarea name="multi_day_packages" class="form-control" id="editor3"></textarea>
                    @error('multi_day_packages')
                    <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Home testimonial Start -->
    <div id="home_testimonial">
        <h3>Home Testimonial</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="testimonial_title">
                        @error('testimonial_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Sub Title</label>
                        <input type="text" class="form-control" name="testimonial_sub_title">
                        @error('testimonial_sub_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Number of testimonial</label>
                        <input type="number" class="form-control" name="testimonial_no">
                        @error('testimonial_no')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Home testimonial End -->

    <!-- Section message Start -->
    <div id="section_message">
        <h3>Section Message</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Section Name</label>
                        <input type="text" class="form-control" name="section_message_name">
                        @error('section_message_name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>section Description</label>
                        <textarea name="section_description" id="editor4" class="form-control"></textarea>
                        @error('section_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Section video link</label>
                        <input type="text" class="form-control" name="section_link">
                        @error('section_link')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about Section message End -->

    <!-- About Our Team Start -->
    <div id="about_our_team">
        <h3>About Our Team</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">

                    <div class="form-group mb-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="team_title">
                        @error('team_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Description</label>
                        <textarea name="team_description" id="editor5" class="form-control"></textarea>
                        @error('team_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Select Option</label>
                        <select name="team_select_option" id="choiceItem" class="form-control">
                            <option value="1">Photo</option>
                            <option value="2">Video</option>
                        </select>
                        @error('team_select_option')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2 team-image d-none">
                        <label>Section image</label>
                        <input type="file" class="imageupload" name="team_photo">
                    </div>

                    <div class="form-group mb-2 team-video d-none">
                        <label>video link</label>
                        <input type="text" class="form-control" name="team_video">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="about_equipment">
        <h3>About Equipment</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">

                    <div class="form-group mb-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="equipment_title">
                        @error('equipment_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Description</label>
                        <textarea name="equipment_description" id="editor6" class="form-control"></textarea>
                        @error('equipment_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Select Option</label>
                        <select name="equipment_select_option" id="equipmentItem" class="form-control">
                            <option value="1">Photo</option>
                            <option value="2">Video</option>
                        </select>
                        @error('equipment_select_option')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2 equipment-item d-none">
                        <label>Section image</label>
                        <input type="file" class="imageupload" name="equipment_photo">
                    </div>

                    <div class="form-group mb-2 equipment-video d-none">
                        <label>video link</label>
                        <input type="text" class="form-control" name="equipment_video">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="about_workwith">
        <h3>About Work With</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="workwith_title">
                        @error('workwith_title')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Description</label>
                        <textarea name="workwith_description" id="editor7" class="form-control"></textarea>
                        @error('workwith_description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Select Option</label>
                        <select name="workwith_select_option" id="workwithItem" class="form-control">
                            <option value="1">Photo</option>
                            <option value="2">Video</option>
                        </select>
                        @error('workwith_select_option')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2 workwith-item d-none">
                        <label>Section image</label>
                        <input type="file" class="imageupload" name="workwith_photo">
                    </div>

                    <div class="form-group mb-2 workwith-video d-none">
                        <label>video link</label>
                        <input type="text" class="form-control" name="workwith_video">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="contact_us">
        <h3>Contact Us</h3>
        <div class="contentslider">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label>Select Option</label>
                        <select name="contactus_select_option" id="contactusItem" class="form-control">
                            <option value="1">Photo</option>
                            <option value="2">Video</option>
                        </select>
                        @error('contactus_select_option')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group mb-2 contactus-item d-none">
                        <label>Section image</label>
                        <input type="file" class="imageupload" name="contactus_photo">
                    </div>

                    <div class="form-group mb-2 contactus-video d-none">
                        <label>Video link</label>
                        <input type="text" class="form-control" name="contactus_video">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit"> Save Section </button>
    </div>
</form>


<script type="text/javascript">
    $(function() {
        let item = 1;
        if (item == 1) {
            $('.team-image').removeClass('d-none');
            $('.team-video').addClass('d-none');
        } else {
            $('.team-video').removeClass('d-none');
            $('.team-image').addClass('d-none');
        }
    })

    $('#choiceItem').on("change", function() {
        let item = $(this).val();
        if (item == 1) {
            $('.team-image').removeClass('d-none');
            $('.team-video').addClass('d-none');
        } else {
            $('.team-video').removeClass('d-none');
            $('.team-image').addClass('d-none');
        }
    })
    $('#equipmentItem').on("change", function() {
        let item = $(this).val();
        if (item == 1) {
            $('.equipment-item').removeClass('d-none');
            $('.equipment-video').addClass('d-none');
        } else {
            $('.equipment-video').removeClass('d-none');
            $('.equipment-item').addClass('d-none');
        }
    })
    $('#workwithItem').on("change", function() {
        let item = $(this).val();
        if (item == 1) {
            $('.workwith-item').removeClass('d-none');
            $('.workwith-video').addClass('d-none');
        } else {
            $('.workwith-video').removeClass('d-none');
            $('.workwith-item').addClass('d-none');
        }
    })
    $('#contactusItem').on("change", function() {
        let item = $(this).val();
        if (item == 1) {
            $('.contactus-item').removeClass('d-none');
            $('.contactus-video').addClass('d-none');
        } else {
            $('.contactus-video').removeClass('d-none');
            $('.contactus-item').addClass('d-none');
        }
    })

    $('.imageupload').dropify();

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
    ClassicEditor.create(document.querySelector('#editor8'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor.create(document.querySelector('#editor9'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px';
        })
        .catch(error => {
            console.error(error);
        });

    //Home
    $('#home_about_us').hide();
    $('#skill_id').hide();
    $('#faq').hide();
    $('#cinema').hide();
    $('#package').hide();

    $('#home_testimonial').hide();
    $('#home_service').hide();
    $('#home_blog').hide();
    $('#home_partner').hide();
    $('#home_current_scholarship').hide();
    $('#carrer_section').hide();
    $('#franchise_section').hide();
    $('#scholarship_section').hide();

    //About Us
    $('#about_the_company').hide();
    $('#about_director_message').hide();
    $('#about_our_team').hide();
    $('#about_vision').hide();
    $('#section_message').hide();
    $('#about_equipment').hide();
    $('#about_workwith').hide();

    //Contact Us
    $('#contact_us').hide();
    // addon
    $('#addon_home').hide();

    $('.selectsections').change(function() {
        //Home
        $('#addon_home').hide();
        $('#banner_home').hide();
        $('#home_about_us').hide();
        $('#skill_id').hide();
        $('#faq').hide();
        $('#cinema').hide();
        $('#package').hide();
        $('#home_testimonial').hide();
        $('#home_service').hide();
        $('#home_blog').hide();
        $('#home_partner').hide();
        $('#home_partner').hide();
        $('#franchise_section').hide();
        $('#scholarship_section').hide();
        $('#section_message').hide();
        //About Us
        $('#about_the_company').hide();
        $('#about_director_message').hide();
        $('#about_our_team').hide();
        $('#about_vision').hide();
        $('#about_equipment').hide();

        //Contact Us
        $('#contact_us').hide();

        if ($(this).val() == 'banner') {
            $('#banner_home').show();
        } else if ($(this).val() == 'addon') {
            $('#addon_home').show();
        } else if ($(this).val() == 'section_calculator') {
            $('#single_image').show();
        } else if ($(this).val() == 'faq') {
            $('#faq').show();
        } else if ($(this).val() == 'cinema') {
            $('#cinema').show();
        } else if ($(this).val() == 'package') {
            // $('#cinema').show();  
            $('#package').show();
        } else if ($(this).val() == 'section_message') {
            $('#section_message').show();
        } else if ($(this).val() == 'home_aboutus') {
            $('#home_about_us').show();
        } else if ($(this).val() == 'skills') {
            $('#skill_id').show();
        } else if ($(this).val() == 'home_testimonial') {
            $('#home_testimonial').show();
        } else if ($(this).val() == 'home_service') {
            $('#home_service').show();
        } else if ($(this).val() == 'home_blog') {
            $('#home_blog').show();
        } else if ($(this).val() == 'home_partner') {
            $('#home_partner').show();
        } else if ($(this).val() == 'home_current_scholarship') {
            $('#home_current_scholarship').show();
        } else if ($(this).val() == 'about_the_company') {
            $('#about_the_company').show();
        } else if ($(this).val() == 'about_director_message') {
            $('#about_director_message').show();
        } else if ($(this).val() == 'about_our_team') {
            $('#about_our_team').show();
        } else if ($(this).val() == 'about_vision') {
            $('#about_vision').show();
        } else if ($(this).val() == 'carrer_section') {
            $('#carrer_section').show();
        } else if ($(this).val() == 'franchise_section') {
            $('#franchise_section').show();
        } else if ($(this).val() == 'scholarship_section') {
            $('#scholarship_section').show();
        } else if ($(this).val() == 'about_equipment') {
            $('#about_equipment').show();
        } else if ($(this).val() == 'about_workwith') {
            $('#about_workwith').show();
        } else if ($(this).val() == 'contact_us') {
            $('#contact_us').show();
        }
    });


    $(".addcontentslider").click(function() {
        $('.contentslider').append('<h4>Slider 1</h4><div class="card"> <div class="card-body"> <div class="form-group mb-2"> <label>Slider Title</label> <input type="text" class="form-control" name=""> </div> <div class="form-group mb-2"> <label>Slider Description</label> <textarea class="form-control"></textarea> </div> <div class="form-group mb-2"> <label>Slider Image</label> <input type="file" class="imageupload" name=""> </div> </div> </div>');
        $('.imageupload').dropify();
    });

    $(".addbanner").click(function() {
        $('.bannercontent').append('<h4>Banner</h4><div class="card"> <div class="card-body"> <div class="form-group mb-2"> <label>Banner Title</label> <input type="text" class="form-control" name="banner_title[]" required> </div> <div class="form-group mb-2"> <label>Banner Content</label> <textarea class="form-control" name="banner_content[]" placeholder="Description" required></textarea> </div> <div class="form-group mb-2"> <label> Banner Video Link </label> <input type="type" class="form-control" name="banner_link[]" required/></div></div></div>');
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
</script>
@endsection