(function($) {
  "use strict"; // Start of use strict

  setTimeout(function() {
        $("#hideDiv").fadeOut(2000);
  },2000);

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

  // Profile pic upload
  $("#logo").change(function(){
        var img = document.getElementById('logo');
   
        readIMG(this);
        
        var _URL = window.URL || window.webkitURL;
        var image, logo;
        if ((logo = this.files[0])) {
            image = new Image();
            image.onload = function() {
                var width = this.width;
                var height = this.height;
   
                if(width <= 2000 && height <= 2000){
                    $("#res").html("");
                    $("#pic").prop('disabled',false);
                }else {
                    $("#res").html("Uploaded image exceeds size limit..!!");
                    $("#pic").prop('disabled',true);
                }
            };
            image.src = _URL.createObjectURL(logo);
        }
  });


  $("#pic").prop('disabled',true);
  $("#logo").change(function(){
    var file = $("#logo").val();
    if(file != '')
      $("#pic").prop('disabled',false);
    else $("#pic").prop('disabled',true);
  });
   
  $('[data-toggle="tooltip"]').tooltip();  
  
})(jQuery); // End of use strict


function readIMG(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
             $('#img_upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }else{
         $('#img_upload').attr('src', '<?=base_url();?>assets/student_pics/avatar.jpg');
         $("#res").html("");
    }
   }
