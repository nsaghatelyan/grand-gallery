<?php

namespace GDGallery\Models;


class Settings
{
    private static $TableName = 'GDGallerySettings';
    private $RecaptchaPublicKey;
    private $RecaptchaSecretKey;
    private $GmapApiKey;
    private $HiddenRecaptchaPublicKey;
    private $HiddenRecaptchaSecretKey;
    private $PostsPerPage;
    private $RemoveTablesUninstall = 'off';
    /**
     * @var array
     */
    private $cache = array();

    public static function getTableName()
    {
        return $GLOBALS['wpdb']->prefix . self::$TableName;
    }

    /**
     * @param $key string
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = false)
    {
        if (!in_array($key, $this->cache)) {
            global $wpdb;
            $value = $wpdb->get_var($wpdb->prepare('select Value from ' . self::getTableName() . ' where Name=%s', $key));

            if (empty($value)) {
                $this->$key = $default;
            } else {
                $unserialized_value = @unserialize($value);

                if (false !== $unserialized_value || 'b:0;' === $value) {
                    $value = $unserialized_value;
                }

                $this->$key = $value;
            }


            $this->cache[] = $key;

        }

        return $this->$key;
    }

    /**
     * @param $key string
     * @param $value string
     * @return bool
     */
    public function set($key, $value)
    {
        global $wpdb;

        $option_exists = $this->get($key);

        if ($option_exists) {
            $saved = $wpdb->update(self::getTableName(),
                array('Value' => esc_sql($value)),
                array('Name' => esc_sql($key))
            );
        } else {
            $saved = $wpdb->insert(self::getTableName(), array(
                    'Value' => esc_sql($value),
                    'Name' => esc_sql($key)
                )
            );
        }

        $this->$key = $value;

        return (bool)$saved;
    }

    public function all()
    {

    }

}