<?php
// ==========================================================================================
// IMP Footer Teamplate
// @package Solik
// @author IMP
// @link https://imanagementpro.com
// ==========================================================================================
?>

<div class="container">
  <div class="row">
    <?php if (is_active_sidebar('footer_1')) { ?>
        <div class="col-md-3 col-12">
            <?php dynamic_sidebar('footer_1'); ?>
        </div>
    <?php } ?>
    <?php if (is_active_sidebar('footer_2')) { ?>
        <div class="col-md-3 col-6 text-center">
          <?php dynamic_sidebar('footer_2'); ?>
        </div>
    <?php } ?>
    <?php if (is_active_sidebar('footer_3')) { ?>
      <div class="col-md-3 col-6">
        <?php dynamic_sidebar('footer_3'); ?>
      </div>
    <?php } ?>
    <?php if (is_active_sidebar('footer_4')) { ?>
      <div class="col-md-3 col-6">
        <?php dynamic_sidebar('footer_4'); ?>
      </div>
    <?php } ?>
  </div>
</div>