<?php

/**
 * @var $id_gallery \GDGallery\Models\Gallery
 * @var $gallery_data \GDGallery\Models\Gallery
 */

$container = "#gdgallery-container-".$id_gallery;

echo "<style>";
?>

<?= $container ?> a.ug-thumb-wrapper{
    box-shadow: none !important;
}


<?=  $gallery_data->custom_css; ?>
<?= "</style>" ?>
