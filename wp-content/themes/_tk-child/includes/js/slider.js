
jQuery(document).ready( function() {
	
	jQuery('.carousel-sync').on('slide.bs.carousel', function(ev) {
		var dir = ev.direction == 'right' ? 'prev' : 'next';
		jQuery('.carousel-sync').not('.sliding').addClass('sliding').carousel(dir);
	});
	jQuery('.carousel-sync').on('slid.bs.carousel', function(ev) {
		jQuery('.carousel-sync').removeClass('sliding');
	});
	
    jQuery('#myCarousel').carousel({
    	interval: 8000
	});
	jQuery('#myCarousel2').carousel({
    	interval: 8000
	});
	jQuery('#myCarousel3').carousel({
    	interval: 8000
	});
	
	jQuery("#myCarousel2").swiperight(function() {  
      $("#myCarousel2").carousel('prev');  
    });  
   jQuery("#myCarousel2").swipeleft(function() {  
      jQuery("#myCarousel2").carousel('next');  
   });
   jQuery("#myCarousel3").swiperight(function() {  
      jQuery("#myCarousel3").carousel('prev');  
    });  
   jQuery("#myCarousel3").swipeleft(function() {  
      jQuery("#myCarousel3").carousel('next');  
   });
   jQuery("#myCarousel4").swiperight(function() {  
      jQuery("#myCarousel4").carousel('prev');  
    });  
   jQuery("#myCarousel4").swipeleft(function() {  
      jQuery("#myCarousel4").carousel('next');  
   });
   jQuery("#miniCarousel").swiperight(function() {  
      jQuery("#miniCarousel").carousel('prev');  
    });  
   jQuery("#miniCarousel").swipeleft(function() {  
      jQuery("#miniCarousel").carousel('next');  
   });  
	
	jQuery('.slider-nav li').first().addClass('active');
	var clickEvent = false;
	var leftControlOne = false;
	
	jQuery('#myCarousel').on('click', '.slider-nav a', function() {
			clickEvent = true;
			jQuery('.slider-nav li').removeClass('active');
			jQuery(this).parent().addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = jQuery('.slider-nav').children().length -1;
			var current = jQuery('.slider-nav li.active');
			
			if(jQuery('.slider-nav li').last().hasClass('active')){
				jQuery('.slider-nav li').last().removeClass('active');
				jQuery('.slider-nav li').first().addClass('active')
			}
			else {
				if(leftControlOne){
					current.removeClass('active').prev().addClass('active');
					var id = parseInt(current.data('slide-to'));
					if(count == id) {
						jQuery('.slider-nav li').last().addClass('active');	
					}
				}
				else {
					current.removeClass('active').next().addClass('active');
					var id = parseInt(current.data('slide-to'));
					if(count == id) {
						jQuery('.slider-nav li').first().addClass('active');	
					}
				}
			}
		}
		clickEvent = false;
		leftControlOne = false;
	});
	
	jQuery("#left-control-1").click(function(){
		leftControlOne = true;	
	});
	
});

jQuery(document).ready(function() {
    var heights = jQuery(".white").map(function() {
        return jQuery(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);

    jQuery(".white").height(maxHeight);
});

jQuery(document).ready(function() {
    var heights = jQuery(".auto-height").map(function() {
        return jQuery(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);

    jQuery(".auto-height").height(maxHeight);
});
jQuery(document).ready(function() {
    var heights = jQuery(".aof").map(function() {
        return jQuery(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);

    jQuery(".aof").height(maxHeight);
});