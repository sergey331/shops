    // Simple tab switching functionality
    // document.querySelectorAll('[data-tab-target]').forEach(tab => {
    //   tab.addEventListener('click', () => {
    //     const target = document.querySelector(tab.dataset.tabTarget);
    //     document.querySelectorAll('.tab-pane').forEach(pane => {
    //       pane.classList.add('hidden');
    //       pane.classList.remove('active');
    //     });
    //     document.querySelectorAll('.nav-link').forEach(link => {
    //       link.classList.remove('text-blue-600', 'border-blue-600');
    //     });
    //     target.classList.remove('hidden');
    //     target.classList.add('active');
    //     tab.classList.add('text-blue-600', 'border-blue-600');
    //   });
    // });

// Corrected Tab Switching Script
document.querySelectorAll('[data-tab-target]').forEach(tab => {
  tab.addEventListener('click', () => {
    const target = document.querySelector(tab.dataset.tabTarget);

    // Hide all tab panes
    document.querySelectorAll('.tab-pane').forEach(pane => {
      pane.classList.add('hidden');
      pane.classList.remove('active');
    });

    // Remove active styles from all tabs
    document.querySelectorAll('.nav-link').forEach(link => {
      link.classList.remove('text-primary', 'border-primary');
      link.classList.add('text-gray-600', 'border-transparent');
    });

    // Show clicked tab's pane
    target.classList.remove('hidden');
    target.classList.add('active');

    // Add active styles to clicked tab
    tab.classList.remove('text-gray-600', 'border-transparent');
    tab.classList.add('text-primary', 'border-primary');
  });
});


(function($) {

    "use strict";

    var searchPopup = function() {
      // open search box
      $('#header-nav').on('click', '.search-button', function(e) {
        $('.search-popup').toggleClass('is-visible');
      });

      $('#header-nav').on('click', '.btn-close-search', function(e) {
        $('.search-popup').toggleClass('is-visible');
      });

      $(".search-popup-trigger").on("click", function(b) {
          b.preventDefault();
          $(".search-popup").addClass("is-visible"),
          setTimeout(function() {
              $(".search-popup").find("#search-popup").focus()
          }, 350)
      }),
      $(".search-popup").on("click", function(b) {
          ($(b.target).is(".search-popup-close") || $(b.target).is(".search-popup-close svg") || $(b.target).is(".search-popup-close path") || $(b.target).is(".search-popup")) && (b.preventDefault(),
          $(this).removeClass("is-visible"))
      }),
      $(document).keyup(function(b) {
          "27" === b.which && $(".search-popup").removeClass("is-visible")
      })
    }

    var countdownTimer = function() {
      function getTimeRemaining(endtime) {
        const total = Date.parse(endtime) - Date.parse(new Date());
        const seconds = Math.floor((total / 1000) % 60);
        const minutes = Math.floor((total / 1000 / 60) % 60);
        const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
        const days = Math.floor(total / (1000 * 60 * 60 * 24));
        return {
          total,
          days,
          hours,
          minutes,
          seconds
        };
      }

      function initializeClock(id, endtime) {
        const clock = document.getElementById(id);
        const daysSpan = clock.querySelector('.days');
        const hoursSpan = clock.querySelector('.hours');
        const minutesSpan = clock.querySelector('.minutes');
        const secondsSpan = clock.querySelector('.seconds');

        function updateClock() {
          const t = getTimeRemaining(endtime);
          daysSpan.innerHTML = t.days;
          hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
          minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
          secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
          if (t.total <= 0) {
            clearInterval(timeinterval);
          }
        }
        updateClock();
        const timeinterval = setInterval(updateClock, 1000);
      }

      $('.countdown-clock').each(function(){
          const dateOnly = $(this).data('date');
          const daysCount = $(this).data('days');

          let finishDate;

          if (dateOnly) {
              finishDate = new Date(dateOnly + 'T23:59:59');
          } else if (daysCount) {
              finishDate = new Date();
              finishDate.setDate(finishDate.getDate() + parseInt(daysCount));
              finishDate.setHours(23, 59, 59); // end of day
          } else {
              finishDate = new Date();
              finishDate.setDate(finishDate.getDate() + 28);
              finishDate.setHours(23, 59, 59);
          }

          // Check if finished
          if (finishDate <= new Date()) {
              $(this).text('DISCOUNT ENDED');
              return;
          }
          initializeClock(this.id, finishDate);
      });
    }

    var initProductQty = function(){

      $('.product-qty').each(function(){

        var $el_product = $(this);
        var quantity = 0;

        $el_product.find('.quantity-right-plus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($el_product.find('#quantity').val());
            $el_product.find('#quantity').val(quantity + 1);
        });

        $el_product.find('.quantity-left-minus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($el_product.find('#quantity').val());
            if(quantity>0){
              $el_product.find('#quantity').val(quantity - 1);
            }
        });

      });

    }

    $(document).ready(function() {

      searchPopup();
      initProductQty();
      countdownTimer();

      var mainSwiper = new Swiper(".main-swiper", {
        speed: 500,
        navigation: {
          nextEl: ".main-slider-button-next",
          prevEl: ".main-slider-button-prev",
        },
      });

        var categorySwiper = new Swiper(".category-swiper", {
            speed: 600,
            autoplay: true,
            spaceBetween: 20,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                660: {
                    slidesPerView: 3,
                },
                980: {
                    slidesPerView: 4,
                }
            },
        });

      var productSwiper = new Swiper(".product-swiper", {
        spaceBetween: 20,
        navigation: {
          nextEl: ".product-slider-button-next",
          prevEl: ".product-slider-button-prev",
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          660: {
            slidesPerView: 3,
          },
          980: {
            slidesPerView: 4,
          },
          1500: {
            slidesPerView: 5,
          }
        },
      });

      var testimonialSwiper = new Swiper(".testimonial-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
          nextEl: ".testimonial-button-next",
          prevEl: ".testimonial-button-prev",
        },
      });

      var thumb_slider = new Swiper('.thumb-swiper', {
          direction: 'vertical',
          slidesPerView: '4',
          spaceBetween: 10,
          freeMode: true,
          watchSlidesProgress: true,
          mousewheel: true,
      });
      var large_slider = new Swiper(".large-swiper", {
        spaceBetween: 10,
        effect: 'fade',
        thumbs: {
          swiper: thumb_slider,
        },
      });

      $(".youtube").colorbox({
        iframe: true,
        innerWidth: 960,
        innerHeight: 585
      });

    }); // End of a document ready

    window.addEventListener("load", function () {
      const preloader = document.getElementById("preloader");
      preloader.classList.add("hide-preloader");
    });

    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.limited-offer-swiper', {
            loop: true,
            spaceBetween: 30,
            slidesPerView: 1,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2, // can change to 2 if you want
                },
                1024: {
                    slidesPerView: 1,
                },
            },
        });
    });
})(jQuery);