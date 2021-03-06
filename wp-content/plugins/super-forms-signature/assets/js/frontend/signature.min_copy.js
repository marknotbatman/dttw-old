// Init Signature
SUPER.init_signature = function(){
	$('.super-signature').each(function(){
		var $this = $(this);
		var $canvas = $this.find('.super-signature-canvas');
		var $field = $this.find('.super-shortcode-field');
		if(!$canvas.children('canvas').length){
			$canvas.signature({
				thickness: $field.data('thickness'),
				change: function(event, ui) { 
				    var $target = $(event.target);
				    if( $target.signature('isEmpty')==false ) {
				    	if( !$this.hasClass('not-empty') ) {
				    		$this.addClass('not-empty');
				    	}
						var $signature = $canvas[0].children;
						var $image_data_url = $signature[0].toDataURL("image/png");
						$field.val($image_data_url);
				    }else{
						$this.removeClass('not-empty');
				    }
		    	}
			});
		}
	});
}

jQuery(document).ready(function ($) {
    
    var $doc = $(document);
    SUPER.init_signature();
	$doc.on('click', '.super-signature-clear', function() { 
	    var $parent = $(this).parents('.super-signature:eq(0)');
	    var $canvas = $parent.find('.super-signature-canvas');
	    $canvas.signature('clear');
	    $parent.removeClass('not-empty');
	   	$parent.find('.super-shortcode-field').val('');
	});

	$doc.ajaxComplete(function() {
		SUPER.init_signature();
	});

});