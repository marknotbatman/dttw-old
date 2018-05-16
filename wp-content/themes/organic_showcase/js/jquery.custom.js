jQuery(document).ready(function($) {
    
    /* Superfish the menu drops ---------------------*/
    $('.menu').superfish({
    	delay: 200,
    	animation: {opacity:'show', height:'show'},
    	speed: 'fast',
    	autoArrows: true,
    	dropShadows: false
    });
    
    /* Mobile Menu ---------------------*/
    $('#sec-selector').change(function(){
        if ($(this).val()!='') {
        	window.location.href=$(this).val();
        }
    });
    
    $(document).on( 'ready post-load', function() {
        
	    /* Flexslider ---------------------*/
	    $(window).load(function() { 
		    if( ($).flexslider) {
		    	var slider = $('.flexslider');
		    	var loader = $('.flexslider');
		    	slider.fitVids().flexslider({
			    	slideshowSpeed		: slider.attr('data-speed'),
			    	animationDuration	: 600,
			    	animation			: 'fade',
			    	prevText			: '<span class="organicon-arrow-left-2"></span>',
			    	nextText			: '<span class="organicon-arrow-right-2"></span>',
			    	controlNav 			: false,
			    	video				: false,
			    	useCSS				: false,
			    	touch				: false,
			    	animationLoop		: true,
			    	smoothHeight		: true,
			    	
			    	start: function(slider) {
			    	    loader.removeClass('loading');
			    	}
		    	});	
		    }
	    });
	    
	    /* Masonry ---------------------*/
	    $(document).ready(function() { 
	    	$('.holder-third').masonry({
	    		itemSelector : '.third',
	    		gutterWidth : 0,
	    		isAnimated: false,
	    		columnWidth : function( containerWidth ) {
	    		    return containerWidth / 3; }
	    	}).imagesLoaded(function() {
	    		$('.holder-third').masonry('reload');
	    	});
	    	$('.holder-half').masonry({
	    		itemSelector : '.half',
	    		gutterWidth : 0,
	    		isAnimated: false,
	    		columnWidth : function( containerWidth ) {
	    		    return containerWidth / 2; }
	    	}).imagesLoaded(function() {
	    	   $('.holder-half').masonry('reload');
	    	});
	    });
	    
  		/* Portfolio Filter ---------------------*/
		$(window).load(function() { 
		    var mycontainer = $('#portfolio-list');
			mycontainer.isotope({
			    itemSelector: '.portfolio-item'
		    });
		    
		  	// filter items when filter link is clicked
		  	$('#portfolio-filter a').click(function(){
			    var selector = $(this).attr('data-filter');
			    mycontainer.isotope({ filter: selector });
			    return false; 
		    });
	    });
	    $(window).resize(function() { 
	        var mycontainer = $('#portfolio-list');
	    	mycontainer.isotope({
	    	    itemSelector: '.portfolio-item'
	        });
	        
	      	// filter items when filter link is clicked
	      	$('#portfolio-filter a').click(function(){
	    	    var selector = $(this).attr('data-filter');
	    	    mycontainer.isotope({ filter: selector });
	    	    return false; 
	        });
	    });   
	    
	    /* Insert Line Break Before More Links ---------------------*/
	    $('<br />').insertBefore('.article .more-link');
	    
	    /* Hide Comments When No Comments Activated ---------------------*/
	    $('.nocomments').parent().css('display', 'none');
	    
	    /* Fit Vids ---------------------*/
	    $('.feature-vid').fitVids();
	    
	    /* $ UI Tabs ---------------------*/
	    $(function() {
	       $( ".organic-tabs" ).tabs();
	    });
	    
	    /* $ UI Accordion ---------------------*/
	    $(function() {
	        $( ".organic-accordion" ).accordion({
	        	collapsible: true, 
	            autoHeight: false
	        });
	    });
	    
	    /* Close Message Box ---------------------*/
	    $('.organic-box a.close').click(function() {
	    	$(this).parent().stop().fadeOut('slow', function() {
	    	});
	    });
	    
	    /* Toggle Box ---------------------*/
	    $('.toggle-trigger').click(function() {
	    	$(this).toggleClass("active").next().fadeToggle("slow");
	    });
	    
	    /* Pretty Photo Lightbox ---------------------*/
	    $("a[rel^='prettyPhoto']").prettyPhoto();
    
    });
    
});