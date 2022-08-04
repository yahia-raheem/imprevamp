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
        $args = array('post_parent' => $this->courseId);
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
}