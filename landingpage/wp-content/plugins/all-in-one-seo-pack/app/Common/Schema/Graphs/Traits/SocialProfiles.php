<?php
namespace AIOSEO\Plugin\Common\Schema\Graphs\Traits;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Trait that handles the social profiles.
 *
 * @since 4.2.2
 */
trait SocialProfiles {
	/**
	 * Returns the social media URLs for the author.
	 *
	 * @since 4.2.5
	 *
	 * @param  int   $authorId   The author ID.
	 * @return array $socialUrls The social media URLs.
	 */
	protected function socialUrls( $authorId = false ) {
		$socialUrls = [];
		if ( aioseo()->options->social->profiles->sameUsername->enable ) {
			$username = aioseo()->options->social->profiles->sameUsername->username;
			$urls = [
				'facebookPageUrl' => "https://facebook.com/$username",
				'twitterUrl'      => "https://twitter.com/$username",
				'instagramUrl'    => "https://instagram.com/$username",
				'pinterestUrl'    => "https://pinterest.com/$username",
				'youtubeUrl'      => "https://youtube.com/$username",
				'linkedinUrl'     => "https://linkedin.com/in/$username",
				'tumblrUrl'       => "https://$username.tumblr.com",
				'yelpPageUrl'     => "https://yelp.com/biz/$username",
				'soundCloudUrl'   => "https://soundcloud.com/$username",
				'wikipediaUrl'    => "https://en.wikipedia.org/wiki/$username",
				'myspaceUrl'      => "https://myspace.com/$username"
			];

			$included = aioseo()->options->social->profiles->sameUsername->included;
			foreach ( $urls as $name => $value ) {
				if ( in_array( $name, $included, true ) ) {
					$socialUrls[ $name ] = $value;
				} else {
					$notIncluded = aioseo()->options->social->profiles->urls->$name;
					if ( ! empty( $notIncluded ) ) {
						$socialUrls[ $name ] = $notIncluded;
					}
				}
			}
		} else {
			$socialUrls = [
				'facebookPageUrl' => aioseo()->options->social->profiles->urls->facebookPageUrl,
				'twitterUrl'      => aioseo()->options->social->profiles->urls->twitterUrl,
				'instagramUrl'    => aioseo()->options->social->profiles->urls->instagramUrl,
				'pinterestUrl'    => aioseo()->options->social->profiles->urls->pinterestUrl,
				'youtubeUrl'      => aioseo()->options->social->profiles->urls->youtubeUrl,
				'linkedinUrl'     => aioseo()->options->social->profiles->urls->linkedinUrl,
				'tumblrUrl'       => aioseo()->options->social->profiles->urls->tumblrUrl,
				'yelpPageUrl'     => aioseo()->options->social->profiles->urls->yelpPageUrl,
				'soundCloudUrl'   => aioseo()->options->social->profiles->urls->soundCloudUrl,
				'wikipediaUrl'    => aioseo()->options->social->profiles->urls->wikipediaUrl,
				'myspaceUrl'      => aioseo()->options->social->profiles->urls->myspaceUrl
			];
		}

		if ( ! $authorId ) {
			return array_values( array_filter( $socialUrls ) );
		}

		if ( aioseo()->options->social->facebook->general->showAuthor ) {
			$meta = get_the_author_meta( 'aioseo_facebook', $authorId );
			if ( $meta ) {
				$socialUrls['facebookPageUrl'] = $meta;
			}
		} else {
			$socialUrls['facebookPageUrl'] = '';
		}

		if ( aioseo()->options->social->twitter->general->showAuthor ) {
			$meta = get_the_author_meta( 'aioseo_twitter', $authorId );
			if ( $meta ) {
				$socialUrls['twitterUrl'] = $meta;
			}
		} else {
			$socialUrls['twitterUrl'] = '';
		}

		return array_values( array_filter( $socialUrls ) );
	}
}