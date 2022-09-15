<?php
$course = IMPCourse::get_current();
if ($course instanceof IMPCourse) :
?>
<?php if ($course->features->isDiscounted) {$discounted = 'discounted';} else { $discounted = '';}?>
<?php
    if($course->features->isDiscounted) {
        echo $course->features->discountPrice;
    } else {
        echo $course->features->price;
    }
    // if ($course->features->price) {
    //     echo $course->features->price;
    // } else {
    //     echo $course->features->discountPrice;
    // }
?>
<?php
else : return;
endif;
?>