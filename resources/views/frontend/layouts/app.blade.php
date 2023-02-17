<!DOCTYPE html>
<head class="wide wow-animation" lang="en">
<!-- Site Title-->
@if(isset($keyword))   
        @if(isset($keyword->title))
        <title>{{$keyword->title}}</title>
        <meta name="description" content="{{$keyword->description}}"/>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        @else
        <title>{{$keyword->meta_title}}</title>
        <meta name="description" content="{{$keyword->meta_description}}"/>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{$keyword->meta_title}}" />
        <meta property="og:description" content="{{$keyword->meta_description}}" /> 
        <meta property="og:image" content="{{ route('home') }}/{{ str_replace( ' ', '%20', $keyword->featured_image) }}" />
        <meta property="og:image:width" content="1000" />
        <meta property="og:image:height" content="1000" />
        @endif
        @if(isset($keyword->keyword))
        <meta property="og:title" content="{{$keyword->keyword}}" />
        @else
        <meta property="og:title" content="{{$keyword->meta_tag}}" />
        @endif
        @if(isset($keyword->description))
        <meta property="og:description" content="{{$keyword->description}}" />
        @else
        <meta property="og:description" content="{{$keyword->meta_description}}" />
        @endif
        @if(isset($keyword->keyword))
        <meta name="twitter:title" content="{{$keyword->keyword}}" />
        @else
        <meta name="twitter:title" content="{{$keyword->meta_tag}}" />
        @endif
    @else
    <title>LNXX - An online financial services platform for UAE's citizens.</title>

@endif
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<meta name="csrf-token" content="{!! csrf_token() !!}" />
<link rel="icon" href="{!! asset('assets/frontend/images/favicon.png') !!}" type="image/png">
<meta name="csrf-token" content="{{ csrf_token() }}" />     
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inria+Sans:wght@300;400;700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,500;1,700&display=swap" rel="stylesheet">

<script src="https://kit.fontawesome.com/956568d106.js" crossorigin="anonymous"></script>
{!! Html::style('assets/frontend/css/stellarnav.min.css') !!}

<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />
{!! HTML::style('assets/frontend/css/jquery-ui.css') !!}
{!! HTML::style('assets/frontend/css/owl.carousel.min.css') !!}
{!! HTML::style('assets/frontend/css/owl.theme.default.min.css') !!}
{!! HTML::style('assets/frontend/css/jquery.fancybox.min.css') !!}
{!! HTML::style('assets/frontend/css/bootstrap-datepicker.css') !!}
{!! HTML::style('assets/frontend/fonts/flaticon/font/flaticon.css') !!}
<!-- {!! HTML::style('assets/frontend/css/bootstrap.min1.css') !!} -->
{!! HTML::style('assets/frontend/css/style.css') !!}
<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
@yield('css')
</head>
<body class="content-pages">
  <a id="button2"></a>
    <!-- Page-->
        <!-- Header -->
@php
    $route  = \Route::currentRouteName();    
@endphp
    @if($route == 'get-started')    
        @include('frontend.layouts.header') 
    @else 
    @if($route != 'sign_up' && $route != 'register-email' && $route != 'email-otp' && $route != 'enter-name' && $route != 'sign-in' && $route != 'enter-login-otp' && $route != 'upload-emirates-id' && $route != 'upload-profile-image' && $route != 'emirates-id-verification' && $route != 'verify-emirates-id' && $route != 'congratulations' && $route != 'thank-you')
        @include('frontend.layouts.header_main')
    @endif    
    @endif
        <!-- Main Content -->
        @yield('content')
        @if($route != 'sign_up' && $route != 'register-email' && $route != 'email-otp' && $route != 'enter-name' && $route != 'sign-in' && $route != 'enter-login-otp' && $route != 'upload-emirates-id' && $route != 'upload-profile-image' && $route != 'emirates-id-verification' && $route != 'verify-emirates-id' && $route != 'congratulations' && $route != 'thank-you')
        @include('frontend.layouts.footer') 
        @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @if($route != 'record-video')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    @endif

      
