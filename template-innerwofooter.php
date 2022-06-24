<?php

/**
 * Template Name: Inner Page (Without Footer Form)
 *
 */
get_header();
$pageTitle = rwmb_meta('page_title');
?>
<?php
if (!is_page('careers')) :


?>
    <header class="page-header first-level">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="prefix">
                        <?php echo get_the_title(); ?>
                    </span>
                    <h1 class="title">
                        <?php echo $pageTitle; ?>
                    </h1>
                </div>
            </div>
        </div>
    </header>
<?php endif; ?>
<?php
the_content();
get_footer();
?>