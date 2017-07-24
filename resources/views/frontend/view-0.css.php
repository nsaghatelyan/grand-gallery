<?php
/**
 * @var $id_gallery \GDGallery\Models\Gallery
 * @var $gallery_data \GDGallery\Models\Gallery
 */



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
    padding: <?= $options["pagination_vertical_padding_justified"]; ?>px <?= $options["pagination_horisontal_padding_justified"]; ?>px !important;
    margin: <?= $options["pagination_margin_justified"]; ?>px !important;
    border: <?= $options["pagination_border_width_justified"]; ?>px solid #<?= $options["pagination_border_color_justified"]; ?> !important;
    border-radius: <?= $options["pagination_border_radius_justified"]; ?>px !important;
    color: #<?= $options["pagination_color_justified"]; ?> !important;
    background-color: #<?= $options["pagination_background_color_justified"]; ?> !important;
    font-family: <?= $options["pagination_font_family_justified"]; ?> !important;
}

<?= $pager ?> a:hover, <?= $pager ?> a.gdgallery-pagination-icon-active{
    color: #<?= $options["pagination_hover_color_justified"]; ?> !important;
    background-color: #<?= $options["pagination_hover_background_color_justified"]; ?> !important;
    border-color: #<?= $options["pagination_hover_border_color_justified"]; ?> !important;
}

<?= $container ?> .gdgallery_load_more_space{
    margin-top: 10px;
    text-align: <?= $options["load_more_position_justified"]; ?> !important;
}

<?= $container ?> .gdgallery_load_more_space button{
    font-size: <?= $options["load_more_font_size_justified"]; ?>px;
    background-color: #333 ;
    border:1px solid #333;
                  }
<?= $container ?> .gdgallery_load_more_space button:hover{
    background-color: #fff;
    color: #333;
                  }

<?= "</style>" ?>



