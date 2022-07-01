<?php
class IMPInstructor
{
    public int $instructorId;
    public string $instructorName;
    public int $thumbnailId;

    public function __construct(int $instructorId, string $instructorName, int $thumbnailId)
    {
        $this->instructorId = $instructorId;
        $this->instructorName = $instructorName;
        $this->thumbnailId = $thumbnailId;
    }

    public static function get_by_id(int $instructorId)
    {
        $post = get_post($instructorId);
        $instructorName = $post->post_title;
        $thumbnailId = get_post_thumbnail_id($instructorId);
        return new self($instructorId, $instructorName, $thumbnailId);
    }
}