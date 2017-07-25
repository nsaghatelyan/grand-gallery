<div id="gdgallery-editimages-modal" class="-gdgallery-modal">
    <div class="-gdgallery-modal-content">
        <div class="-gdgallery-modal-content-header">
            <div class="-gdgallery-modal-header-icon">

            </div>
            <div class="-gdgallery-modal-header-info">
                <h3>Quick Edit - Images</h3>
            </div>
            <div class="-gdgallery-modal-close">
                <i class="fa fa-close"></i>
            </div>
        </div>
        <div class="-gdgallery-modal-content-body">
            <form action="admin.php?page=gdgallery&id=<?php echo $id_gallery; ?>&save_data_nonce=<?php echo $save_data_nonce; ?>"
                  method="post" id="gdgallery_edited_images_form" name="gdgallery_edited_images_form">

                <input type="hidden" name="gdgallery_images_id_gallery" value="<?= $id_gallery ?>">
                <table class="quick_edit_table grid" id="sort">
                    <tbody>
                    <?php
                    if (!empty($items)) {
                        foreach ($items as $key => $item): ?>
                            <tr>
                                <td class="index"><input type="hidden"
                                                         name="gdgallery_images_ordering[<?= $item->id_image ?>]"
                                                         value="<?= $item->ordering ?>"></td>
                                <td class="img_td">
                                    <img src="<?= $item->url ?>">
                                </td>
                                <td><label for="gdgallery_images_name[<?= $item->id_image ?>]"> Name:</label>
                                    <input type="text" id="gdgallery_images_name[<?= $item->id_image ?>]"
                                           name="gdgallery_images_name[<?= $item->id_image ?>]"
                                           value="<?= $item->name ?>">
                                </td>
                                <td><label for="gdgallery_images_description[<?= $item->id_image ?>]">
                                        Description: </label>
                                    <input type="text" id="gdgallery_images_description[<?= $item->id_image ?>]"
                                           name="gdgallery_images_description[<?= $item->id_image ?>]"
                                           value="<?= $item->description ?>"></td>
                                <td><label for="gdgallery_images_link[<?= $item->id_image ?>]"> Link:</label>
                                    <input type="text" name="gdgallery_images_link[<?= $item->id_image ?>]"
                                           id="gdgallery_images_link[<?= $item->id_image ?>]"
                                           value="<?= $item->link ?>">
                                </td>
                                <?php /* ?><td>
                                    <label for="gdgallery_images_target[<?= $item->id_image ?>]"> Target:</label>
                                    <select name="gdgallery_images_target[<?= $item->id_image ?>]"
                                            id="gdgallery_images_target[<?= $item->id_image ?>]">
                                        <option value="_blank" <?php if ($item->target == "_blank") echo "selected" ?>>
                                            New Tab
                                        </option>
                                        <option value="_self" <?php if ($item->target == "_self") echo "selected" ?>>
                                            Current Tab
                                        </option>
                                    </select>

                                </td> <?php */ ?>
                            </tr>
                        <?php endforeach;
                    } ?>
                    </tbody>
                </table>

                <span class="spinner"></span>
                <input type="submit" value="Save"
                       id="gdgallery-save-buttom"
                       class="gdgallery-save-buttom">

            </form>
        </div>
    </div>
</div>
