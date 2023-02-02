/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

/**
 *
 * @param {string} controlId
 * @param {string} selector
 * @param {string||array} cssProperty
 * @param {null} unit
 */
function zakraGenerateCSS( controlId, selector, cssProperty, unit = null ) {

	wp.customize( controlId, function( value ) {

		value.bind( function ( newValue ) {
			var cssText = '';

			jQuery( `style#${controlId}` ).remove();

			if ( null !== unit ) {

				if ( Array.isArray( cssProperty ) ) {

					cssProperty.forEach( function ( property ) {
						cssText += `${ property } : ${ newValue + unit };`;
					} );
				} else {
					cssText += `${ cssProperty } :  ${ newValue + unit };`;
				}
			} else {
				cssText += `${ cssProperty }: ${ newValue };`;
			}

			jQuery( 'head' ).append( `<style id="${ controlId }">${ selector }{ ${ cssText } }</style>` );
		} );
	} );
}

/**
 * Control that returns either true or false.
 *
 * @param {string} controlId
 * @param {string} selector
 * @param {string} classes
 * @param {boolean} removeOnTrue
 */
function zakraAddRemoveCSSClasses(  controlId, selector, classes, removeOnTrue = false  ) {

	wp.customize( controlId, function ( value ) {

		value.bind( function ( newValue ) {

			if ( removeOnTrue ) {

				if ( newValue ) {
					jQuery( selector ).removeClass( classes );
				} else {
					jQuery( selector ).addClass( classes );
				}
			} else {

				if ( newValue ) {
					jQuery( selector ).addClass( classes );
				} else {
					jQuery( selector ).removeClass( classes );
				}
			}
		} );
	} );
}

/**
 * @param {string} controlId
 * @param {string} selector
 * @param {string} cssProperty
 */
function zakraGenerateDimensionCSS( controlId, selector, cssProperty  ) {

	wp.customize( controlId, function ( value ) {

		value.bind( function ( dimension ) {
			var topCSS = ( '' !== dimension.top ) ? dimension.top : 0,
				rightCSS = ( '' !== dimension.right ) ? dimension.right : 0,
				bottomCSS = ( '' !== dimension.bottom ) ? dimension.bottom : 0,
				leftCSS = ( '' !== dimension.left ) ? dimension.left : 0;

			jQuery( `style#${controlId}` ).remove();

			jQuery( 'head' ).append(
				`<style id="${ controlId }">${selector}{ ${ cssProperty } : ${ topCSS + ' ' + rightCSS + ' ' + bottomCSS + ' ' + leftCSS  } }</style>`
			);
		} );
	} );
}

/**
 * @param {string} controlId
 * @param {string} selector
 */
function zakraGenerateBackgroundCSS( controlId, selector ) {

	wp.customize( controlId, function ( value ) {

		value.bind( function ( background ) {
			var css;

			jQuery( 'style#' + controlId ).remove();

			css = `${selector}{background-color: ${background['background-color']};background-image: url( ${background['background-image']} );background-attachment: ${background['background-attachment']};background-position: ${background['background-position']};background-size: ${background['background-size']};background-repeat: ${background['background-repeat']};}`;

			jQuery( 'head' ).append( `<style id="${ controlId }">${ css }</style>` );
		} );
	} );
}

/**
 * @param {string} controlId
 * @param {string} selector
 */
