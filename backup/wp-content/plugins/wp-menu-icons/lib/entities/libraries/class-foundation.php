<?php

namespace QuadLayers\WPMI\Entities\Libraries;

use QuadLayers\WPMI\Entities\Libraries\Base as Library_Base;
use QuadLayers\WPMI\Entities\Libraries\Library as Library_Interface;


class Foundation extends Library_Base implements Library_Interface {

	public function __construct() {
		$this->name                = 'foundation';
		$this->label               = 'Foundation';
		$this->stylesheet_file_url = plugins_url( 'assets/frontend/icons/foundation/foundation-icons.min.css', WPMI_PLUGIN_FILE );
		$this->iconmap             = 'fi-address-book,fi-alert,fi-align-center,fi-align-justify,fi-align-left,fi-align-right,fi-anchor,fi-annotate,fi-archive,fi-arrow-down,fi-arrow-left,fi-arrow-right,fi-arrow-up,fi-arrows-compress,fi-arrows-expand,fi-arrows-in,fi-arrows-out,fi-asl,fi-asterisk,fi-at-sign,fi-background-color,fi-battery-empty,fi-battery-full,fi-battery-half,fi-bitcoin-circle,fi-bitcoin,fi-blind,fi-bluetooth,fi-bold,fi-book-bookmark,fi-book,fi-bookmark,fi-braille,fi-burst-new,fi-burst-sale,fi-burst,fi-calendar,fi-camera,fi-check,fi-checkbox,fi-clipboard-notes,fi-clipboard-pencil,fi-clipboard,fi-clock,fi-closed-caption,fi-cloud,fi-comment-minus,fi-comment-quotes,fi-comment-video,fi-comment,fi-comments,fi-compass,fi-contrast,fi-credit-card,fi-crop,fi-crown,fi-css3,fi-database,fi-die-five,fi-die-four,fi-die-one,fi-die-six,fi-die-three,fi-die-two,fi-dislike,fi-dollar-bill,fi-dollar,fi-download,fi-eject,fi-elevator,fi-euro,fi-eye,fi-fast-forward,fi-female-symbol,fi-female,fi-filter,fi-first-aid,fi-flag,fi-folder-add,fi-folder-lock,fi-folder,fi-foot,fi-foundation,fi-graph-bar,fi-graph-horizontal,fi-graph-pie,fi-graph-trend,fi-guide-dog,fi-hearing-aid,fi-heart,fi-home,fi-html5,fi-indent-less,fi-indent-more,fi-info,fi-italic,fi-key,fi-laptop,fi-layout,fi-lightbulb,fi-like,fi-link,fi-list-bullet,fi-list-number,fi-list-thumbnails,fi-list,fi-lock,fi-loop,fi-magnifying-glass,fi-mail,fi-male-female,fi-male-symbol,fi-male,fi-map,fi-marker,fi-megaphone,fi-microphone,fi-minus-circle,fi-minus,fi-mobile-signal,fi-mobile,fi-monitor,fi-mountains,fi-music,fi-next,fi-no-dogs,fi-no-smoking,fi-page-add,fi-page-copy,fi-page-csv,fi-page-delete,fi-page-doc,fi-page-edit,fi-page-export-csv,fi-page-export-doc,fi-page-export-pdf,fi-page-export,fi-page-filled,fi-page-multiple,fi-page-pdf,fi-page-remove,fi-page-search,fi-page,fi-paint-bucket,fi-paperclip,fi-pause,fi-paw,fi-paypal,fi-pencil,fi-photo,fi-play-circle,fi-play-video,fi-play,fi-plus,fi-pound,fi-power,fi-previous,fi-price-tag,fi-pricetag-multiple,fi-print,fi-prohibited,fi-projection-screen,fi-puzzle,fi-quote,fi-record,fi-refresh,fi-results-demographics,fi-results,fi-rewind-ten,fi-rewind,fi-rss,fi-safety-cone,fi-save,fi-share,fi-sheriff-badge,fi-shield,fi-shopping-bag,fi-shopping-cart,fi-shuffle,fi-skull,fi-social-500px,fi-social-adobe,fi-social-amazon,fi-social-android,fi-social-apple,fi-social-behance,fi-social-bing,fi-social-blogger,fi-social-delicious,fi-social-designer-news,fi-social-deviant-art,fi-social-digg,fi-social-dribbble,fi-social-drive,fi-social-dropbox,fi-social-evernote,fi-social-facebook,fi-social-flickr,fi-social-forrst,fi-social-foursquare,fi-social-game-center,fi-social-github,fi-social-google-plus,fi-social-hacker-news,fi-social-hi5,fi-social-instagram,fi-social-joomla,fi-social-lastfm,fi-social-linkedin,fi-social-medium,fi-social-myspace,fi-social-orkut,fi-social-path,fi-social-picasa,fi-social-pinterest,fi-social-rdio,fi-social-reddit,fi-social-skillshare,fi-social-skype,fi-social-smashing-mag,fi-social-snapchat,fi-social-spotify,fi-social-squidoo,fi-social-stack-overflow,fi-social-steam,fi-social-stumbleupon,fi-social-treehouse,fi-social-tumblr,fi-social-twitter,fi-social-vimeo,fi-social-windows,fi-social-xbox,fi-social-yahoo,fi-social-yelp,fi-social-youtube,fi-social-zerply,fi-social-zurb,fi-sound,fi-star,fi-stop,fi-strikethrough,fi-subscript,fi-superscript,fi-tablet-landscape,fi-tablet-portrait,fi-target-two,fi-target,fi-telephone-accessible,fi-telephone,fi-text-color,fi-thumbnails,fi-ticket,fi-torso-business,fi-torso-female,fi-torso,fi-torsos-all-female,fi-torsos-all,fi-torsos-female-male,fi-torsos-male-female,fi-torsos,fi-trash,fi-trees,fi-trophy,fi-underline,fi-universal-access,fi-unlink,fi-unlock,fi-upload-cloud,fi-upload,fi-usb,fi-video,fi-volume-none,fi-volume-strike,fi-volume,fi-web,fi-wheelchair,fi-widget,fi-wrench,fi-x-circle,fi-x,fi-yen,fi-zoom-in,fi-zoom-out';
		parent::__construct();
	}

	public function is_library_loaded() {
		return true;
	}

	public function get_folder_path() {
		return WPMI_PLUGIN_DIR . '/assets/icon-library/defaults';
	}
}