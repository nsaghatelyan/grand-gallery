<?php
/**
 * @var $id_gallery \GDGallery\Models\Gallery
 * @var $gallery_data \GDGallery\Models\Gallery
 */

$options = \GDGallery()->settings->getOptions();

$container = "#gdgallery-container-".$id_gallery;
$pager =  ".gdgallery-pagination-".$id_gallery;
$load = $container." .gdgallery_load_more";


echo "<style>";
?>

<?= $container ?> {
   text-align: <?= $gallery_data->position ?>
}

<?= $pager ?>{
text-align: <?= $options["pagination_position_justified"]; ?> !important;
}

<?= $pager ?> a{
    font-size: <?= $options["pagination_font_size_justified"]; ?>px !important;
    font-size: 16px !important;
    padding: 8px 13px;
    margin: 3px;
    border: 1px solid #333;
    color: #333;
    font-family: monospace;
}

<?= $pager ?> a:hover, <?= $pager ?> a.gdgallery-pagination-icon-active{
    color: #fff;
    background-color: #333;
}

<?= $container ?> .gdgallery_load_more_space{
    margin-top: 10px;
    text-align: <?= $options["load_more_position_justified"]; ?> !important;
}

<?= $container ?> .gdgallery_load_more_space button{
    font-size: <?= $options["load_more_font_size_justified"]; ?>px;
    background-color: #333;
    border:1px solid #333;
                  }
<?= $container ?> .gdgallery_load_more_space button:hover{
    background-color: #fff;
    color: #333;
                  }

<?= "</style>" ?>



