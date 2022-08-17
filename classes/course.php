<?php if (!defined('ABSPATH')) die('-1');

class IMPCourse
{
    public int $courseId;
    public string $title;
    public string $excerpt;
    public string $content;
    public ?int $thumbnailId;
    public IMPCourseFeatures $features;
    public ?IMPInstructor $instructor;
    public static $_current = null;

    public function __construct(int $courseId, string $title, string $excerpt, string $content, ?int $thumbnailId, IMPCourseFeatures $features, ?IMPInstructor $instructor)
    {
        $this->courseId = $courseId;
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->content = $content;
        $this->thumbnailId = $thumbnailId != null ? $thumbnailId : null;
        $this->features = $features;
        $this->instructor = $instructor;
    }

    public static function init_by_id(int $courseId)
    {
        self::$_current = self::local_init_by_id($courseId);
        return self::$_current;
    }

    public static function local_init_by_id(int $courseId)
    {
        $post = get_post($courseId);
        $title = $post->post_title;
        $excerpt = $post->post_excerpt;
        $content = $post->post_content;
        $thumbnailId = get_post_thumbnail_id($courseId);
        $features = self::initiate_features($courseId);
        $instructorId = self::get_course_property('course_instructor', $courseId);
        $instructor = $instructorId != null ? IMPInstructor::get_by_id($instructorId) : null;
        return new self($courseId, $title, $excerpt, $content, $thumbnailId, $features, $instructor);
    }

    public static function get_current()
    {
        if (!is_null(self::$_current)) {
            return self::$_current;
        } else {
            return false;
        }
    }

    public function destroy_current()
    {
        if (!is_null(self::$_current)) {
            self::$_current = null;
        }
    }

    public static function get_course_property(string $property, int $courseId)
    {
        $fetchProperty = rwmb_meta($property, [], $courseId);
        return $fetchProperty != "" ? $fetchProperty : null;
    }

    public function get_course_categories()
    {
        if (is_null(self::$_current)) {
            return false;
        }
        return wp_get_post_terms($this->courseId, 'course-category');
    }

    public function get_course_lectures()
    {
        if (is_null(self::$_current)) {
            return false;
        }
        $args = array(
            'post_parent' => $this->courseId,
            'post_type' => 'lecture'
        );
        return get_children($args);
    }

    public function get_course_lectures_count()
    {
        if (is_null(self::$_current)) {
            return false;
        }
        $lectures = $this->get_course_lectures();
        return count($lectures);
    }

    public function get_course_reviews()
    {
        if (is_null(self::$_current)) {
            return false;
        }
        $comments = get_comments(['post_id' => $this->courseId]);
        return $comments;
    }

    public function get_course_reviews_count()
    {
        if (is_null(self::$_current)) {
            return false;
        }
        $comments = $this->get_course_reviews();
        return count($comments);
    }

    private static function initiate_features($courseId): IMPCourseFeatures
    {
        $price = self::get_course_property('course_price', $courseId);
        $isDiscounted = self::get_course_property('is_discounted', $courseId);
        $discountPrice = self::get_course_property('course_discount_price', $courseId);
        $recorded = self::get_course_property('course_recorded', $courseId);
        $level = self::get_course_property('course_level', $courseId);
        $hours = self::get_course_property('course_hours', $courseId);
        $rating = self::get_course_property('course_rating', $courseId);
        $currency = self::get_course_property('course_currency', $courseId);
        return new IMPCourseFeatures($price, $isDiscounted, $discountPrice, $recorded, $hours, $level, $rating, $currency);
    }

    public static function icon_language_flags($section = 'header') {
		if (function_exists('icl_get_languages')) {
			$languages = icl_get_languages('skip_missing=0&orderby=code');
			// print_r($languages);
			if (!empty($languages)) {
				foreach ($languages as $language) { ?>
					<?php if (!$language['active']) { ?>
					<div class="wbkz-languages-switcher  inline-module">			
						<a href="<?php echo esc_url($language['url'])?>">
							<span><?php echo esc_attr($language['native_name'])?></span>
						</a>					
					</div>
					<?php } ?>
				<?php }
			}
		}
	}

    public static function imp_string_limit_words($string, $word_limit) {
        $words = explode(' ', $string, ($word_limit + 1));
        if(count($words) > $word_limit) {
            array_pop($words);
        }
        return implode(' ', $words);
    }

    //Menu popup button
	public static function icon_popup_menu() {
		?>
		<div class="imp-side-menu-wrapper">
			<a class="imp-side-menu-button" href="javascript:void(0)">
				<span class="imp-side-menu-icon">
					<span class="imp-lines">
						<span class="imp-line imp-line-1"></span>
						<span class="imp-line imp-line-2"></span>
						<span class="imp-line imp-line-3"></span>
					</span>
				</span>
			</a>
		</div>
		<?php
		get_template_part( 'templates/header/popup-menu' );
	}

    public function icon_social_share_small() {
        $socials = array(
            'facebook',
            'twitter',
            'google',
            'linkedin',
            'pinterest',
            'whatsapp',
        );
        $socials = apply_filters( 'cps_social_share', $socials );?>
            <div class="social-share-button cps-social-icons cps_social_icon_style_1">
                <span class="social-shar-title"><?php echo esc_html__('Share', 'cps')?></span>
                <ul class="social-icons circular_shape small_shape background_shape">
                <?php if ( in_array( 'facebook', $socials ) ) : ?>
                    <li class="facebook-f"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <?php endif; ?>

                <?php if ( in_array( 'twitter', $socials ) ) : ?>
                    <li class="twitter"><a href="https://twitter.com/intent/tweet?url=<?php echo the_permalink(); ?>&text=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <?php endif; ?>

                <?php if ( in_array( 'google', $socials ) ) : ?>
                    <li class="google"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
                <?php endif; ?>

                <?php if ( in_array( 'pinterest', $socials ) ) : ?>
                    <li class="pinterest"><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=&amp;description=<?php echo rawurlencode(get_the_title()); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                <?php endif; ?>

                <?php if ( in_array( 'whatsapp', $socials ) ) : ?>
                    <li class="whatsapp"><a href="whatsapp://send?text=<?php the_permalink(); ?>" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                <?php endif; ?>

                </ul>
            </div>
        <?php
	}
    
}