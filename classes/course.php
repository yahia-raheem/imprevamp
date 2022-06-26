<?php if (!defined('ABSPATH')) die('-1');

class IMPCourse
{
    public int $courseId;
    public string $title;
    public string $excerpt;
    public string $content;
    public int $thumbnailId;
    public IMPCourseFeatures $features;
    public static $_current = null;

    public function __construct(int $courseId, string $title, string $excerpt, string $content, int $thumbnailId, IMPCourseFeatures $features)
    {
        $this->courseId = $courseId;
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->content = $content;
        $this->thumbnailId = $thumbnailId;
        $this->features = $features;
    }

    public static function init_by_id(int $courseId)
    {
        $post = get_post($courseId);
        $title = $post->post_title;
        $excerpt = $post->post_excerpt;
        $content = $post->post_content;
        $thumbnailId = get_post_thumbnail_id($courseId);
        $features = self::initiate_features($courseId);
        self::$_current = new self($courseId, $title, $excerpt, $content, $thumbnailId, $features);
        return self::$_current;
    }

    public static function get_current()
    {
        if (!is_null(self::$_current)) {
            return self::$_current;
        } else {
            return false;
        }
    }

    public function get_course_property(string $property)
    {
        if (is_null(self::$_current)) {
            return false;
        }
        return rwmb_meta($property, [], $this->courseId);
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
        $args = array('post_parent' => $this->courseId);
        return get_children($args);
    }

    private static function initiate_features($courseId): IMPCourseFeatures
    {
        $price = rwmb_meta('course_price', [], $courseId) != "" ? rwmb_meta('course_price', [], $courseId) : 0;
        $isDiscounted = rwmb_meta('is_discounted', [], $courseId);
        $discountPrice = $isDiscounted == true ? rwmb_meta('course_discount_price', [], $courseId) : null;
        $recorded = rwmb_meta('course_recorded', [], $courseId);
        $level = rwmb_meta('course_level', [], $courseId);
        $hours = rwmb_meta('course_hours', [], $courseId);
        return new IMPCourseFeatures($price, $isDiscounted, $discountPrice, $recorded, $hours, $level);
    }
}