<?php
/**
 * @var $tabs array()
 * @var $sections array()
 * @var $fields array()
 * @var $title string
 */

?>


<div id="<?= $id ?>">
    <?php foreach ($sections as $id => $section):
        if ($section["tab"] == $id):
         \GDGallery\Helpers\View::render('admin/settings/section.view.php', compact('section', 'id','fields'));
        endif;
    endforeach; ?>
</div>