@if($route != 'record-video')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script>
    $(function() {
        $( "#my_date_picker" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            minDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
    });

    $(function() {
        $( "#emirates_expire_date" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            minDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
    });
    

    $(function() {
        var maxBirthdayDate = new Date();
        maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 18 );
        $( "#my_date_picker_dob" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            dateFormat: 'dd/mm/yy', 
            maxDate: maxBirthdayDate,
            changeYear: true
        });
    });

    $(function() {
        var maxBirthdayDate = new Date();
        maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 18 );
        $( "#spouse_date_of_birth" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            dateFormat: 'dd/mm/yy', 
            maxDate: maxBirthdayDate,
            changeYear: true
        });
    });

    $(function() {
        $( "#aecb_date" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            maxDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
    });

    $(function() {
        $( "#date_of_joining" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            maxDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
    });

    $(function() {
        $( ".member_joining" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            maxDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
    });

    $(function() {
        $( "#credit_member_since" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            maxDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
    });
    



</script>

<script type="text/javascript">       
    var btn = $('#button2');

    $(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
      //alert('here');
      btn.addClass('show');
    } else {
        btn.removeClass('show');
            // alert('here 1');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });

</script>  
 @endif
@if($route != 'record-video')
        {!! Html::script('assets/frontend/js/jquery-ui.js') !!}
        {!! Html::script('assets/frontend/js/popper.min.js') !!}
        {!! Html::script('assets/frontend/js/owl.carousel.min.js') !!}

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
    $('#table').dataTable();
    } );
</script>

<script type="text/javascript">

const counters = document.querySelectorAll('.counters');
counters.forEach(counter => {
  let count = 0;
  const updateCounter = () => {
    const countTarget = parseInt(counter.getAttribute('data-counttarget'));
    count++;
    if (count < countTarget) {
      counter.innerHTML = count;
      setTimeout(updateCounter, 1);
    } else {
      counter.innerHTML = countTarget;
    }
  };
  updateCounter();
});

$('.testimonials-slider').owlCarousel({
    autoplay: true,
    smartSpeed: 900,
    loop: true,
    margin: 20,
    nav: true,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: false,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:2,
            nav: false
        },
        768:{
            items:3,
            nav: false
        },
        992:{
            items:3,
        },
        1200:{
            items:3
           
        }
    }
});

$('.main-slider').owlCarousel({
    autoplay: true,
    smartSpeed: 900,
    loop: true,
    margin: 20,
    nav: false,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: true,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:1,
            nav: false
        },
        768:{
            items:1,
            nav: false
        },
        992:{
            items:1,
        },
        1200:{
            items:1
           
        }
    }
});

$('.product-slider').owlCarousel({
    autoplay: true,
    smartSpeed: 900,
    loop: false,
    margin: 20,
    nav: false,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: true,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:2,
            nav: false
        },
        768:{
            items:3,
            nav: false
        },
        992:{
            items:3,
        },
        1200:{
            items:4
           
        }
    }
});

$('.blog-slider').owlCarousel({
    autoplay: true,
    smartSpeed: 900,
    loop: true,
    margin: 20,
    nav: false,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: true,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:2,
            nav: false
        },
        768:{
            items:3,
            nav: false
        },
        992:{
            items:3,
        },
        1200:{
            items:4
           
        }
    }
});

$('.blog-slider-ser').owlCarousel({
    autoplay: false,
    smartSpeed: 900,
    loop: true,
    margin: 20,
    nav: false,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: true,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:2,
            nav: false
        },
        768:{
            items:3,
            nav: false
        },
        992:{
            items:3,
        },
        1200:{
            items:3
           
        }
    }
});

$('#salaried').click(function(){
    $('#cm_type').val('1');
    document.getElementById("salaried").classList.add("active");
    document.getElementById("other_employed").classList.remove("active");
    document.getElementById("self_employed").classList.remove("active");
});

$('#self_employed').click(function(){
    $('#cm_type').val('2');
    document.getElementById("self_employed").classList.add("active");
    document.getElementById("other_employed").classList.remove("active");
    document.getElementById("salaried").classList.remove("active");
});

$('#other_employed').click(function(){
    $('#cm_type').val('3');
    document.getElementById("other_employed").classList.add("active");
    document.getElementById("self_employed").classList.remove("active");
    document.getElementById("salaried").classList.remove("active");
});

$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

</script>
@endif
@if($route == 'my-profile')
<script type="text/javascript">
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
} 
</script>
@endif
@if($route == 'upload-profile-image')
{!! Html::script('assets/frontend/js/webcam.js') !!}
<script type="text/javascript">
    
Webcam.set({ 
    width: 300, 
    height: 300, 
    image_format: 'jpeg', 
    jpeg_quality: 90 
}); 


Webcam.attach( '#my_camera' ); 
//     setInterval(function take_snapshot() { 
        
