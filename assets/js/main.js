(function($) {

	var settings = {
			scrollWheel: {
					enabled: true,
					factor: 1
			},

			scrollZones: {
					enabled: true,
					speed: 15
			},
	};

	var	$window = $(window),
		$document = $(document),
		$body = $('body'),
		$html = $('html'),
		$bodyHtml = $('body,html'),
		$wrapper = $('#wrapper');

	breakpoints({
		xlarge:   [ '1281px',  '1680px' ],
		large:    [ '981px',   '1280px' ],
		medium:   [ '737px',   '980px'  ],
		small:    [ '481px',   '736px'  ],
		xsmall:   [ '361px',   '480px'  ],
		xxsmall:  [ null,      '360px'  ],
		short:    '(min-aspect-ratio: 16/7)',
		xshort:   '(min-aspect-ratio: 16/6)'
	});

	$window.on('load', function() {
		window.setTimeout(function() {
			$body.removeClass('is-preload');
		}, 100);
	});

	if (browser.mobile) {

		settings.keyboardShortcuts.enabled = false;
		settings.scrollWheel.enabled = false;
		settings.scrollZones.enabled = false;
		settings.dragging.enabled = false;

		$body.css('overflow-x', 'auto');
	}

	if (settings.scrollWheel.enabled) {
		(function() {
			var normalizeWheel = function(event) {

				var	pixelStep = 10,
					lineHeight = 40,
					pageHeight = 800,
					sX = 0,
					sY = 0,
					pX = 0,
					pY = 0;

					if ('detail' in event)
						sY = event.detail;
					else if ('wheelDelta' in event)
						sY = event.wheelDelta / -120;
					else if ('wheelDeltaY' in event)
						sY = event.wheelDeltaY / -120;

					if ('wheelDeltaX' in event)
						sX = event.wheelDeltaX / -120;

					if ('axis' in event
					&&	event.axis === event.HORIZONTAL_AXIS) {
						sX = sY;
						sY = 0;
					}

					pX = sX * pixelStep;
					pY = sY * pixelStep;

					if ('deltaY' in event)
						pY = event.deltaY;

					if ('deltaX' in event)
						pX = event.deltaX;

					if ((pX || pY)
					&&	event.deltaMode) {

						if (event.deltaMode == 1) {
							pX *= lineHeight;
							pY *= lineHeight;
						}
						else {
							pX *= pageHeight;
							pY *= pageHeight;
						}

					}

					if (pX && !sX)
						sX = (pX < 1) ? -1 : 1;

					if (pY && !sY)
						sY = (pY < 1) ? -1 : 1;

					return {
						spinX: sX,
						spinY: sY,
						pixelX: pX,
						pixelY: pY
					};

			};

			$body.on('wheel', function(event) {
				if (breakpoints.active('<=small'))
					return;
				event.preventDefault();
				event.stopPropagation();
				$bodyHtml.stop();
				var	n = normalizeWheel(event.originalEvent),
					x = (n.pixelX != 0 ? n.pixelX : n.pixelY),
					delta = Math.min(Math.abs(x), 150) * settings.scrollWheel.factor,
					direction = x > 0 ? 1 : -1;

				$document.scrollLeft($document.scrollLeft() + (delta * direction));
			});
		})();			
	}
})(jQuery);

$('.modal-button').on("click", function(){
	$('#'+this.dataset.target).show();
});

$('.button-close').on("click", function(){
	$(this).parents('dialog').hide();
});

