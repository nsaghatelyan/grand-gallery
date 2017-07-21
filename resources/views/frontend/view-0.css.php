<?php
/**
 * @var $id_gallery \GDGallery\Models\Gallery
 */

$options = \GDGallery()->settings->getOptions();

$container = "#gdgallery_container_".$id_gallery;
$pager =  ".gdgallery-pagination-".$id_gallery;



echo "<style>";
?>

<?= $container ?> .ug-thumb-wrapper .ug-thumb-overlay{
    background-color: rgba(243, 0, 0, 0.78) !important;
}

<?= $pager ?>{
text-align: <?= $options["pagination_position_justified"]; ?> !important;
}

<?= $pager ?> a{
    font-size: <?= $options["pagination_font_size_justified"]; ?>px !important;
              }

<?= "</style>" ?>



