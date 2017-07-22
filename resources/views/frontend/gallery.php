<?php
/**
 * @var $gallery \GDGallery\Models\Gallery
 * @var $options \GDGallery\Models\Settings
 */


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
    <?php \GDGallery\Helpers\View::render('frontend/view-' . $view . '.php', compact('gallery_data', 'images'));
    \GDGallery\Helpers\View::render('frontend/view-' . $view . '.css.php', compact('id_gallery', 'gallery_data'));
    ?>
    <?php if (in_array($view, array(0, 1, 4))) {

        if ($gallery_data->display_type == 2) {
            \GDGallery\Helpers\View::render('frontend/pagination.php', compact('gallery_data', 'images'));
        } elseif ($gallery_data->display_type == 1) {
            ?>
            <div class="gdgallery_load_more_space">
                <button data-id="<?= $id_gallery ?>" data-count="<?= $gallery_data->items_per_page ?>"
                        class="gdgallery_load_more">Load more
                </button>
            </div>
        <?php }
    } ?>
</div>





