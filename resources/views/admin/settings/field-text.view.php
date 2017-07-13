<?php
/**
 * @var $fieldId string
 * @var $value string
 * @var $field
 */

$placeholder = isset($field['placeholder'])
    ? 'placeholder='.$field['placeholder']
    : '';
?>

<label class="input-wrap">
    <span class="settings-label"><?php
        echo $field['label'];
        if(isset($field['help'])): ?>
            <span class="settings-field-help">
                <span class="settings-field-help-icon">?</span>
                <span class="settings-field-help-text-wrap">
                    <span class="settings-field-help-text"><?php echo $field['help']; ?></span>
                    <span class="settings-field-help-text-tooltip"></span>
                </span>
            </span>
        <?php endif;
        ?></span>
    <input type="text" name="settings[<?php echo $fieldId; ?>]" value="<?php echo $value; ?>" <?php echo $placeholder; ?> />
</label>
