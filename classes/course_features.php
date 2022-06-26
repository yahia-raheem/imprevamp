<?php
class IMPCourseFeatures
{
    public int $price;
    public bool $isDiscounted;
    public ?int $discountPrice = null;
    public bool $recorded;
    public int $hours;
    public string $level;

    public function __construct(int $price, bool $isDiscounted, int $discountPrice, bool $recorded, int $hours, string $level)
    {
        $this->price = $price;
        $this->isDiscounted = $isDiscounted;
        $this->discountPrice = $discountPrice;
        $this->recorded = $recorded;
        $this->hours = $hours;
        $this->level = $level;
    }
}