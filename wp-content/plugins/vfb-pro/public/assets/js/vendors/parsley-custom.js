if ( window.vfbp_validation_custom ) {

	var messages = vfbp_validation_custom.vfbp_messages;

	var defaultMsg = messages.default,
		email      = messages.email,
		url        = messages.url,
		number     = messages.number,
		integer    = messages.integer,
		digits     = messages.digits,
		alphanum   = messages.alphanum,
		notblank   = messages.notblank,
		required   = messages.required,
		pattern    = messages.pattern,
		min        = messages.min,
		max        = messages.max,
		range      = messages.range,
		minlength  = messages.minlength,
		maxlength  = messages.maxlength,
		lengthMsg  = messages.lengthMsg,
		mincheck   = messages.mincheck,
		maxcheck   = messages.maxcheck,
		check      = messages.check,
		equalto    = messages.equalto,
		minwords   = messages.minwords,
		maxwords   = messages.maxwords,
		words      = messages.words,
		gt         = messages.gt,
		gte        = messages.gte,
		lt         = messages.lt,
		lte        = messages.lte;

	// ParsleyConfig definition if not already set
	window.ParsleyConfig = window.ParsleyConfig || {};
	window.ParsleyConfig.i18n = window.ParsleyConfig.i18n || {};

	// Define then the messages
	window.ParsleyConfig.i18n.en = jQuery.extend(window.ParsleyConfig.i18n.en || {}, {
	  defaultMessage: defaultMsg,
	  type: {
	    email:        email,
	    url:          url,
	    number:       number,
	    integer:      integer,
	    digits:       digits,
	    alphanum:     alphanum
	  },
	  notblank:       notblank,
	  required:       required,
	  pattern:        pattern,
	  min:            min,
	  max:            max,
	  range:          range,
	  minlength:      minlength,
	  maxlength:      maxlength,
	  length:         lengthMsg,
	  mincheck:       mincheck,
	  maxcheck:       maxcheck,
	  check:          check,
	  equalto:        equalto,
	  minwords:       minwords,
	  maxwords:       maxwords,
	  words:          words,
	  gt:             gt,
	  gte:            gte,
	  lt:             lt,
	  lte:            lte
	});

	// If file is loaded after Parsley main file, auto-load locale
	if ('undefined' !== typeof window.ParsleyValidator) {
	  window.ParsleyValidator.addCatalog('en', window.ParsleyConfig.i18n.en, true);
	}
}