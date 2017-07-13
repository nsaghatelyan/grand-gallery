<div id="gdgallery-addvideo-modal" class="-gdgallery-modal">
    <div class="-gdgallery-modal-content">
        <div class="-gdgallery-modal-content-header">
            <div class="-gdgallery-modal-header-icon">

            </div>
            <div class="-gdgallery-modal-header-info">
                <h2>Add Video URL From Youtube or Vimeo</h2>
            </div>
            <div class="-gdgallery-modal-close">
                <i class="fa fa-close"></i>
            </div>
        </div>
        <div class="-gdgallery-modal-content-body">
            <div id="huge_it_gallery_add_videos_wrap" data-gallery-id="" data-gallery-add-video-nonce="">
                <div class="control-panel">
                    <form method="post"
                          action="">
                        <input type="text" id="huge_it_add_video_input" name="huge_it_add_video_input"/>
                        <button class='save-slider-options button-primary huge-it-insert-video-button'
                                id='huge-it-insert-video-button'><?php echo __('Insert Video', 'gallery-img'); ?></button>
                        <div id="add-video-popup-options">
                            <div>
                                <div>
                                    <label for="show_title"><?php echo __('Title:', 'gallery-img'); ?></label>
                                    <div>
                                        <input name="show_title" value="" type="text"/>
                                    </div>
                                </div>
                                <div>
                                    <label for="show_description"><?php echo __('Description:', 'gallery-img'); ?></label>
                                    <textarea id="show_description" name="show_description"></textarea>
                                </div>
                                <div>
                                    <label for="show_url"><?php echo __('Url:', 'gallery-img'); ?></label>
                                    <input type="text" name="show_url" value=""/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>