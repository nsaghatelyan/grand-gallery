<?php
/**
 * Template for edit gallery page
 * @var $gallery \GDGallery\Models\Gallery
 */

use GDGallery\Controllers\Frontend\GalleryPreviewController as Preview;

global $wpdb;

$gallery->setViewStyles();

$items = $gallery->getItems(true);

$gallery_data = $gallery->getGallery();

$list = $gallery->getGalleriesUrl();

$new_gallery_link = admin_url('admin.php?page=gdgallery&task=create_new_gallery');

$new_gallery_link = wp_nonce_url($new_gallery_link, 'gdgallery_create_new_gallery');

$id = $gallery->getId();


$save_data_nonce = wp_create_nonce('gdgallery_nonce_save_data' . $id);

if (in_array($gallery_data->view_type, array(0, 1))) {

}

$display_opt = (in_array($gallery_data->view_type, array(0, 1))) ? "" : "gdgallery_hidden";

?>

<ul class="switch_gallery">
    <?php foreach ($list as $val): ?>
        <?php if ($val["id_gallery"] == $id): ?>
            <li class='active_gallery' id='gdgallery_active'>
                <a href="#" id="gdgallery_edit_name"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                <a href="<?= $val["url"] ?>" id="gallery_active_name"><?= stripslashes($val["name"]) ?></a>
                <input type='text' name='edit_name' id='edit_name_input' value='<?= stripslashes($val["name"]) ?>'
                       class="gdgallery_hidden">
            </li>
        <?php else: ?>
            <li>
                <a href="<?= $val["url"] ?>"><?= $val["name"] ?></a>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
    <li class="add_gallery_li">
        <a href="<?= $new_gallery_link ?>"><?= __('ADD GALLERY', 'gdgallery') ?> <i class="fa fa-plus"
                                                                                    aria-hidden="true"></i></a>
    </li>
