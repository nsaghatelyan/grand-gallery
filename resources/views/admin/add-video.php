<div id="gdgallery-addvideo-modal" class="-gdgallery-modal">
    <div class="-gdgallery-modal-content">
        <div class="-gdgallery-modal-content-header">
            <div class="-gdgallery-modal-header-icon">

            </div>
            <div class="-gdgallery-modal-header-info">
                <h3>Add Video URL From Youtube or Vimeo</h3>
            </div>
            <div class="-gdgallery-modal-close">
                <i class="fa fa-close"></i>
            </div>
        </div>
        <div class="-gdgallery-modal-content-body">
            <form action="admin.php?page=gdgallery&id=<?php echo $id_gallery; ?>&save_data_nonce=<?php echo $save_data_nonce; ?>"
                  method="post" id="gdgallery_add_video_form" name="gdgallery_add_video_form">

                <input type="hidden" name="gdgallery_id_gallery" value="<?= $id_gallery ?>">
                <table class="quick_edit_table">


                    <tr>
                        <td><label for="gdgallery_video_url"> Video URL (Youtube or Vimeo):</label>
                            <input type="text" id="gdgallery_video_url"
                                   name="gdgallery_video_url"
                                   value="" required>
                        </td>
                        <td><label for="gdgallery_video_name"> Title:</label>
                            <input type="text" id="gdgallery_video_name"
                                   name="gdgallery_video_name"
                                   value="">
                        </td>
                        <td><label for="gdgallery_video_description">
                                Description: </label>
                            <input type="text" id="gdgallery_video_description"
                                   name="gdgallery_video_description"
                                   value=""></td>
                        <td><label for="gdgallery_video_link"> Link:</label>
                            <input type="text" name="gdgallery_video_link"
                                   id="gdgallery_video_link"
                                   value="">
                        </td>
                        <td>
                            <label for="gdgallery_video_target"> Target:</label>
                            <select name="gdgallery_video_target"
                                    id="gdgallery_video_target">
                                <option value="_blank">New Tab</option>
                                <option value="_self">Current Tab</option>
                            </select>

                        </td>
                    </tr>
                </table>
                <span class="spinner"></span>
                <input type="submit" value="Save"
                       id="gdgallery-add-video-buttom"
                       class="gdgallery-save-buttom">
            </form>


        </div>
    </div>
</div>