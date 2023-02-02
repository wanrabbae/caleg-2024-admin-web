/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 *
 * @package Zakra
 */

var ZakraNavHelper = {

	// Returns first children of a node.
	getChildNodes : function ( node ) {
		var children = [], child;

		for ( child in node.childNodes ) {
			if ( node.childNodes.hasOwnProperty( child ) && 1 === node.childNodes[child].nodeType ) {
				children.push( node.childNodes[child] );
			}
		}

		return children;
	},

	offset: function ( el ) {
		var rect       = el.getBoundingClientRect(),
		    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
		    scrollTop  = window.pageYOffset || document.documentElement.scrollTop;

		return {top: rect.top + scrollTop, left: rect.left + scrollLeft}
	},


	// Calculate the dimension of an element with margin, padding and content.
	dimension : function ( el ) {
		return parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'width' ) ) + parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'margin-left' ) ) + parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'padding-left' ) ) + parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'padding-right' ) ) + parseInt( document.defaultView.getComputedStyle( el, '' ).getPropertyValue( 'margin-right' ) );
	},

	getOverflowItems : function ( navLi ) {


		navigation.style.flex = '0 0 ' + navUlTempWidth + 'px';

		var extraLi = [];

		for ( var liCount = 0; liCount < navLi.length; liCount++ ) {
			var initialPos, li, posTop;

			li     = navLi[liCount];
			posTop = this.offset( li ).top;

			if ( 0 === liCount ) {
				initialPos = posTop;
			}

			if ( posTop > initialPos ) {
				if ( ! li.classList.contains( 'tg-menu-item-search' ) && ! li.classList.contains( 'tg-menu-item-cart' ) &&
					! li.classList.contains( 'tg-header-button-wrap' ) && ! li.classList.contains( 'tg-menu-extras-wrap' )
				) {
					extraLi.push( li );
				}
			}
		}

		return extraLi;
	}
};

window.zakraNavHelper = ZakraNavHelper;

(
	function () {
		var container, menu, links, i, len;

		container = document.getElementById( 'site-navigation' );

		if ( ! container ) {
			return;
		}

		menu = container.getElementsByTagName( 'ul' )[0];

		menu.setAttribute( 'aria-expanded', 'false' );

		if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
			menu.className += ' nav-menu';
		}

		// Get all the link elements within the menu.
		links = menu.getElementsByTagName( 'a' );

		// Each time a menu link is focused or blurred, toggle focus.
		for ( i = 0, len = links.length; i < len; i++ ) {
			links[i].addEventListener( 'focus', toggleFocus, true );
			links[i].addEventListener( 'blur', toggleFocus, true );
		}

		/**
		 * Sets or removes .focus class on an element.
		 */
		function toggleFocus() {
			var self = this;

			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					if ( -1 !== self.className.indexOf( 'focus' ) ) {
						self.className = self.className.replace( ' focus', '' );
					} else {
						self.className += ' focus';
					}
				}

				self = self.parentElement;
			}
		}

		/**
		 * Toggles `focus` class to allow submenu access on tablets.
		 */
		(
			function ( container ) {
				var touchStartFn, i,
					parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' ),
					supportsPassive = false;;
				try {
					var opts = Object.defineProperty( {}, 'passive', {
						get: function() {
							supportsPassive = true;
						}
					} );
					window.addEventListener( "testPassive", null, opts );
					window.removeEventListener( "testPassive", null, opts );
				} catch (e) {}

				if ( 'ontouchstart' in window ) {
					touchStartFn = function ( e ) {
						var i,
							menuItem = this.parentNode;

						if ( ! menuItem.classList.contains( 'focus' ) ) {
							e.preventDefault();

							for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
								if ( menuItem === menuItem.parentNode.children[i] ) {
									continue;
								}

								menuItem.parentNode.children[i].classList.remove( 'focus' );
							}
							menuItem.classList.add( 'focus' );
						} else {
							menuItem.classList.remove( 'focus' );
						}
					};

					for ( i = 0; i < parentLink.length; ++i ) {
						parentLink[i].addEventListener( 'touchstart', touchStartFn, supportsPassive ? { passive: true } : false );
					}
				}
			}( container )
		);
	}()
);


/**
 * Fixes menu out of viewport
 */