</ul>
<form action="admin.php?page=gdgallery&id=<?php echo $id; ?>&save_data_nonce=<?php echo $save_data_nonce; ?>"
      method="post" name="gdgallery_images_form" id="gdgallery_images_form">
    <div class="wrap gdgallery_edit_gallery_container">
        <div class="gdgallery_nav">


            <div id="gdgallery_tabs">
                <div style="clear: both"></div>
                <div class="settings-toogled-container">

                    <ul class="gdgallery_tabs">
                        <li class="Tabs__tab gdgallery_active_Tab gdgallery_Tab">
                            <a href="#gdgallery_gallery_style"><?php _e('Gallery Style', 'gdgallery'); ?></a>
                        </li>
                        <li class="Tabs__tab gdgallery_Tab">
                            <a href="#gdgallery_general_settings"><?php _e('General Settings', 'gdgallery'); ?></a>
                        </li>
                        <li class="Tabs__tab gdgallery_Tab">
                            <a href="#gdgallery_custom_css"><?php _e('Custom CSS', 'gdgallery'); ?></a>
                        </li>
                        <li class="Tabs__tab gdgallery_Tab">
                            <a href="#gdgallery_get_shortcode"><?php _e('Get shortcode', 'gdgallery'); ?></a>
                        </li>
                        <li class="Tabs__presentation-slider" role="presentation"></li>
                        <a href="<?php echo Preview::previewUrl($gallery->getId(), false); ?>"
                           class="single_gallery_preview" target="_blank"><?php _e('Preview Changes', 'gdgallery'); ?>
                            <img
                                    src="<?= GDGALLERY_IMAGES_URL ?>icons/preview.png"></a>
                        <input type="submit" value="<?= _e('Save', 'gdgallery'); ?>"
                               id="gdgallery-save-buttom"
                               class="gdgallery-save-buttom gdgallery-save-all">
                        <span class="spinner"></span>

                    </ul>
                    <div id="gdgallery_gallery_style" style="display: none;">
                        <?php foreach ($gallery->getViewStyles() as $key => $view): ?>
                            <div class="gdgallery_view_item <?php if ($gallery_data->view_type == $key) echo "checked_view" ?>">
                                <label>
                                    <p><?= $view[0] ?></p>
                                    <input type="radio" <?php if ($gallery_data->view_type == $key) echo "checked" ?>
                                           name="gdgallery_view_type" value="<?= $key ?>"/>
                                    <img src="<?= $view[1] ?>">

                                </label>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <div id="gdgallery_general_settings">
                        <div class="gallery_title_div">
                            <input type="text" id="gallery_name" name="gdgallery_name"
                                   value="<?php if ($gallery->getName() != "(no title)") echo $gallery->getName(); ?>"
                                   placeholder="<?= _e('Name Your Gallery', 'gdgallery'); ?>">
                            <input type="hidden" id="gdgallery_id_gallery" name="gdgallery_id_gallery"
                                   value="<?php echo $id ?>">

                        </div>
                        <ul class="gdgallery_general_settings">
                            <li class="gdgallery_display_type_section <?= $display_opt ?>">
                                <h4><?= _e('Content Display Type', 'gdgallery'); ?></h4>
                                <select name="gdgallery_display_type" id="gdgallery_display_type">
                                    <option value="0" <?php if ($gallery_data->display_type == 0) echo "selected" ?>>
                                        <?= _e('Show All', 'gdgallery'); ?>
                                    </option>
                                    <option value="1" <?php if ($gallery_data->display_type == 1) echo "selected" ?>>
                                        <?= _e('Load more', 'gdgallery'); ?>
                                    </option>
                                    <option value="2" <?php if ($gallery_data->display_type == 2) echo "selected" ?>>
                                        <?= _e('Pagination', 'gdgallery'); ?>
                                    </option>
                                </select>
                            </li>
                            <li class="gdgallery_items_per_page_section <?php if ($gallery_data->display_type == 0) echo "gdgallery_hidden" ?>  <?= $display_opt ?>">
                                <h4>  <?= _e('Items Per Page', 'gdgallery'); ?></h4>
                                <input type="number" min="0" max="100" name="gdgallery_items_per_page"
                                       id="gdgallery_items_per_page" class="gdgallery_items_per_page"
                                       value="<?= $gallery_data->items_per_page ?>">
                            </li>
                            <li class="gdgallery_sorting_section">
                                <h4><?= _e('', 'gdgallery'); ?></h4>
                                <select name="gdgallery_sort_by" id="gdgallery_sorting">
                                    <option value="0" <?php if ($gallery_data->sort_by == 0) echo "selected" ?>>
                                        <?= _e('Custom Sorting', 'gdgallery'); ?>
                                    </option>
                                    <option value="1" <?php if ($gallery_data->sort_by == 1) echo "selected" ?>>
                                        <?= _e('Alphabetical', 'gdgallery'); ?>
                                    </option>
                                    <option value="2" <?php if ($gallery_data->sort_by == 2) echo "selected" ?>>
                                        <?= _e('Insert Date', 'gdgallery'); ?>
                                    </option>
                                </select>
                            </li>
                            <li class="gdgallery_ordering_section">
                                <h4><?= _e('Image order', 'gdgallery'); ?></h4>
                                <select name="gdgallery_order_by" id="gdgallery_ordering">
                                    <option value="0" <?php if ($gallery_data->order_by == 0) echo "selected" ?>>
                                        <?= _e('Ascending', 'gdgallery'); ?>
                                    </option>
                                    <option value="1" <?php if ($gallery_data->order_by == 1) echo "selected" ?>>
                                        <?= _e('Descending', 'gdgallery'); ?>
                                    </option>
                                </select>
                            </li>

                        </ul>


                    </div>

                    <div id="gdgallery_custom_css">
                        <div class="custom_css_col">
                            <textarea cols="8" name="custom_css"><?php
                                if ($gallery_data->custom_css != "") {
                                    echo stripslashes($gallery_data->custom_css);
                                } else {
                                    echo "#gdgallery_container_" . $id . "{}";
                                }
                                ?></textarea>
                        </div>
                    </div>
                    <div id="gdgallery_get_shortcode">
                        <div class="gdgallery_shortcode_types">
                            <div class="gdgallery_example">
                                <h3> <?= _e('Shortcode', 'gdgallery'); ?></h3>
                                <p> <?= _e('Copy and paste this shortcode into your posts or pages.', 'gdgallery'); ?></p>
                                <div class="gdgallery_highlighted">
                                    <span id="gdgallery_editor_code">[gdgallery_gallery id_gallery=<?= $id ?>]</span>
                                    <a href="#" onclick="copyToClipboard('gdgallery_editor_code')"
                                       class="copy_shortcode" title="<?= _e('Copy shortecode', 'gdgallery'); ?>"><i
                                                class="fa fa-files-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="gdgallery_example">
                                <h3><?= _e('Post and/or Page', 'gdgallery'); ?></h3>
                                <p> <?= _e('Insert regular shortcode to post/page using this icon', 'gdgallery'); ?></p>
                                <img src="<?= GDGALLERY_IMAGES_URL ?>page_editor.png">
                            </div>
                            <div class="gdgallery_example">
                                <h3> <?= _e('PHP Shortcode', 'gdgallery'); ?></h3>
                                <p> <?= _e('Paste the PHP Shortcode into your template file', 'gdgallery'); ?></p>
                                <div class="gdgallery_highlighted">
                                    <span id="gdgallery_php_code">
                                    &lt;?php <br>
                                    echo do_shortcode('[gdgallery_gallery id_gallery=<?= $id ?>]'); <br>
                                    ?&gt;
                                    </span>
                                    <a href="#" onclick="copyToClipboard('gdgallery_php_code')"
                                       class="copy_shortcode" title="<?= _e('Copy PHP script', 'gdgallery'); ?>"><i
                                                class="fa fa-files-o" aria-hidden="true"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="gdgallery_items_section">
                <?php if (!empty($items)) { ?>
                    <p class="gdgallery_select_all_items">
                        <label for="gdgallery_select_all_items"> <?= _e('Select All', 'gdgallery'); ?></label> <input
                                type="checkbox"
                                id="gdgallery_select_all_items"
                                name="select_all_items"/>
                    </p>
                    <a href="#"
                       class="gdgallery_remove_selected_images">  <?= _e('Remove selected items', 'gdgallery'); ?> <i
                                class="fa fa-times"
                                aria-hidden="true"></i></a>
                    <a href="#" class="gdgallery_edit_gallery_images">  <?= _e('Quick edit', 'gdgallery'); ?> <i
                                class="fa fa-pencil"
                                aria-hidden="true"></i></a>
                <?php } ?>
                <div class="gdgallery_clearfix"></div>
                <div class="gdgallery_add_new gdgallery_add_new_image" id="_unique_name_button">
                    <div class="gdgallery_add_new_plus"></div>
                    <p>  <?= _e('NEW IMAGE', 'gdgallery'); ?></p>
                </div>
                <div class="gdgallery_add_new gdgallery_add_new_video">
                    <div class="gdgallery_add_new_plus"></div>
                    <p> <?= _e('NEW VIDEO', 'gdgallery'); ?></p>
                </div>

                <div class="gdgallery_items_list">
                    <div class="empty_space">

                    </div>
                    <?php
                    if (!empty($items)) {
                        foreach ($items as $item):
                            $icon = ($item->type == "youtube") ? "fa-youtube-play" : (($item->type == "vimeo") ? "fa-vimeo" : "fa-picture-o");
                            ?>
                            <div class="gdgallery_item" style="background-image: url('<?= $item->url ?>');">
                                <input type="hidden"
                                       name="gdgallery_ordering[<?= $item->id_image ?>]"
                                       value="<?= $item->ordering ?>">

                                <p class="gdgallery_item_title"><?= $item->name ?>
                                    <i class="fa <?= $icon ?>" aria-hidden="true"></i></p>
                                <div class="gdgallery_item_overlay">
                                    <input type="checkbox" name="items[]"
                                           value="<?= $item->id_image; ?>" class="items_checkbox"/>
                                    <div class="gdgallery_item_edit">
                                        <a href="<?php echo ($item->id_post != 0) ? admin_url() . "post.php?post=" . $item->id_post . "&action=edit&image-editor" : "#"; ?>"
                                           target="_blank" data-post-id="<?= $item->id_post ?>"
                                           data-image-id="<?= $item->id_image ?>"> <?= _e('EDIT', 'gdgallery'); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    } else {
                        echo "No items in this gallery";
                    } ?>
                </div>
            </div>
        </div>