//         Webcam.snap( function(data_uri) { 
//             $(".image-tag").val(data_uri); 
//             document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>'; 
//     } ); 
// },10000);

     function take_snapshot() {
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                $('.btn').removeAttr('disabled');
                document.getElementById('results').innerHTML = '<div style="font-weight: 500; margin-bottom: 8px;">Captured photo</div><img src="'+data_uri+'" width = "300px" height= "300px" style="border:1px solid #333;"/>';
            } );
        }

</script>
<script type="text/javascript">
// imgInp.onchange = evt => {
//   const [file] = imgInp.files
//   if (file) {
//     blah.src = URL.createObjectURL(file)
//   }
// } 
</script>
@endif

@if($route == 'upload-emirates-id')
<script type="text/javascript">
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
} 
</script>
<script type="text/javascript">
imgInp1.onchange = evt => {
  const [file] = imgInp1.files
  if (file) {
    blah1.src = URL.createObjectURL(file)
  }
} 
</script>
@endif

@if($route == 'personal-details')
<script type="text/javascript">
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
} 

imgInp1.onchange = evt => {
  const [file] = imgInp1.files
  if (file) {
    blah1.src = URL.createObjectURL(file)
  }
} 

imgInp2.onchange = evt => {
  const [file] = imgInp2.files
  if (file) {
    blah2.src = URL.createObjectURL(file)
  }
} 

</script>
@endif

<script type="text/javascript">
function yesnoCheckEmployer(that) {
    if (that.value == "2") {
        $(".employer_name").show();
    } 
    else {
        $(".employer_name").hide();
    }
}

$('input[name=otp_code]').on('keyup' , function() { 
    var email = $("input[name=email]").val();
    var email_otp = $("input[name=otp_code]").val();
    if( email_otp.length == 6 ) {
        $.ajax({
            type: "GET",
            url: "{{ route('email-otp-match') }}",
            data: {'otp' : email_otp, 'email' : email },  
            success: function(data){
                if(data.status == 'Fail'){
                    $(".not_verify").html('Invalid OTP');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('');
                    $(".errors_otp").html('');
                    $(".otp_email").html('');
                } else{
                    $(".not_verify").html('');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('OTP verify');
                    $(".errors_otp").html('');
                    $(".otp_email").html('');
                }
            }
        });
    } else {
        $(".not_verify").html('');
        $(".otp_verify").html('');
    }
}); 

$('input[name=eid_number]').on('keyup' , function() { 
    var id = $("input[name=eid_number]").val();
    if( id.length == 15 ) {
        $(".sh_emid").show();
        $(".hide_text").hide();
    } else {
        $(".sh_emid").hide();
        $(".hide_text").show(); 
    }
});
    

$('input[name=credit_score]').on('keyup' , function() { 
    var id = $("input[name=credit_score]").val();
    if( id.length == 0 ) {
        $(".aecb_date").hide();
    } else {
        $(".aecb_date").show();
    }
    
});


$('input[name=login_otp]').on('keyup' , function() { 
    var id = $("input[name=id]").val();
    var login_otp = $("input[name=login_otp]").val();
    if( login_otp.length == 6 ) {
        $.ajax({
            type: "GET",
            url: "{{ route('login-otp-match') }}",
            data: {'otp' : login_otp, 'id' : id },  
            success: function(data){
                if(data.status == 'Fail'){
                    $(".not_verify").html('Invalid OTP');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('');
                    $(".errors_otp").html('');
                    $(".otp_email").html('');
                } else{
                    $(".not_verify").html('');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('OTP verify');
                    $(".errors_otp").html('');
                    $(".otp_email").html('');
                }
            }
        });
    } else {
        $(".not_verify").html('');
        $(".otp_verify").html('');
    }
}); 

$('input[name=mobile]').on('keyup' , function() { 
    var mobile = $("input[name=mobile]").val();
    if( mobile.length == 9 ) {
        $.ajax({
            type: "GET",
            url: "{{ route('otp-sent') }}",
            data: {'mobile' : mobile},
            success: function(data){
                if(data.status == 'Fail'){
                    $(".already_exist").html('Mobile no. is already exist');
                    $(".valid_no").html('');
                    $(".otp").val('');
                    $(".otp_sent").html('');
                } else{
                   // $(".otp_sent").html('OTP sent successfully');
                    $(".valid_no").html('');
                    $(".already_exist").html('');
                    $(".sent_otp").show(); 
                    $('#elementID').hide();
                    $('.verify_otp').hide();
                }
            }
        });
    } else {
        $(".valid_no").html('Enter a valid mobile number');
        $(".otp").val('');
        $(".already_exist").html('');
        $(".otp_sent").html('');
    }
}); 

