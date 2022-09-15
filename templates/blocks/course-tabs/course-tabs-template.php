<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'single-course-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.attributes
$class = 'single-course ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
$hasPaddingTop = mb_get_block_field('has_padding_top');
$courseFaq = mb_get_block_field('course-faq');
$courseAnnouncement = mb_get_block_field('course-announcement');
$curriculumTabs = mb_get_block_field('curriculum-tabs');

$course = IMPCourse::get_current();
if ( ! is_admin() ) {
    $lectures = $course->get_course_lectures();
} else {
    // Runs only if this code is in a file that displays inside the admin panels, like a plugin file.
    echo '<div style="text-align: center">Welcome to your Admin Panels.</div>';
}

// $lectures = $course->get_course_lectures();
?>
<section id="<?= $id ?>" class="<?= $class ?> light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="home" aria-selected="true">
                            <?php echo esc_html__( 'Course Description', 'imp' )?>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <?php echo esc_html__( 'Curriculum', 'imp' )?>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab" aria-controls="contact" aria-selected="false">
                            <?php echo esc_html__( 'FAQ', 'imp' )?>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#announcement" type="button" role="tab" aria-controls="contact" aria-selected="false">
                            <?php echo esc_html__( 'Announcement', 'imp' )?>
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="home-tab">
                        <InnerBlocks/>
                    </div>
                    <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                        <div class="imp-curriculum-tab">
                            <?php foreach ($curriculumTabs as $key => $tab) { ?>
                                <h2><?php echo esc_attr( $tab['title'] )?></h2>
                                <?php foreach ($tab['course-curriculum-title'] as $key => $value) { ?>
                                    <div class="imp-accordion-curriculum-list">
                                        <div class="accordion">
                                            <?php if($value['type_select'][0] == 'video') { ?>
                                                <i class="fa-solid fa-circle-play"></i>
                                            <?php } elseif($value['type_select'][0] == 'quiz') { ?>
                                                <i class="fa-solid fa-message-question"></i>
                                            <?php } elseif($value['type_select'][0] == 'documents') { ?>
                                                <i class="fa-solid fa-file-lines"></i>
                                            <?php } elseif($value['type_select'][0] == '') { ?>
                                            <?php } ?>
                                                
                                            <p><?php echo esc_attr( $value['title'] )?></p>
                                        </div>
                                        <div class="panel">
                                            <?php echo do_shortcode(wpautop($value['description'])); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="contact-tab">
                        <?php foreach ($courseFaq as $index => $faq) : ?>
                            <div class="imp-accordion-list">
                                <div class="accordion"><?php echo esc_attr( $faq['title'] ); ?></div>
                                <div class="panel">
                                    <?php echo do_shortcode(wpautop($faq['description'])); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="tab-pane fade" id="announcement" role="tabpanel" aria-labelledby="contact-tab">
                        <?php foreach ($courseAnnouncement as $index => $announcement) : ?>
                            <div class="imp-announcement-list">
                                <?php echo do_shortcode(wpautop($announcement['description'])); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</section>