</form>
<?php \GDGallery\Helpers\View::render('admin/add-video.php', array('id_gallery' => $id, "save_data_nonce" => $save_data_nonce)); ?>
<?php \GDGallery\Helpers\View::render('admin/edit-images.php', array('items' => $items, 'id_gallery' => $id, "save_data_nonce" => $save_data_nonce)); ?>
<style>


    .list-item {
        position: absolute;
        top: 0;
        left: 0;
        height: 140px;
        width: 240px;
    }

    .item-content {
        height: 100%;
        border: 0px solid rgba(123, 123, 123, 0.498039);
        border-radius: 4px;
        color: rgb(153, 153, 153);
        line-height: 140px;
        padding-left: 32px;
        font-size: 24px;
        font-weight: 400;
        background-color: rgb(255, 255, 255);
        box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 2px 0px;
    }


</style>

<section class="container">

    <div class="list-item" id="alpha">
        <div class="item-content">
            <span class="order">1</span> Alpha
        </div>
    </div>

    <div class="list-item" id="bravo">
        <div class="item-content">
            <span class="order">2</span> Bravo
        </div>
    </div>

    <div class="list-item" id="charlie">
        <div class="item-content">
            <span class="order">3</span> Charlie
        </div>
    </div>

    <div class="list-item" id="delta">
        <div class="item-content">
            <span class="order">4</span> Delta
        </div>
    </div>

    <div class="list-item" id="echo">
        <div class="item-content">
            <span class="order">5</span> Echo
        </div>
    </div>

    <div class="list-item" id="foxtrot">
        <div class="item-content">
            <span class="order">6</span> Foxtrot
        </div>
    </div>

    <div class="list-item" id="gulf">
        <div class="item-content">
            <span class="order">7</span> Gulf
        </div>
    </div>

    <div class="list-item" id="hotel">
        <div class="item-content">
            <span class="order">8</span> Hotel
        </div>
    </div>

    <div class="list-item" id="india">
        <div class="item-content">
            <span class="order">9</span> India
        </div>
    </div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenLite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/utils/Draggable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/plugins/CSSPlugin.min.js"></script>