$('input[name=email]').on('keyup' , function() { 
    var email = $("input[name=email]").val();
        $.ajax({
            type: "GET",
            url: "{{ route('email-check') }}",
            data: {'email' : email},
            success: function(data){
                if(data.status == 'Fail'){
                    $(".already_exist").html('Email id already registered');
                    $(".valid_no").html('');
                } else{
                    $(".already_exist").html('');
                    $(".valid_no").html('');
                }
            }
        }); 
}); 


$('input[name=otp123]').on('keyup' , function() { 
    var otp = $("input[name=otp]").val();
    var mobile = $("input[name=mobile]").val();
    if( otp.length == 6 ) {
        $.ajax({
            type: "GET",
            url: "{{ route('otp-match') }}",
            data: {'otp' : otp, 'mobile' : mobile },  
            success: function(data){
                if(data.status == 'Fail'){
                    $(".not_verify").html('Invalid OTP');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('');
                    $(".errors_otp").html('');
                } else{
                    $(".not_verify").html('');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('OTP verify');
                    $(".errors_otp").html('');
                }
            }
        });
    } else {
        $(".not_verify").html('');
        $(".otp_verify").html('');
    }
}); 


function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

</script>

@if($route == 'product-requested')
<script type="text/javascript">
$(".credit_card1_open").click(function(){
  $(".credit_card1").show();
  $(".credit_card1_open").hide();
});
$(".credit_card2_open").click(function(){
  $(".credit_card2").show();
  $(".credit_card2_open").hide();
});
$(".credit_card3_open").click(function(){
  $(".credit_card3").show();
  $(".credit_card3_open").hide();
});
$(".loan_bus2_open").click(function(){
  $(".bus_lon2").show();
  $(".loan_bus2_open").hide();
});
$(".loan_bus3_open").click(function(){
  $(".bus_lon3").show();
  $(".loan_bus3_open").hide();
});
$(".loan_bus4_open").click(function(){
  $(".bus_lon4").show();
  $(".loan_bus4_open").hide();
});
$(".loan_busin2_open").click(function(){
  $(".loan_busin2").show();
  $(".loan_busin2_open").hide();
});
$(".loan_busin3_open").click(function(){
  $(".loan_busin3").show();
  $(".loan_busin3_open").hide();
});
$(".loan_busin4_open").click(function(){
  $(".loan_busin4").show();
  $(".loan_busin4_open").hide();
});
$(".mortgage_loan2_open").click(function(){
  $(".mortgage_loan2").show();
  $(".mortgage_loan2_open").hide();
});
$(".mortgage_loan3_open").click(function(){
  $(".mortgage_loan3").show();
  $(".mortgage_loan3_open").hide();
});
$(".mortgage_loan4_open").click(function(){
  $(".mortgage_loan4").show();
  $(".mortgage_loan4_open").hide();
});

