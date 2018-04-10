<?php

class LogTainacan {

    public $total_items = 0;
    public $inserted = 0;

    /**
     * @param $total
     */
    public function set_total_items( $total ){
        $this->total_items = $total;
    }
    /**
     * @param $message
     */
    public function printText( $message ){
        echo $message.PHP_EOL;
    }

    /**
     *
     */
    public function total_items_inserted(){
        $this->inserted++;
        $this->printText(' Items importados: ' . $this->inserted . '/' . $this->total_items );
    }
}