(
	function () {
		var i, elEvent;

		var elWithChildren = document.querySelectorAll( '.tg-primary-menu li.menu-item-has-children, .tg-primary-menu li.page_item_has_children' ),
			elCount        = elWithChildren.length,
			elEvent        = isTouchDevice() ? 'touchstart' : 'mouseenter';

		/**
		 * @see https://stackoverflow.com/questions/123999/how-can-i-tell-if-a-dom-element-is-visible-in-the-current-viewport/7557433#7557433
		 */
		function isElementInViewport( el ) {
			var rect = el.getBoundingClientRect();

			return (
				0 <= rect.left &&
				rect.right <= (
					( window.innerWidth - 10 ) || ( document.documentElement.clientWidth - 10 )
				)
			);
		}

		// Checks whether user uses touch device or not.
		function isTouchDevice() {
			return 'ontouchstart' in window || navigator.maxTouchPoints;
		};

		// Loop through li having sub menu.
		for ( i = 0; i < elCount; i++ ) {

			// On mouse enter.
			elWithChildren[i].addEventListener( elEvent, function ( ev ) {
				var li = ev.currentTarget,
					subMenu;

				if ( li ) {

					subMenu = li.querySelectorAll( '.sub-menu, .children' )[0];

					if ( subMenu ) {
						if ( ! isElementInViewport( subMenu ) ) {
							subMenu.classList.add( 'tg-edge' );
						}
					}
				}
			}, false );

			// On mouse leave.
			elWithChildren[i].addEventListener( 'mouseleave', function ( ev ) {
				var li = ev.currentTarget,
					sub;

				if ( li ) {
					sub = li.querySelectorAll( '.sub-menu, .children' )[0];

					sub.classList.remove( 'tg-edge' );

					if ( sub.classList.contains( 'tg-edge' ) ) {
						sub.classList.remove( 'tg-edge' );
					}
				}
			}, false );
		} // End: for ( i in elWithChildren ) {

	}
)();

/**
 * Keep menu items on one line.
 */
(
	function () {

		// Get required elements.
		var more, search, cart, button, button2, searchWidth, cartWidth, buttonWidth, moreWidth, navUl, navLi,
			navLiWidth, extraWrap, navWrapWidth, overflowItems;

		navigation = document.getElementById( 'site-navigation' );

		// Return if no navigation markup.
		if ( null === navigation ) {
			return;
		}

		// Return if `Keep Menu Items on One Line` customizer option is not enabled
		if ( ! navigation.classList.contains( 'tg-extra-menus' ) ) {
			return;
		}

		// Extra ellipsis icon added via PHP.
		more      = navigation.getElementsByClassName( 'tg-menu-extras-wrap' )[0];

		// Ul to append extra menu items.
		extraWrap = document.getElementById( 'tg-menu-extras' );

		// No primary menu assigned.
		if ( null === extraWrap ) {
			return;
		}

		navUl = navigation.getElementsByClassName( 'nav-menu' )[0];

		navLi = ZakraNavHelper.getChildNodes( navUl );

		navWrapWidth = navigation.offsetWidth;

		search      = navigation.getElementsByClassName( 'tg-menu-item-search' )[0];
		cart        = navigation.getElementsByClassName( 'tg-menu-item-cart' )[0];
		button      = navigation.getElementsByClassName( 'tg-header-button-wrap' )[0];
		button2     = navigation.getElementsByClassName( 'tg-header-button-wrap' )[1];

		searchWidth = search ? ZakraNavHelper.dimension( search ) : 0;
		cartWidth   = cart ? ZakraNavHelper.dimension( cart ) : 0;
		buttonWidth = button ? ZakraNavHelper.dimension( button ) : 0;
		buttonWidth += button2 ? ZakraNavHelper.dimension( button2 ) : 0;
		moreWidth   = more ? ZakraNavHelper.dimension( more ) : 0;

		navUlTempWidth = navWrapWidth - ( searchWidth + cartWidth + buttonWidth + moreWidth );

		navLiWidth = 0;

		navLi.forEach( function ( menuItem, index  ) {
			navLiWidth += ZakraNavHelper.dimension( menuItem );
		} );

		// If overflow.
		if ( navLiWidth > navWrapWidth ) {

			overflowItems = ZakraNavHelper.getOverflowItems( navLi );

			overflowItems.forEach( function ( item ) {
				extraWrap.appendChild( item );
			});

		} else {

			// Remove ellipsis icon for more.
			more.parentNode.removeChild( more );
		}

		navigation.style.flex = '';
	}()
);

/**
 * Close mobile menu on clicking menu items.
 */
(
	function () {
		var mobMenuItems      = document.querySelectorAll( '#mobile-navigation li a' ),
			toggleButton      = document.querySelector( '.tg-mobile-toggle' ),
			mobMenuItemsCount = mobMenuItems.length,
			item;

		for ( var i = 0; i < mobMenuItemsCount; i++ ) {
			item = mobMenuItems[i];

			item.addEventListener(
				'click',
				function () {
					toggleButton.click();
				}
			);
		}
	}()
);

