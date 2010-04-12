<?php

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$bodyclasses = array();
if ($hassidepre && !$hassidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($hassidepost && !$hassidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$hassidepost && !$hassidepre) {
    $bodyclasses[] = 'content-only';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
  <title><?php echo $PAGE->title; ?></title>
  <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
  <?php echo $OUTPUT->standard_head_html() ?>
</head>
 
<body id="<?php echo $PAGE->bodyid ?>" class="<?php echo $PAGE->bodyclasses.' '.join(' ', $bodyclasses) ?>">

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php if ($hasheading || $hasnavbar) { ?>

<div id="page-wrapper">
  <div id="page" class="clearfix">
    
    <div id="page-header">
      <?php if ($PAGE->heading) { ?>
        <h1 class="headermain"><?php echo $PAGE->heading ?></h1>
        <div class="headermenu">
          <?php echo $OUTPUT->login_info();
          if (!empty($PAGE->layout_options['langmenu'])) {
            echo $OUTPUT->lang_menu();
          }
          echo $PAGE->headingmenu; ?>
        </div>
      <?php } ?>
    </div>

      
      <?php if ($hasnavbar) { ?>
        <div class="navbar clearfix">
          <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
          <div class="navbutton"> <?php echo $PAGE->button; ?></div>
        </div>
      <?php } ?>
  
<?php } ?>
      
    <div id="page-content">
      <div id="regions">
        <div id="regions-mask">
        
          <div id="region-main">
            <div id="region-main-mask">
              <div class="region-content">
                <?php echo core_renderer::MAIN_CONTENT_TOKEN ?>
              </div>
            </div>
          </div>
                
          <?php if ($hassidepre) { ?>
          <div id="region-pre">
            <div class="region-content">
              <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
            </div>
          </div>
          <?php } ?>

          <?php if ($hassidepost) { ?>
          <div id="region-post">
            <div class="region-content">
              <?php echo $OUTPUT->blocks_for_region('side-post') ?>
            </div>
          </div>
          <?php } ?>
              
        </div>
      </div>
    </div>
    
<?php if ($hasfooter) { ?>
  
    <div id="page-footer" class="clearfix">
      <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
      <?php
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
      ?>
    </div>

<?php }

if ($hasheading || $hasnavbar) { ?>
  
  </div> <!-- END #page -->
</div> <!-- END #page-wrapper -->

<?php } ?>
      

<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>