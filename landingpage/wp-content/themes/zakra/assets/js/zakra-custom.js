/**
 * Zakra Pro frontend JS file.
 *
 * @package Zakra_Pro
 * @since   1.4.7
 */

var ZakraFrontend = {
	toggleMenu: function( handleEl, targetEl, overlayWrapper, closeButton, toggleButton ) {

		handleEl.addEventListener(
			'click',
			function() {
				this.classList.toggle( 'tg-mobile-toggle--opened' );
				targetEl.classList.toggle( 'tg-mobile-navigation--opened' );

				if ( overlayWrapper ) {
					overlayWrapper.classList.toggle( 'overlay-show' );
				}

				// Mobile menu close button.
				if ( ! targetEl.getElementsByClassName( 'tg-mobile-navigation-close' ).length ) {

					// Insert the close icon as first child of menu.
					targetEl.insertBefore( closeButton, targetEl.childNodes[0] );
				}
			}
		);

		// Close menu when clicked outside.
		if ( overlayWrapper ) {
			overlayWrapper.addEventListener(
				'click',
				function() {
					this.classList.toggle( 'overlay-show' );
					toggleButton.classList.toggle( 'tg-mobile-toggle--opened' );
					targetEl.classList.toggle( 'tg-mobile-navigation--opened' );
				}
			);
		}

	}
};

window.zakraFrontend = ZakraFrontend;

/**
 * Only run scrips when the page is fully loaded.
 */
