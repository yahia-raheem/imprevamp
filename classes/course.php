<?php if (!defined('ABSPATH')) die('-1');

class IMPCourse
{
    public int $courseId;
    public int $price;
    public string $title;
    public string $excerpt;
    public string $content;
    public int $thumbnailId;
    public static $_current = null;

    public function __construct(int $courseId, int $price, string $title, string $excerpt, string $content, int $thumbnailId)
    {
        $this->courseId = $courseId;
        $this->price = $price;
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->content = $content;
        $this->thumbnailId = $thumbnailId;
    }

    public static function init_by_id(int $courseId)
    {
        $post = get_post($courseId);
        $price = rwmb_meta('course_price', [], $courseId) != "" ? rwmb_meta('course_price', [], $courseId) : 0;
        $title = $post->post_title;
        $excerpt = $post->post_excerpt;
        $content = $post->post_content;
        $thumbnailId = get_post_thumbnail_id($courseId);

        self::$_current = new self($courseId, $price, $title, $excerpt, $content, $thumbnailId);
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

    public function get_course_lectures()
    {
        if (is_null(self::$_current)) {
            return false;
        }
        $args = array('post_parent' => $this->courseId);
        return get_children($args);
    }
}