</script>
@endif
@if($route == 'record-video')
<script>
(function(i, s, o, g, r, a, m) {
i['GoogleAnalyticsObject']=r; i[r]=i[r]||function() {
  (i[r].q=i[r].q||[]).push(arguments);
}, i[r].l=1*new Date(); a=s.createElement(o),
  m=s.getElementsByTagName(o)[0]; a.async=1; a.src=g; m.parentNode.insertBefore(a, m);
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-48530561-1', 'auto');
ga('send', 'pageview');
</script>
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="{{asset('assets/frontend/js/video.js')}}"></script>

@endif

@if($route == 'personal-loan-information')
<script type="text/javascript">
$(document).ready(function(){

      fetch_product_data2();
      function fetch_product_data2(query = '') {
      $.ajax({
       url:"{{ route('live_product_2') }}",
       method:'GET',
       data:{query:query},
       dataType:'json',
       success:function(data) {
        $('#live_product_2').html(data.table_data);
       }
      })
     }

     $(document).on('keyup', '.live_product_2', function(){
      $("#live_product_2").show();    
      var query = $(this).val();
      fetch_product_data2(query);
     });
    });

    function getProduct_Code_2(val) {
        $.ajax({
            type: "GET",
            url: "{{ route('check_product_code2') }}",
            data: {'code' : val},
            success: function(data){
                if(data.status == 'Fail'){
                } else{
                    $(".product_id").val(data.product_id);
                    $(".product_name2").val(data.product_name);
                }
                $("#live_product_2").hide();   
            }
        });
    }
</script>
@endif

@if($route == 'cm-details')
<script type="text/javascript">
    $(document).ready(function(){

      fetch_product_data1();
      function fetch_product_data1(query = '') {
      $.ajax({
       url:"{{ route('live_product_1') }}",
       method:'GET',
       data:{query:query},
       dataType:'json',
       success:function(data) {
        $('#live_product_1').html(data.table_data);
       }
      })
     }

     $(document).on('keyup', '.live_product_1', function(){
      $("#live_product_1").show();    
      var query = $(this).val();
      fetch_product_data1(query);
     });
    });


    function getProduct_Code_1(val) {
        $.ajax({
            type: "GET",
            url: "{{ route('check_product_code') }}",
            data: {'code' : val},
            success: function(data){
                if(data.status == 'Fail'){
                } else{
                    $(".product_id").val(data.product_id);
                    $(".product_name").val(data.product_name);
                }
                $("#live_product_1").hide();   
            }
        });

    }
    
    $(".form-rel").mouseenter(function(){
    $("#live_product_1").slideDown();
    }).mouseleave(function(){
        $("#live_product_1").slideUp();
    });


    $(document).ready(function(){

      fetch_product_data2();
      function fetch_product_data2(query = '') {
      $.ajax({
       url:"{{ route('live_product_2') }}",
       method:'GET',
       data:{query:query},
       dataType:'json',
       success:function(data) {
        $('#live_product_2').html(data.table_data);
       }
      })
     }

     $(document).on('keyup', '.live_product_2', function(){
      $("#live_product_2").show();    
      var query = $(this).val();
      fetch_product_data2(query);
     });
    });

    function getProduct_Code_2(val) {
        $.ajax({
            type: "GET",
            url: "{{ route('check_product_code2') }}",
            data: {'code' : val},
            success: function(data){
                if(data.status == 'Fail'){
                } else{
                    $(".product_id").val(data.product_id);
                    $(".product_name2").val(data.product_name);
                }
                $("#live_product_2").hide();   
            }
        });
    }
    
    $(".form-rel2").mouseenter(function(){
    $("#live_product_2").slideDown();
    }).mouseleave(function(){
        $("#live_product_2").slideUp();
    });

</script>
@endif

@if(session()->has('already_refer_friend'))
<script type="text/javascript">
    $('#exampleModal').modal('show');
</script>
@endif
@if(session()->has('refer_friend'))
<script type="text/javascript">
    $('#exampleModal').modal('show');
</script>
@endif

<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<script type="text/javascript">

var firebaseConfig = {
  apiKey: "AIzaSyAId-eClnqk-cjkGV5fYsDLbiGWl917jvA",
  authDomain: "lnxx-ce1d9.firebaseapp.com",
  databaseURL: "https://lnxx-ce1d9-default-rtdb.firebaseio.com",
  projectId: "lnxx-ce1d9",
  storageBucket: "lnxx-ce1d9.appspot.com",
  messagingSenderId: "379200459861",
  appId: "1:379200459861:web:63d87def3fc0f969a230dc",
  measurementId: "G-8CVESVEF66"
}

firebase.initializeApp(firebaseConfig);

</script>

<script type="text/javascript">
     
   window.onload = function(){
       render();
    }

   function render(){
       window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptha-container');
       recaptchaVerifier.render();
   }

    function sendCode(){
        let number = '+971';
        number += $('#phone').val();
        // var number = number2.concat(number1);
        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult){

            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;

            $('#sentMessage').text('OTP sent successfully!');
            $('#sentMessage').show();
            $('.otp_field').show();
            $('.verify_otp').show();
            
            $('#recaptha-container').hide();
            $('.sent_otp').hide();
            
        }).catch(function(error){
           $('#error').text(error.message);
           $('#error').show();
        });
    }

    function verifyCode(){
        var code = $('#number-otp').val();
        coderesult.confirm(code).then(function(result){
        var user = result.user;

        $('#sucessMessage').text('OTP verify successfully!');
        $('#sucessMessage').show();
        $('#elementID').show();
        $('#elementID').removeAttr('disabled');
        $('.verify_otp').hide();
        $('#sentMessage').hide();
        $("#verify").val("1");
        }).catch(function(error){
            $('#error').text(error.message);
            $('#error').show();
        });

    }

</script>

</body>
</html>
