<?php

use Elementor\Core\Files\CSS\Post;
use Elementor\Plugin;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Rb_E_Template' ) ) {
	class Rb_E_Template {

		protected static $instance = null;

		static function get_instance() {

			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function __construct() {

			self::$instance = $this;

			if ( ! foxiz_is_elementor_active() ) {
				return false;
			}

			add_action( 'init', [ $this, 'register_post_type' ], 2 );
			add_action( 'elementor/init', [ $this, 'enable_support' ] );
			add_shortcode( 'Ruby_E_Template', [ $this, 'render' ] );
			add_action( 'add_meta_boxes', [ $this, 'shortcode_info' ] );
			add_filter( 'manage_rb-etemplate_posts_columns', [ $this, 'add_column' ] );
			add_action( 'manage_rb-etemplate_posts_custom_column', [ $this, 'column_shortcode_info' ], 10, 2 );
			add_filter( 'template_include', [ $this, 'template' ], 99 );
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_style' ], 500 );
		}

		public function template( $template ) {

			global $post;
			if ( ! $post || ( 'rb-etemplate' !== get_post_type( $post ) ) ) {
				return $template;
			}

			$file_path = FOXIZ_CORE_PATH . 'e-template/single.php';
			if ( file_exists( $file_path ) ) {
				return $file_path;
			}
		}

		/**
		 * @param $attrs
		 *
		 * @return false|string
		 */
		function render( $attrs ) {

			$settings = shortcode_atts( [
				'id'   => '',
				'slug' => '',
			], $attrs );

			if ( ( empty( $settings['id'] ) && empty( $settings['slug'] ) ) || ! foxiz_is_elementor_active() || ! did_action( 'elementor/loaded' ) ) {
				return false;
			}

			/** fallback to slug if empty ID */
			if ( empty( $settings['id'] ) && ! empty( $settings['slug'] ) ) {
				$ids = get_posts( [
					'post_type'      => 'rb-etemplate',
					'posts_per_page' => 1,
					'name'           => $settings['slug'],
					'fields'         => 'ids',
				] );
				if ( ! empty( $ids[0] ) ) {
					$settings['id'] = $ids[0];
				}
			}

			if ( empty( $settings['id'] ) || foxiz_amp_suppressed_elementor() ) {
				return false;
			}

			return Plugin::instance()->frontend->get_builder_content_for_display( $settings['id'] );
		}

		/**
		 * load style
		 */
		function enqueue_style() {

			if ( ! class_exists( '\Elementor\Core\Files\CSS\Post' ) || foxiz_is_amp() ) {
				return;
			}

			$shortcodes = [];

			if ( foxiz_get_option( 'header_template' ) ) {
				$shortcodes['header_template'] = foxiz_get_option( 'header_template' );
			}
			if ( foxiz_get_option( 'footer_template_shortcode' ) ) {
				$shortcodes['footer_template'] = foxiz_get_option( 'footer_template_shortcode' );
			}
			if ( foxiz_get_option( 'mh_template' ) ) {
				$shortcodes[] = foxiz_get_option( 'mh_template' );
			}
			if ( foxiz_get_option( 'collapse_template' ) ) {
				$shortcodes[] = foxiz_get_option( 'collapse_template' );
			}

			if ( is_category() ) {

				$category_settings = rb_get_term_meta( 'foxiz_category_meta', get_queried_object_id() );

				if ( ! empty( $category_settings['template'] ) ) {
					$shortcodes[] = $category_settings['template'];
				} elseif ( foxiz_get_option( 'category_template' ) ) {
					$shortcodes[] = foxiz_get_option( 'category_template' );
				}

				if ( ! empty( $category_settings['template_global'] ) ) {
					$shortcodes[] = $category_settings['template_global'];
				} elseif ( foxiz_get_option( 'category_template_global' ) ) {
					$shortcodes[] = foxiz_get_option( 'category_template_global' );
				}

				if ( ! empty( $category_settings['header_template'] ) ) {
					$shortcodes['header_template'] = $category_settings['header_template'];
				} elseif ( foxiz_get_option( 'category_header_template' ) ) {
					$shortcodes['header_template'] = foxiz_get_option( 'category_header_template' );
				}
			} elseif ( is_tax( 'series' ) ) {

				$category_settings = rb_get_term_meta( 'foxiz_category_meta', get_queried_object_id() );

				if ( ! empty( $category_settings['template_global'] ) ) {
					$shortcodes[] = $category_settings['template_global'];
				} elseif ( foxiz_get_option( 'series_template_global' ) ) {
					$shortcodes[] = foxiz_get_option( 'series_template_global' );
				}

				if ( ! empty( $category_settings['header_template'] ) ) {
					$shortcodes['header_template'] = $category_settings['header_template'];
				} elseif ( foxiz_get_option( 'series_header_template' ) ) {
					$shortcodes['header_template'] = foxiz_get_option( 'series_header_template' );
				}
			} elseif ( is_search() ) {
				if ( foxiz_get_option( 'search_header_template' ) ) {
					$shortcodes['header_template'] = foxiz_get_option( 'search_header_template' );
				}
				if ( foxiz_get_option( 'search_template_global' ) ) {
					$shortcodes[] = foxiz_get_option( 'search_template_global' );
				}
			} elseif ( is_single() ) {

				if ( function_exists( 'foxiz_get_single_layout' ) ) {
					$layout = foxiz_get_single_layout();

					if ( ! empty( $layout['shortcode'] ) ) {
						$shortcodes[] = $layout['shortcode'];
					}
					$post_type = get_post_type();

					if ( 'post' === $post_type ) {
						if ( ! empty( $layout['format'] ) ) {
							switch ( $layout['format'] ) {
								case  'video':
									if ( foxiz_get_option( 'single_post_header_template_video' ) ) {
										$single_header_shortcode = foxiz_get_option( 'single_post_header_template_video' );
									}
									break;
								case  'audio':
									if ( foxiz_get_option( 'single_post_header_template_audio' ) ) {
										$single_header_shortcode = foxiz_get_option( 'single_post_header_template_audio' );
									}
									break;
								case 'gallery' :
									if ( foxiz_get_option( 'single_post_header_template_gallery' ) ) {
										$single_header_shortcode = foxiz_get_option( 'single_post_header_template_gallery' );
									}
									break;
							}
						}
					} elseif ( 'podcast' == $post_type ) {
						if ( foxiz_get_option( 'single_podcast_header_template' ) ) {
							$single_header_shortcode = foxiz_get_option( 'single_podcast_header_template' );
						}
					}

					if ( empty( $single_header_shortcode ) ) {
						$single_header_shortcode = foxiz_get_option( 'single_post_header_template' );
					}

					if ( ! empty( $single_header_shortcode ) ) {
						$shortcodes['header_template'] = $single_header_shortcode;
					}

					if ( ! empty( $layout['layout'] ) && 'stemplate' !== $layout['layout'] && function_exists( 'foxiz_get_single_setting' ) ) {

						$sidebar_name     = foxiz_get_single_setting( 'sidebar_name' );
						$sidebar_position = foxiz_get_single_sidebar_position();

						if ( ! empty( $sidebar_name ) && 'none' !== $sidebar_position ) {

							$sidebars_widgets = get_option( 'sidebars_widgets', [] );
							$widget_template  = get_option( 'widget_widget-template', [] );

							if ( ! empty( $sidebars_widgets[ $sidebar_name ] ) && ! empty( $widget_template ) ) {
								foreach ( $sidebars_widgets[ $sidebar_name ] as $widget ) {
									if ( strpos( $widget, 'widget-template' ) !== false ) {
										$widget_id = absint( str_replace( 'widget-template-', '', $widget ) );
										if ( ! empty( $widget_template[ $widget_id ]['shortcode'] ) ) {
											$shortcodes[] = trim( $widget_template[ $widget_id ]['shortcode'] );
										} elseif ( ! empty( $widget_template[ $widget_id ]['template_id'] ) ) {
											$shortcodes[] = '[Ruby_E_Template id="' . $widget_template[ $widget_id ]['template_id'] . '"]';
										}
									}
								}
							}
						}
					}
				}

				if ( foxiz_get_option( 'single_post_related_shortcode' ) ) {
					$shortcodes[] = foxiz_get_option( 'single_post_related_shortcode' );
				}
				if ( foxiz_get_option( 'single_post_popular_shortcode' ) ) {
					$shortcodes[] = foxiz_get_option( 'single_post_popular_shortcode' );
				}
			} elseif ( is_home() ) {
				if ( foxiz_get_option( 'blog_header_template' ) ) {
					$shortcodes['header_template'] = foxiz_get_option( 'blog_header_template' );
				}
				if ( foxiz_get_option( 'blog_template' ) ) {
					$shortcodes[] = foxiz_get_option( 'blog_template' );
				}
				if ( foxiz_get_option( 'blog_template_bottom' ) ) {
					$shortcodes[] = foxiz_get_option( 'blog_template_bottom' );
				}
				if ( foxiz_get_option( 'blog_template_global' ) ) {
					$shortcodes[] = foxiz_get_option( 'blog_template_global' );
				}
			} elseif ( is_tag() ) {

				$tag_settings = rb_get_term_meta( 'foxiz_tag_meta', get_queried_object_id() );
				if ( ! empty( $tag_settings['header_template'] ) ) {
					$shortcodes['header_template'] = $tag_settings['header_template'];
				}

				if ( ! empty( $tag_settings['template_global'] ) ) {
					$shortcodes[] = $tag_settings['template_global'];
				} else {
					$tag_template = foxiz_get_option( 'tag_template_global' );
					if ( empty( $tag_template ) ) {
						$tag_template = foxiz_get_option( 'archive_template_global' );
					}
					$shortcodes[] = $tag_template;
				}
			} elseif ( is_tax() ) {

				$tax_settings = rb_get_term_meta( 'foxiz_category_meta', get_queried_object_id() );
				if ( ! empty( $tax_settings['header_template'] ) ) {
					$shortcodes['header_template'] = $tax_settings['header_template'];
				}

				if ( ! empty( $tax_settings['template_global'] ) ) {
					$shortcodes[] = $tax_settings['template_global'];
				} else {
					$tax_template = foxiz_get_option( 'archive_template_global' );
					$shortcodes[] = $tax_template;
				}
			} elseif ( is_archive() ) {
				if ( foxiz_get_option( 'archive_template_global' ) ) {
					$shortcodes[] = foxiz_get_option( 'archive_template_global' );
				}
			} elseif ( is_404() ) {
				if ( foxiz_get_option( 'page_404_template' ) ) {
					$shortcodes[] = foxiz_get_option( 'page_404_template' );
				}
			} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
				if ( foxiz_get_option( 'wc_shop_template' ) ) {
					$shortcodes[] = foxiz_get_option( 'wc_shop_template' );
				}
			}

			if ( is_singular() ) {
				if ( is_page_template( 'bookmark.php' ) ) {
					$shortcodes[] = foxiz_get_option( 'saved_template' );
				}
				$header = rb_get_meta( 'header_template', get_the_ID() );
				$footer = rb_get_meta( 'footer_template', get_the_ID() );
				if ( ! empty( $header ) ) {
					$shortcodes['header_template'] = $header;
				}
				if ( ! empty( $footer ) ) {
					$shortcodes['footer_template'] = $footer;
				}
			}

			if ( count( $shortcodes ) ) {
				$elementor = Plugin::instance();
				$elementor->frontend->enqueue_styles();
				foreach ( $shortcodes as $shortcode ) {
					$shortcode = trim( $shortcode );
					if ( ! empty( $shortcode ) ) {
						preg_match( '/' . get_shortcode_regex() . '/s', $shortcode, $matches );
						if ( ! empty( $matches[3] ) ) {
							$atts = shortcode_parse_atts( $matches[3] );
							if ( ! empty( $atts['id'] ) ) {
								$css_file = new Post( $atts['id'] );
								$css_file->enqueue();
							} elseif ( ! empty( $atts['slug'] ) ) {
								$ids = get_posts( [
									'post_type'      => 'rb-etemplate',
									'posts_per_page' => 1,
									'name'           => $atts['slug'],
									'fields'         => 'ids',
								] );
								if ( ! empty( $ids[0] ) ) {
									$css_file = new Post( $ids[0] );
									$css_file->enqueue();
								}
							}
						}
					}
				}
			}
		}

		/** enable support for Elementor */
		function enable_support() {

			add_post_type_support( 'rb-etemplate', 'elementor' );
		}

		public function register_post_type() {

			register_post_type( 'rb-etemplate', [
				'labels'              => [
					'name'               => esc_html__( 'Ruby Templates', 'foxiz-core' ),
					'all_items'          => esc_html__( 'All Templates', 'foxiz-core' ),
					'menu_name'          => esc_html__( 'Ruby Templates', 'foxiz-core' ),
					'singular_name'      => esc_html__( 'Ruby Template', 'foxiz-core' ),
					'add_new'            => esc_html__( 'Add Template', 'foxiz-core' ),
					'add_item'           => esc_html__( 'New Template', 'foxiz-core' ),
					'add_new_item'       => esc_html__( 'Add New Template', 'foxiz-core' ),
					'new_item'           => esc_html__( 'Add New Template', 'foxiz-core' ),
					'edit_item'          => esc_html__( 'Edit Template', 'foxiz-core' ),
					'not_found'          => esc_html__( 'No template item found.', 'foxiz-core' ),
					'not_found_in_trash' => esc_html__( 'No template item found in Trash.', 'foxiz-core' ),
					'parent_item_colon'  => '',
				],
				'public'              => true,
				'has_archive'         => true,
				'can_export'          => true,
				'rewrite'             => false,
				'capability_type'     => 'post',
				'exclude_from_search' => true,
				'hierarchical'        => false,
				'menu_position'       => 5,
				'show_ui'             => true,
				'menu_icon'           => 'dashicons-art',
				'supports'            => [ 'title', 'editor' ],
			] );
		}

		function shortcode_info() {

			add_meta_box( 'rb_etemplate_info', 'Template Shortcode', [
				$this,
				'render_info',
			], 'rb-etemplate', 'side', 'high' );
		}

		function render_info( $post ) { ?>
			<h4 style="margin-bottom:5px;">shortcode Text</h4>
			<input type='text' class='widefat' value='[Ruby_E_Template id="<?php echo $post->ID; ?>"]' readonly="">
			<?php
		}

		function add_column( $columns ) {

			$columns['rb_e_shortcode'] = esc_html__( 'Template Shortcode', 'foxiz-core' );

			return $columns;
		}

		function column_shortcode_info( $column, $post_id ) {

			if ( 'rb_e_shortcode' === $column ) {
				echo '<input type="text" class="widefat" value=\'[Ruby_E_Template id="' . $post_id . '"]\' readonly="">';
			}
		}
	}
}

/** LOAD */
Rb_E_Template::get_instance();