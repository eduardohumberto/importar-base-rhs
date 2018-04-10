<?php

class ItemFiles{

    /**
     * insert a file as attachment by url
     *
     * @param $item_id
     * @param $url
     *
     * @return int attachment_id
     */
    public function insert_attachment_by_url( $item_id, $url){
        global $Tainacan_ItemMetadata_Model;

        return $Tainacan_ItemMetadata_Model->add_file_url($url, $item_id );
    }

    /**
     * insert a file as attachment by path
     *
     * @param $item_id
     * @param $filename
     *
     * @return int o attachment id created
     */
    public function insert_attachment_by_path( $item_id, $filename){
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');

        $tmp = $filename;
        $file_array['name'] = basename($filename);
        $file_array['tmp_name'] = $tmp;

        $attach_id = media_handle_sideload($file_array, $item_id);

        delete_post_meta($item_id, '_file_id');
        add_post_meta($item_id, '_file_id', $attach_id);

        return $attach_id;
    }

}