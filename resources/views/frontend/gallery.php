<?php
/**
 * @var $gallery \GDGallery\Models\Gallery
 * @var $options \GDGallery\Models\Settings
 */

$options = \GDGallery()->settings->getOptions();
$gallery_data = $gallery->getGallery();
$view = intval($gallery_data->view_type);
$id_gallery = $gallery->getId();
$images = array();


if (in_array($view, array(0, 1, 4))) {
    switch ($gallery_data->display_type) {
        case 0:
            $images = $gallery->getItems();
            break;
        case 1:
            $images = $gallery->getItemsPerPage($gallery_data);
            break;
        case 2:
            $images = $gallery->getItemsPerPage($gallery_data);
            break;
    }
} else {
    $images = $gallery->getItems();
}

?>
<div class="gdgallery-gallery-container" id="gdgallery-container-<?= $id_gallery ?>" data-id="<?= $id_gallery ?>">
    <?php \GDGallery\Helpers\View::render('frontend/view-' . $view . '.php', compact('gallery_data', 'images', 'options'));
    \GDGallery\Helpers\View::render('frontend/view-' . $view . '.css.php', compact('id_gallery', 'gallery_data', 'options'));
    ?>

</div>