<script type="text/javascript">
    // List version
    // https://codepen.io/osublake/pen/jrqjdy/

    var rowSize = 150;
    var colSize = 250;
    var totalRows = 3;
    var totalCols = 3;

    var cells = [];

    // Map cell locations to array
    for (var row = 0; row < totalRows; row++) {
        for (var col = 0; col < totalCols; col++) {
            cells.push({
                row: row,
                col: col,
                x: col * colSize,
                y: row * rowSize
            });
        }
    }

    var container = document.querySelector(".container");
    var listItems = Array.from(document.querySelectorAll(".list-item")); // Array of elements
    var sortables = listItems.map(Sortable); // Array of sortables
    var total = sortables.length;

    TweenLite.to(container, 0.5, {autoAlpha: 1});

    function changeIndex(item, to, sameRow, sameCol) {

        // Check if adjacent to new position
        if ((sameRow && !sameCol) || (!sameRow && sameCol)) {

            // Swap positions in array
            var temp = sortables[to];
            sortables[to] = item;
            sortables[item.index] = temp;

        } else {

            // Change position in array
            arrayMove(sortables, item.index, to);
        }

        // Simple, but not optimized way to change element's position in DOM. Not always necessary.
        sortables.forEach(sortable => container.appendChild(sortable.element)
    )
        ;

        // Set index for each sortable
        sortables.forEach((sortable, index) => sortable.setIndex(index)
    )
        ;
    }

    function Sortable(element, index) {

        var content = element.querySelector(".item-content");
        var order = element.querySelector(".order");

        var animation = TweenLite.to(content, 0.3, {
            boxShadow: "rgba(0,0,0,0.2) 0px 16px 32px 0px",
            force3D: true,
            scale: 1.1,
            paused: true
        });

        var dragger = new Draggable(element, {
            onDragStart: downAction,
            onRelease: upAction,
            onDrag: dragAction,
            cursor: "inherit"
        });

        var position = element._gsTransform;

        // Public properties and methods
        var sortable = {
            cell: cells[index],
            dragger: dragger,
            element: element,
            index: index,
            setIndex: setIndex
        };

        TweenLite.set(element, {
            x: sortable.cell.x,
            y: sortable.cell.y,
        });

        function setIndex(index) {

            var cell = cells[index];
            var dirty = position.x !== cell.x || position.y !== cell.y;

            sortable.cell = cell;
            sortable.index = index;
            order.textContent = index + 1;

            // Don't layout if you're dragging
            if (!dragger.isDragging && dirty) layout();
        }

        function downAction() {
            animation.play();
            this.update();
        }

        function dragAction() {

            var col = clamp(Math.round(this.x / colSize), 0, totalCols - 1);
            var row = clamp(Math.round(this.y / rowSize), 0, totalRows - 1);

            var cell = sortable.cell;
            var sameCol = col === cell.col;
            var sameRow = row === cell.row;

            // Check if position has changed
            if (!sameRow || !sameCol) {

                // Calculate the new index
                var index = totalCols * row + col;

                // Update the model
                changeIndex(sortable, index, sameRow, sameCol);
            }
        }

        function upAction() {
            animation.reverse();
            layout();
        }

        function layout() {
            TweenLite.to(element, 0.3, {
                x: sortable.cell.x,
                y: sortable.cell.y
            });
        }

        return sortable;
    }

    // Changes an elements's position in array
    function arrayMove(array, from, to) {
        array.splice(to, 0, array.splice(from, 1)[0]);
    }

    // Clamps a value to a min/max
    function clamp(value, a, b) {
        return value < a ? a : (value > b ? b : value);
    }


</script>


