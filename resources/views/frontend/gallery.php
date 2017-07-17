<?php
/**
 * @var $gallery \GDGallery\Models\Gallery
 */


$id_gallery = $gallery->getId();
$gallery_data = $gallery->getGallery();
$images = $gallery->getItems();
$view = intval($gallery_data->view_type);

//debug::trace($gallery_data);
//debug::trace($images);

?>
<div class="gdgallery-gallery-container" id="gdgallery-container-<?= $id_gallery ?>">
    <?php \GDGallery\Helpers\View::render('frontend/view-' . $view . '.php', compact('gallery_data', 'images')); ?>
</div>





