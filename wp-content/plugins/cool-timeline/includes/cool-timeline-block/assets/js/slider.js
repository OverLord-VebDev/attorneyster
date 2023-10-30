

jQuery(document).ready(function(){
        var swiper_el=jQuery(".swiper-outer")
        jQuery.each(swiper_el,function(){
            var swiper_id=jQuery(this).attr("id")
            var slides=jQuery(this).attr("data-slide")
            const swiper =new Swiper('.cool-timeline-block-'+swiper_id+' .swiper', {
                // Default parameters
                slidesPerView: slides,
                // Navigation arrows
                navigation: {
                    nextEl: '.cool-timeline-block-'+swiper_id+' .swiper-button-next',
                    prevEl: '.cool-timeline-block-'+swiper_id+' .swiper-button-prev',
                },
        
            breakpoints: {
                // when window width is >= 320px
                280: {
                  slidesPerView: 1,
               
                },
                // when window width is >= 480px
                480: {
                  slidesPerView: 2,
               
                },
                // when window width is >= 640px
                640: {
                  slidesPerView: 3,
             
                }
              }
          })
        })
})