document.addEventListener(
	'DOMContentLoaded',
	function() {
		function mobileNavigation() {
			var menu           = document.getElementById( 'mobile-navigation' ),
				toggleButton   = document.querySelector( '.tg-mobile-toggle' ),
				overlayWrapper = document.querySelector( '.tg-overlay-wrapper' ),
				adminBar       = document.getElementById( 'wpadminbar' ),
				adminBarHeight,
				listItems,
				listItem,
				subMenuButton,
				subMenuToggle,
				closeButton,
				menuStyle,
				menuPaddingTop,
				i,
				focusableSelectors,
				focusableEl,
				firstEl,
				lastEl;

			// Create close icon element.
			closeButton = document.createElement( 'button' );
			closeButton.classList.add( 'tg-mobile-navigation-close' );
			closeButton.setAttribute( 'aria-label', 'Close Button' );

			if ( menu ) {
				listItems = menu.querySelectorAll(
					'li.page_item_has_children, li.menu-item-has-children'
				);

				if ( document.body.contains( adminBar ) ) {
					adminBarHeight = adminBar.getBoundingClientRect().height;
					menuStyle      = getComputedStyle( menu );
					menuPaddingTop = parseInt( menuStyle.paddingTop ) + adminBarHeight;

					closeButton.style.top = adminBarHeight + 'px';
					menu.style.paddingTop = menuPaddingTop + 'px';
				}
			}

			// Toggle mobile menu.
			if ( toggleButton && menu ) {
				closeButton.addEventListener(
					'click',
					function() {
						toggleButton.click();
					}
				);

				zakraFrontend.toggleMenu( toggleButton, menu, overlayWrapper, closeButton, toggleButton );

				toggleButton.addEventListener(
					'click',
					function() {
						focusableSelectors = 'a, button, input[type="search"]';
						focusableEl        = menu.querySelectorAll( focusableSelectors );
						focusableEl        = Array.prototype.slice.call( focusableEl );

						firstEl = focusableEl[0];
						lastEl  = focusableEl[focusableEl.length - 1];

						// Set focus to first element.
						setTimeout(
							function() {
								firstEl.focus();
							},
							100
						);

						// Loop focus while using tab and shift+tab key.
						menu.addEventListener(
							'keydown',
							function( e ) {
								if ( 'Tab' === e.key ) {
									if ( e.shiftKey ) {
										if ( document.activeElement === firstEl ) {
											e.preventDefault();
											lastEl.focus();
										}
									} else {
										if ( document.activeElement === lastEl ) {
											e.preventDefault();
											firstEl.focus();
										}
									}
								}
							}
						);
					}
				);
			}

			/* Sub Menu toggle */
			if ( listItems ) {
				var submenuCount = listItems.length;
				for ( i = 0; i < submenuCount; i++ ) {

					/* Add submenu toggle button */
					subMenuButton = document.createElement( 'button' );
					subMenuButton.classList.add( 'tg-submenu-toggle' );

					listItem = listItems[i];
					listItem.insertBefore( subMenuButton, listItem.childNodes[1] );

					/* Select the subMenutoggle */
					subMenuToggle = listItem.querySelector( '.tg-submenu-toggle' );

					if ( null !== subMenuToggle ) {
						subMenuToggle.addEventListener(
							'click',
							function( e ) {
								e.preventDefault();
								this.parentNode.classList.toggle( 'submenu--show' );
							}
						);
					}

					if ( null !== listItem.querySelector( 'a' ) ) {
						var link          = listItem.querySelector( 'a' ).getAttribute( 'href' );
						var listItem_link = listItem.querySelector( 'a' );

						if ( ! link || '#' === link ) {
							listItem_link.addEventListener(
								'click',
								function( e ) {
									menu.classList.toggle( 'tg-mobile-navigation--opened' );
									this.parentNode.classList.toggle( 'submenu--show' );
								}
							);
						}
					}
				}
			}
		}

		/**
		 * Scroll to top button.
		 */
		function scrollToTop() {
			var scrollToTopButton = document.getElementById( 'tg-scroll-to-top' );

			/* Only proceed when the button is present. */
			if ( scrollToTopButton ) {

				/* On scroll and show and hide button. */
				window.addEventListener(
					'scroll',
					function() {
						if ( 500 < window.scrollY ) {
							scrollToTopButton.classList.add( 'tg-scroll-to-top--show' );
						} else if ( 500 > window.scrollY ) {
							scrollToTopButton.classList.remove(
								'tg-scroll-to-top--show'
							);
						}
					}
				);

				/* Scroll to top when clicked on button. */
				scrollToTopButton.addEventListener(
					'click',
					function( e ) {
						e.preventDefault();

						/* Only scroll to top if we are not in top */
						if ( 0 !== window.scrollY ) {
							window.scrollTo(
								{
									top: 0,
									behavior: 'smooth'
								}
							);
						}
					}
				);
			}
		}

		try {
			mobileNavigation();
		} catch ( e ) {
			console.log( e.message );
		}

		scrollToTop();

		/**
		 * Search form.
		 */
		(
			function() {
				var searchIcon, searchBox, getClosest;

				searchIcon = document.querySelector( '.header-action-list .tg-menu-item-search > a' );
				searchBox  = document.querySelector( '.header-action-list .tg-menu-item-search' );

				getClosest = function( elem, selector ) {

					// Element.matches() polyfill
					if ( ! Element.prototype.matches ) {
						Element.prototype.matches =
							Element.prototype.matchesSelector ||
							Element.prototype.mozMatchesSelector ||
							Element.prototype.msMatchesSelector ||
							Element.prototype.oMatchesSelector ||
							Element.prototype.webkitMatchesSelector ||
							function( s ) {
								var matches = ( this.document || this.ownerDocument ).querySelectorAll( s ),
									i       = matches.length;

								while ( 0 <= --i && matches.item( i ) !== this ) { // TODO: Check and remove this empty loop
								}

								return -1 < i;
							};
					}

					// Get the closest matching element.
					for ( ; elem && elem !== document; elem = elem.parentNode ) {
						if ( elem.matches( selector ) ) {
							return elem;
						}
					}

					return null;

				};

				/**
				 * Show hide search form.
				 */
				function showHideSearchForm( action ) {

					// Hide search form.
					if ( 'hide' === action ) {
						searchBox.classList.remove( 'show-search' );
						return;
					}

					// Toggle search form.
					searchBox.classList.toggle( 'show-search' );

					// Autofocus.
					if ( searchBox.classList.contains( 'show-search' ) ) {
						searchBox.getElementsByTagName( 'input' )[0].focus();

						document.querySelector( '.tg-menu-item-search' ).addEventListener(
							'keydown',
							function( e ) {

								if ( ! e.shiftKey && ( 'Tab' === e.key ) && ( document.activeElement === searchBox.getElementsByTagName( 'input' )[0] ) ) {
									e.preventDefault();
									searchIcon.focus();
								}

								if ( e.shiftKey && ( 'Tab' === e.key ) && ( document.activeElement === searchIcon ) && searchBox.classList.contains( 'show-search' ) ) {
									e.preventDefault();
									searchBox.getElementsByTagName( 'input' )[0].focus();
								}
							}
						);
					}
				}

				// If icon exists.
				if ( null !== searchIcon ) {
					// on search icon click.
					searchIcon.addEventListener(
						'click',
						function( ev ) {
							ev.preventDefault();
							showHideSearchForm();
						}
					);

					// on click outside form.
					document.addEventListener(
						'click',
						function( ev ) {
							var closest = typeof( ev.target.closest );

							switch ( closest ) {
								case 'undefined':
									if ( getClosest( ev.target, '.tg-menu-item-search' ) || getClosest( ev.target, '.tg-icon-search' ) ) {
										return;
									}
								break;

								default:
									if ( ev.target.closest( '.tg-menu-item-search' ) || ev.target.closest( '.tg-icon-search' ) ) { // TODO: Unresolved function closest.
										return;
									}
								break;
							}
							showHideSearchForm( 'hide' );
						}
					);

					// on esc key.
					document.addEventListener(
						'keyup',
						function( e ) {
							if ( searchBox.classList.contains( 'show-search' ) && 'Escape' === e.key ) {
								showHideSearchForm( 'hide' );
							}
						}
					);
				}
			}()
		);

		/**
		 * Transparent Header.
		 */
		var body      = document.getElementsByTagName( 'body' )[0],
			headerTop = body.getElementsByClassName( 'tg-site-header-top' )[0];

		function transparentHeader( body, headerTop ) {
			var headerTopHt = headerTop.offsetHeight,
				main        = document.getElementById( 'main' ),
				footer      = document.getElementById( 'colophon' );

			main.style.position   = 'relative';
			main.style.top        = headerTopHt + 'px';
			footer.style.position = 'relative';
			footer.style.top      = headerTopHt + 'px';
		}

		if ( body.classList.contains( 'has-transparent-header' ) && ( 'undefined' != typeof headerTop ) && headerTop.classList.contains( 'tg-site-header-top' ) ) {
			transparentHeader( body, headerTop );
		}
	}
);