function zakraGenerateTypographyCSS( controlId, selector ) {

	wp.customize( controlId, function ( value ) {

		value.bind( function ( typography ) {
			var	link              = '',
				fontFamily        = '',
				fontWeight        = '',
				fontStyle         = '',
				fontTransform     = '',
				desktopFontSize   = '',
				tabletFontSize    = '',
				mobileFontSize    = '',
				desktopLineHeight = '',
				tabletLineHeight  = '',
				mobileLineHeight  = '';

			if ( 'object' == typeof typography ) {

				if ( undefined !== typography['font-size'] ) {

					if ( undefined !== typography['font-size']['desktop'] && '' !== typography['font-size']['desktop'] ) {
						desktopFontSize = typography['font-size']['desktop'];
					}

					if ( undefined !== typography['font-size']['tablet'] && '' !== typography['font-size']['tablet'] ) {
						tabletFontSize = typography['font-size']['tablet'];
					}

					if ( undefined !== typography['font-size']['mobile'] && '' !== typography['font-size']['mobile'] ) {
						mobileFontSize = typography['font-size']['mobile'];
					}
				}

				if ( undefined !== typography['line-height'] ) {

					if ( undefined !== typography['line-height']['desktop'] && '' !== typography['line-height']['desktop'] ) {
						desktopLineHeight = typography['line-height']['desktop'];
					}

					if ( undefined !== typography['line-height']['tablet'] && '' !== typography['line-height']['tablet'] ) {
						tabletLineHeight = typography['line-height']['tablet'];
					}

					if ( undefined !== typography['line-height']['mobile'] && '' !== typography['line-height']['mobile'] ) {
						mobileLineHeight = typography['line-height']['mobile'];
					}
				}

				if ( undefined !== typography['font-family'] && '' !== typography['font-family'] ) {
					fontFamily = typography['font-family'].split(",")[0];
					fontFamily = fontFamily.replace(/'/g, '');

					if ( fontFamily.includes( 'default' ) || fontFamily.includes( '-apple-system' )  ) {
						fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif';
					} else if ( fontFamily.includes( 'Monaco' ) ) {
						fontFamily = 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace';
					} else {
						link = `<link id="${ controlId }" href="https://fonts.googleapis.com/css?family=${ fontFamily }" rel="stylesheet">`;
					}
				}

				if ( undefined !== typography['font-weight'] && '' !== typography['font-weight'] ) {

					if ( zakraIsNumeric( typography['font-weight'] ) ) {
						fontWeight = parseInt( typography['font-weight'] );
					} else {
						fontWeight = 'regular' != typography['font-weight'] ? typography['font-weight'] : 'normal';
					}
				}

				if ( undefined !== typography['font-style'] && '' !== typography['font-style'] ) {
					fontStyle = typography['font-style'];
				}

				if ( undefined !== typography['text-transform'] && '' !== typography['text-transform'] ) {
					fontTransform = typography['text-transform'];
				}

				jQuery( 'style#' + controlId ).remove();
				jQuery('link#' + controlId).remove();

				jQuery('head').append(
					`<style id="${ controlId }">
					${ selector } {
						font-family: ${ fontFamily };
						font-weight: ${ fontWeight };
						font-style: ${ fontStyle };
						text-transform: ${ fontTransform };
						font-size: ${ desktopFontSize }; 
						line-height: ${ desktopLineHeight };
					}
					@media (max-width: 768px) {
						${ selector } {
							font-size: ${ tabletFontSize };
							line-height: ${ tabletLineHeight };
						} 
					}
					@media (max-width: 600px) {
						${ selector }{
							font-size: ${ mobileFontSize };
							line-height:${ mobileLineHeight };
						}
					}
				</style>${ link }`
				);
			}
		} );
	} );
}

/**
 * @param {string} str
 * @returns {boolean}
 */
function zakraIsNumeric( str ) {
	var matches;

	if ( 'string' !== typeof str ) {
		return false;
	}

	matches = str.match(/\d+/g);

	return null !== matches;
}

zakraGenerateCSS( 'zakra_general_container_width', '.tg-container', 'max-width', 'px' );
zakraGenerateCSS( 'zakra_general_content_width', '#primary', 'width', '%' );
zakraGenerateCSS( 'zakra_general_sidebar_width', '#secondary', 'width', '%' );
zakraGenerateDimensionCSS( 'zakra_header_button_padding', '.main-navigation.tg-primary-menu > div ul li.tg-header-button-wrap a, .tg-mobile-navigation .tg-header-button-one .tg-header-button', 'padding' );
zakraGenerateCSS( 'zakra_header_button_text_color', '.main-navigation.tg-primary-menu > div ul li.tg-header-button-wrap a, .tg-mobile-navigation .tg-header-button-one .tg-header-button', 'color' );
zakraGenerateCSS( 'zakra_header_button_text_hover_color', '.main-navigation.tg-primary-menu > div ul li.tg-header-button-wrap a:hover, .tg-mobile-navigation .tg-header-button-one .tg-header-button:hover', 'color' );
zakraGenerateCSS( 'zakra_header_button_bg_color', '.main-navigation.tg-primary-menu > div ul li.tg-header-button-wrap a, .tg-mobile-navigation .tg-header-button-one .tg-header-button', 'background-color' );
zakraGenerateCSS( 'zakra_header_button_bg_hover_color', '.main-navigation.tg-primary-menu > div ul li.tg-header-button-wrap a:hover, .tg-mobile-navigation .tg-header-button-one .tg-header-button:hover', 'background-color' );
zakraGenerateCSS( 'zakra_header_top_text_color', '.tg-site-header .tg-site-header-top', 'color' );
zakraGenerateCSS( 'zakra_header_main_border_bottom_width', '.tg-site .tg-site-header', 'border-bottom-width', 'px' );
zakraGenerateCSS( 'zakra_header_main_border_bottom_color', '.tg-site .tg-site-header', 'border-bottom-color' );
zakraGenerateCSS( 'zakra_header_button_roundness', '.main-navigation.tg-primary-menu > div ul li.tg-header-button-wrap a, .tg-mobile-navigation .tg-header-button-one .tg-header-button', 'border-radius', 'px' );
zakraGenerateBackgroundCSS( 'zakra_header_top_bg', '.tg-site-header .tg-site-header-top' );
zakraGenerateBackgroundCSS( 'zakra_header_main_bg', '.tg-site-header, .tg-container--separate .tg-site-header' );
zakraGenerateCSS( 'zakra_primary_menu_text_color', '.tg-primary-menu > div > ul li:not(.tg-header-button-wrap) a', 'color' );
zakraGenerateCSS( 'zakra_primary_menu_text_hover_color', '.tg-primary-menu > div > ul li:not(.tg-header-button-wrap):hover > a', 'color' );
zakraGenerateBackgroundCSS( 'zakra_inside_container_background', '#main' );
zakraGenerateCSS( 'zakra_breadcrumbs_font_size', '.tg-page-header .breadcrumb-trail ul li, .tg-page-header .yoast-breadcrumb-trail', 'font-size', 'px' );
zakraGenerateDimensionCSS( 'zakra_page_title_padding', '.tg-page-header', 'padding' );
zakraGenerateBackgroundCSS( 'zakra_page_title_bg', '.tg-page-header, .tg-container--separate .tg-page-header' );
zakraGenerateCSS( 'zakra_breadcrumbs_seperator_color', '.tg-page-header .breadcrumb-trail ul li::after', 'color' );
zakraGenerateCSS( 'zakra_breadcrumbs_text_color', '.tg-page-header .breadcrumb-trail ul li', 'color' );
zakraGenerateCSS( 'zakra_breadcrumbs_link_color', '.tg-page-header .breadcrumb-trail ul li a', 'color' );
zakraGenerateCSS( 'zakra_breadcrumbs_link_hover_color', '.tg-page-header .breadcrumb-trail ul li a:hover ', 'color' );
zakraGenerateCSS( 'zakra_post_page_title_color', '.tg-page-header .tg-page-header__title, .tg-page-content__title', 'color' );
zakraGenerateBackgroundCSS( 'zakra_footer_bar_bg', '.tg-site-footer .tg-site-footer-bar' );
zakraGenerateCSS( 'zakra_footer_bar_text_color', '.tg-site-footer .tg-site-footer-bar', 'color' );
zakraGenerateCSS( 'zakra_footer_bar_link_color', '.tg-site-footer .tg-site-footer-bar a', 'color' );
zakraGenerateCSS( 'zakra_footer_bar_link_hover_color', '.tg-site-footer .tg-site-footer-bar a:hover, .tg-site-footer .tg-site-footer-bar a:focus', 'color' );
zakraGenerateCSS( 'zakra_footer_bar_border_top_width', '.tg-site-footer .tg-site-footer-bar', 'border-top-width', 'px' );
zakraGenerateCSS( 'zakra_footer_bar_border_top_color', '.tg-site-footer .tg-site-footer-bar', 'border-top-color' );
zakraGenerateCSS( 'zakra_scroll_to_top_bg_color', '.tg-scroll-to-top', 'background-color' );
zakraGenerateCSS( 'zakra_scroll_to_top_bg_hover_color', '.tg-scroll-to-top:hover', 'background-color' );
zakraGenerateCSS( 'zakra_scroll_to_top_color', '.tg-scroll-to-top', 'color' );
zakraGenerateCSS( 'zakra_scroll_to_top_hover_color', '.tg-scroll-to-top:hover', 'color' );
zakraGenerateCSS( 'zakra_primary_menu_border_bottom_width', '.tg-site-header .main-navigation', 'border-bottom-width', 'px' );
zakraGenerateTypographyCSS( 'zakra_typography_post_page_title', '.tg-page-header .tg-page-header__title, .tg-page-content__title' );
zakraGenerateTypographyCSS( 'zakra_base_typography_heading', 'h1, h2, h3, h4, h5, h6' );
zakraGenerateTypographyCSS( 'zakra_typography_site_title', '.site-branding .site-title' );
zakraGenerateTypographyCSS( 'zakra_typography_site_description', '.site-branding .site-description' );
zakraGenerateTypographyCSS( 'zakra_typography_primary_menu', '.tg-primary-menu > div ul li a' );
zakraGenerateTypographyCSS( 'zakra_typography_primary_menu_dropdown_item', '.tg-primary-menu > div ul li ul li a' );
zakraGenerateTypographyCSS( 'zakra_typography_mobile_menu', '.tg-mobile-navigation a' );
zakraGenerateTypographyCSS( 'zakra_typography_blog_post_title', '.entry-title:not(.tg-page-content__title), .tg-blog-archive-style--grid article.zakra-article .entry-title' );
zakraGenerateTypographyCSS( 'zakra_typography_widget_heading', '.widget .widget-title' );
zakraGenerateTypographyCSS( 'zakra_typography_widget_content', '.widget' );
zakraGenerateTypographyCSS( 'zakra_typography_h1', 'h1' );
zakraGenerateTypographyCSS( 'zakra_typography_h2', 'h2' );
zakraGenerateTypographyCSS( 'zakra_typography_h3', 'h3' );
zakraGenerateTypographyCSS( 'zakra_typography_h4', 'h4' );
zakraGenerateTypographyCSS( 'zakra_typography_h5', 'h5' );
zakraGenerateTypographyCSS( 'zakra_typography_h6', 'h6' );
zakraGenerateBackgroundCSS( 'zakra_footer_widgets_bg', '.tg-site-footer-widgets' );
zakraGenerateCSS( 'zakra_footer_widgets_title_color', '.tg-site-footer .tg-site-footer-widgets .widget-title', 'color' );
zakraGenerateCSS( 'zakra_footer_widgets_text_color', '.tg-site-footer .tg-site-footer-widgets, .tg-site-footer .tg-site-footer-widgets p', 'color' );
zakraGenerateCSS( 'zakra_footer_widgets_link_color', '.tg-site-footer .tg-site-footer-widgets a', 'color' );
zakraGenerateCSS( 'zakra_footer_widgets_link_hover_color', '.tg-site-footer .tg-site-footer-widgets a:hover, .tg-site-footer .tg-site-footer-widgets a:focus', 'color' );
zakraGenerateCSS( 'zakra_footer_widgets_border_top_width', '.tg-site-footer .tg-site-footer-widgets', 'border-top-width', 'px' );
zakraGenerateCSS( 'zakra_footer_widgets_border_top_color', '.tg-site-footer .tg-site-footer-widgets', 'border-top-color' );
zakraGenerateCSS( 'zakra_footer_widgets_item_border_bottom_width', '.tg-site-footer .tg-site-footer-widgets ul li', 'border-bottom-width', 'px' );
zakraGenerateCSS( 'zakra_footer_widgets_item_border_bottom_color', '.tg-site-footer .tg-site-footer-widgets ul li', 'border-bottom-color' );

( function ( $ ) {

	function removeAndAppendHeaderAction() {
		if( $( '#masthead' ).find( '> .tg-site-header-bottom > .tg-header-container > .tg-header-action' ).length > 0 ) {

			let header_action = $( '#masthead' ).find('> .tg-site-header-bottom > .tg-header-container > .tg-header-action')[0];

			$( '#masthead' ).find('> .tg-site-header-bottom > .tg-header-container > .tg-header-action').remove();

			$( '#masthead' ).find('> .tg-site-header-bottom > .tg-header-container > .tg-block--two' ).append( header_action );
		}
	}

	// Site title.
	wp.customize(
		'blogname',
		function ( value ) {
			value.bind(
				function ( to ) {
					$( '.site-title a' ).text( to );
				}
			);
		}
	);

	// Site description.
	wp.customize(
		'blogdescription',
		function ( value ) {
			value.bind(
				function ( to ) {
					$( '.site-description' ).text( to );
				}
			);
		}
	);

	wp.customize(
		'header_textcolor',
		function ( value ) {
			value.bind( function ( to ) {

				if ( 'blank' === to ) {

					$( '.site-title, .site-description' ).css( {
						'clip'    : 'rect(1px, 1px, 1px, 1px)',
						'position': 'absolute'
					} );
				} else {

					$( '.site-title, .site-description' ).css( {
						'clip'    : 'auto',
						'position': 'relative'
					} );

					$( 'style#zakra_header_textcolor' ).remove();

					$( 'head' ).append( `<style id="zakra_header_textcolor">.site-title a, .site-description{ color: ${ to } }</style>` )
				}
			} );
		} );

	// Site Layout Option.
	wp.customize(
		'zakra_general_container_style',
		function ( value ) {
			value.bind(
				function ( layout ) {

					if ( 'tg-container--wide' === layout ) {
						$( 'body' ).removeClass( 'tg-container--boxed' ).removeClass( 'tg-container--separate' ).addClass( 'tg-container--wide' );
					} else if ( 'tg-container--boxed' === layout ) {
						$( 'body' ).removeClass( 'tg-container--wide' ).removeClass( 'tg-container--separate' ).addClass( 'tg-container--boxed' );
					} else if ( 'tg-container--separate' === layout ) {
						$( 'body' ).removeClass( 'tg-container--wide' ).removeClass( 'tg-container--boxed' ).addClass( 'tg-container--separate' );
					}
				}
			);
		}
	);

	// Site Layout Option.
	wp.customize(
		'zakra_header_top_style',
		function ( value ) {
			value.bind(
				function ( layout ) {

					if ( 'wide' === layout ) {
						$( '.tg-site-header-top' ).removeClass( 'tg-site-header-top--stacked' ).removeClass( 'tg-site-header-top--centered' ).addClass( 'tg-site-header-top--wide' );
					} else if ( 'stacked' === layout ) {
						$( '.tg-site-header-top' ).removeClass( 'tg-site-header-top--centered' ).removeClass( 'tg-site-header-top--wide' ).addClass( 'tg-site-header-top--stacked' );
					} else if ( 'centered' === layout ) {
						$( '.tg-site-header-top' ).removeClass( 'tg-site-header-top--stacked' ).removeClass( 'tg-site-header-top--wide' ).addClass( 'tg-site-header-top--centered' );
					}
				}
			);
		}
	);

	// Site Layout Option.
	wp.customize(
		'zakra_header_main_style',
		function ( value ) {
			value.bind(
				function ( layout ) {
					if ( 'tg-site-header--left' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header--center' ).removeClass( 'tg-site-header--both-left' ).removeClass( 'tg-site-header--both-right' ).removeClass( 'tg-site-header--right' ).removeClass( 'tg-site-header--nav-center' ).addClass( 'tg-site-header--left' );
						removeAndAppendHeaderAction();
					} else if ( 'tg-site-header--center' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header--right' ).removeClass( 'tg-site-header--left' ).removeClass( 'tg-site-header--both-left' ).removeClass( 'tg-site-header--both-right' ).removeClass( 'tg-site-header--nav-center' ).addClass( 'tg-site-header--center' );
						removeAndAppendHeaderAction();
					} else if ( 'tg-site-header--right' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header--left' ).removeClass( 'tg-site-header--center' ).removeClass( 'tg-site-header--both-left' ).removeClass( 'tg-site-header--both-right' ).removeClass( 'tg-site-header--nav-center' ).addClass( 'tg-site-header--right' );
						removeAndAppendHeaderAction();
					} else if ( 'tg-site-header--both-left' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header--both-right' ).removeClass( 'tg-site-header--right' ).removeClass( 'tg-site-header--center' ).removeClass( 'tg-site-header--left' ).removeClass( 'tg-site-header--nav-center' ).addClass( 'tg-site-header--both-left' )
						removeAndAppendHeaderAction();
					} else if ( 'tg-site-header--both-right' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header--both-left' ).removeClass( 'tg-site-header--right' ).removeClass( 'tg-site-header--center' ).removeClass( 'tg-site-header--left' ).removeClass( 'tg-site-header--nav-center' ).addClass( 'tg-site-header--both-right' );
						removeAndAppendHeaderAction();
					} else if ( 'tg-site-header--nav-center' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header--both-left' ).removeClass( 'tg-site-header--right' ).removeClass( 'tg-site-header--center' ).removeClass( 'tg-site-header--left' ).removeClass( 'tg-site-header--both-right' ).addClass( 'tg-site-header--nav-center' );
					}
				}
			);
		}
	);

	// Site Layout Option.
	wp.customize(
		'zakra_header_main_style_mobile',
		function ( value ) {
			value.bind(
				function ( layout ) {
					if ( 'default' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header-mob--center' ).removeClass( 'tg-site-header-mob--both-left' ).removeClass( 'tg-site-header-mob--both-right' ).removeClass( 'tg-site-header-mob--right' ).removeClass( 'tg-site-header-mob--left' );
					} else if ( 'left' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header-mob--center' ).removeClass( 'tg-site-header-mob--both-left' ).removeClass( 'tg-site-header-mob--both-right' ).removeClass( 'tg-site-header-mob--right' ).addClass( 'tg-site-header-mob--left' );
					} else if ( 'center' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header-mob--right' ).removeClass( 'tg-site-header-mob--left' ).removeClass( 'tg-site-header-mob--both-left' ).removeClass( 'tg-site-header-mob--both-right' ).addClass( 'tg-site-header-mob--center' );
					} else if ( 'right' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header-mob--left' ).removeClass( 'tg-site-header-mob--center' ).removeClass( 'tg-site-header-mob--both-left' ).removeClass( 'tg-site-header-mob--both-right' ).addClass( 'tg-site-header-mob--right' );
					} else if ( 'both-left' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header-mob--both-right' ).removeClass( 'tg-site-header-mob--right' ).removeClass( 'tg-site-header-mob--center' ).removeClass( 'tg-site-header-mob--left' ).addClass( 'tg-site-header-mob--both-left' )
					} else if ( 'both-right' === layout ) {
						$( '#masthead' ).removeClass( 'tg-site-header-mob--both-left' ).removeClass( 'tg-site-header-mob--right' ).removeClass( 'tg-site-header-mob--center' ).removeClass( 'tg-site-header-mob--left' ).addClass( 'tg-site-header-mob--both-right' );
					}
				}
			);
		}
	);

	wp.customize(
		'zakra_primary_menu_text_active_color',
		function ( value ) {
			value.bind( function ( color ) {
				jQuery( 'style#zakra_primary_menu_text_active_color' ).remove();
				jQuery('head').append(
					`<style id='zakra_primary_menu_text_active_color'>
					.tg-primary-menu > div ul li:active > a, .tg-primary-menu > div ul > li:not(.tg-header-button-wrap).current_page_item > a, .tg-primary-menu > div ul > li:not(.tg-header-button-wrap).current_page_ancestor > a, .tg-primary-menu > div ul > li:not(.tg-header-button-wrap).current-menu-item > a, .tg-primary-menu > div ul > li:not(.tg-header-button-wrap).current-menu-ancestor > a {
						color: ${ color };
					}
					.tg-primary-menu.tg-primary-menu--style-underline > div ul > li:not(.tg-header-button-wrap).current_page_item > a::before, .tg-primary-menu.tg-primary-menu--style-underline > div ul > li:not(.tg-header-button-wrap).current_page_ancestor > a::before, .tg-primary-menu.tg-primary-menu--style-underline > div ul > li:not(.tg-header-button-wrap).current-menu-item > a::before, .tg-primary-menu.tg-primary-menu--style-underline > div ul > li:not(.tg-header-button-wrap).current-menu-ancestor > a::before, .tg-primary-menu.tg-primary-menu--style-left-border > div ul > li:not(.tg-header-button-wrap).current_page_item > a::before, .tg-primary-menu.tg-primary-menu--style-left-border > div ul > li:not(.tg-header-button-wrap).current_page_ancestor > a::before, .tg-primary-menu.tg-primary-menu--style-left-border > div ul > li:not(.tg-header-button-wrap).current-menu-item > a::before, .tg-primary-menu.tg-primary-menu--style-left-border > div ul > li:not(.tg-header-button-wrap).current-menu-ancestor > a::before, .tg-primary-menu.tg-primary-menu--style-right-border > div ul > li:not(.tg-header-button-wrap).current_page_item > a::before, .tg-primary-menu.tg-primary-menu--style-right-border > div ul > li:not(.tg-header-button-wrap).current_page_ancestor > a::before, .tg-primary-menu.tg-primary-menu--style-right-border > div ul > li:not(.tg-header-button-wrap).current-menu-item > a::before, .tg-primary-menu.tg-primary-menu--style-right-border > div ul > li:not(.tg-header-button-wrap).current-menu-ancestor > a::before {
						background-color: ${color};
					}
				</style>`
				);
			} )
		} );

	// Site Layout Option.
	wp.customize(
		'zakra_page_title_alignment',
		function ( value ) {
			value.bind(
				function ( layout ) {
					if ( 'tg-page-header--left-right' === layout ) {
						$( '.tg-page-header' ).removeClass( 'tg-page-header--right-left' ).removeClass( 'tg-page-header--both-center' ).removeClass( 'tg-page-header--both-left' ).removeClass( 'tg-page-header--both-right' ).addClass( 'tg-page-header--left-right' );
					} else if ( 'tg-page-header--right-left' === layout ) {
						$( '.tg-page-header' ).removeClass( 'tg-page-header--left-right' ).removeClass( 'tg-page-header--both-center' ).removeClass( 'tg-page-header--both-left' ).removeClass( 'tg-page-header--both-right' ).addClass( 'tg-page-header--right-left' );
					} else if ( 'tg-page-header--both-center' === layout ) {
						$( '.tg-page-header' ).removeClass( 'tg-page-header--left-right' ).removeClass( 'tg-page-header--right-left' ).removeClass( 'tg-page-header--both-left' ).removeClass( 'tg-page-header--both-right' ).addClass( 'tg-page-header--both-center' );
					} else if ( 'tg-page-header--both-left' === layout ) {
						$( '.tg-page-header' ).removeClass( 'tg-page-header--left-right' ).removeClass( 'tg-page-header--right-left' ).removeClass( 'tg-page-header--both-center' ).removeClass( 'tg-page-header--both-right' ).addClass( 'tg-page-header--both-left' );
					} else if ( 'tg-page-header--both-right' === layout ) {
						$( '.tg-page-header' ).removeClass( 'tg-page-header--left-right' ).removeClass( 'tg-page-header--right-left' ).removeClass( 'tg-page-header--both-center' ).removeClass( 'tg-page-header--both-left' ).addClass( 'tg-page-header--both-right' );
					}
				}
			);
		}
	);

	wp.customize(
		'zakra_footer_bar_style',
		function ( value ) {
			value.bind( function ( layout ) {
				if ( 'tg-site-footer-bar--center' === layout ) {
					$( '.tg-site-footer-bar' ).removeClass( 'tg-site-footer-bar--left' ).addClass( 'tg-site-footer-bar--center' );
				} else if ( 'tg-site-footer-bar--left' === layout ) {
					$( '.tg-site-footer-bar' ).removeClass( 'tg-site-footer-bar--center' ).addClass( 'tg-site-footer-bar--left' );
				}
			} )
		}
	)
} )( jQuery );
