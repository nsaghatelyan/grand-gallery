<?php

namespace GDGallery\Core\Admin;

use GDGallery\GDGallery;

trait Video
{
    public static function getVideoType($url)
    {
        if (strpos($url, "youtube") !== false || strpos($url, "youtu.be") !== false) {
            return "youtube";
        } elseif (strpos($url, "vimeo") !== false) {
            return "vimeo";
        }

        return false;
    }

    public static function getVideoId($url, $type)
    {
        $video_id = null;
        if ($type == "youtube") {
            $video_id = substr($url, -11);
        } elseif ($type == "vimeo") {
            $video_id = substr($url, -9);
            if (strpos($video_id, '/') !== false) {
                $video_id = str_replace("/", "", $video_id);
            }
        }


        return $video_id;
    }

    public static function getVideoThumb($video_id, $type)
    {

        $thumbnail = null;

        if ($type == "youtube") {
            $thumbnail = "https://img.youtube.com/vi/" . $video_id . "/0.jpg";
        } elseif ($type == "vimeo") {
            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
            $thumbnail = $hash[0]['thumbnail_medium'];
        }

        return $thumbnail;

    }
}