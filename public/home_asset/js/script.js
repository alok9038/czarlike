$(document).ready(function () {
    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});


// category

// Glider Configuration
new Glider(document.querySelector(".glider"), {
    slidesToShow: 3,
    slidesToScroll: 1,
    draggable: true,
    dots: ".dots",
    responsive: [
      {
        // If Screen Size More than 768px
        breakpoint: 768,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          duration: 0.5,
          arrows: {
            prev: ".glider-prev",
            next: ".glider-next"
          }
        }
      },
      {
        // If Screen Size More than 1024px
        breakpoint: 1024,
        settings: {
          slidesToShow: 6,
          slidesToScroll: 1,
          duration: 0.5,
          arrows: {
            prev: ".glider-prev",
            next: ".glider-next"
          }
        }
      }
    ]
  });


  // price range filter

  //-----JS for Price Range slider-----
  var lowerSlider = document.querySelector('#lower');
  var  upperSlider = document.querySelector('#upper');
  
  document.querySelector('#two').value=upperSlider.value;
  document.querySelector('#one').value=lowerSlider.value;
  
  var  lowerVal = parseInt(lowerSlider.value);
  var upperVal = parseInt(upperSlider.value);
  
  upperSlider.oninput = function () {
      lowerVal = parseInt(lowerSlider.value);
      upperVal = parseInt(upperSlider.value);
  
      if (upperVal < lowerVal + 4) {
          lowerSlider.value = upperVal - 4;
          if (lowerVal == lowerSlider.min) {
          upperSlider.value = 4;
          }
      }
      document.querySelector('#two').value=this.value
  };
  
  lowerSlider.oninput = function () {
      lowerVal = parseInt(lowerSlider.value);
      upperVal = parseInt(upperSlider.value);
      if (lowerVal > upperVal - 4) {
          upperSlider.value = lowerVal + 4;
          if (upperVal == upperSlider.max) {
              lowerSlider.value = parseInt(upperSlider.max) - 4;
          }
      }
      document.querySelector('#one').value=this.value
  };