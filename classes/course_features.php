<?php
class IMPCourseFeatures
{
    public ?int $price;
    public ?bool $isDiscounted;
    public ?int $discountPrice;
    public ?bool $recorded;
    public ?int $hours;
    public ?string $level;
    public ?int $rating;
    public ?string $currency;

    public function __construct(?int $price, ?bool $isDiscounted, ?int $discountPrice, ?bool $recorded, ?int $hours, ?string $level, ?int $rating, ?string $currency)
    {
        $this->price = $price != null ? $price : null;
        $this->isDiscounted = $isDiscounted != null ? $isDiscounted : null;
        $this->discountPrice = $discountPrice != null ? $discountPrice : null;
        $this->recorded = $recorded != null ? $recorded : null;
        $this->hours = $hours != null ? $hours : null;
        $this->level = $level != null ? $level : null;
        $this->rating = $rating != null ? $rating : null;
        $this->currency = $currency !== null ? $currency : null;
    }

    public function display_price()
    {
        get_template_part('templates/parts/course', 'price');
    }
}