<?php if (!is_singular('jobpost')) : ?>
    <section class="inner-header has-bg">
        <div class="sec-bg d-none d-lg-flex align-end">
            <img src="<?php echo get_template_directory_uri() . '/dist/images/inner-sec-shadow.png'; ?>" alt="section shadow" loading="lazy">
        </div>
        <div class="sec-bg d-flex d-lg-none align-end">
            <img src="<?php echo get_template_directory_uri() . '/dist/images/inner-sec-shadow-mobile.png'; ?>" alt="section shadow" loading="lazy">
        </div>
    </section>
<?php endif; ?>