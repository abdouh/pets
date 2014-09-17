<?php

class Temp {

//here goes the patterns to use all over the script
//fully static class


    static function breadcrumb($page_name = '') {
        $output = <<<HERE
<ul class = "breadcrumb">
    <li>
        <i class = "icon-home"></i>
        <a href = "index.html">Home</a>
        <i class = "icon-angle-left"></i>
    </li>
    <li>
        <a href = "#">Data Tables</a>
        <i class = "icon-angle-left"></i>
    </li>
    <li><a href = "#">Editable Tables</a></li>
</ul>
HERE;
        return $output;
    }

    static function generate_errors($array, $msg = null) {
        
    }

    static function table_data($data, $is_array = false) {
        $table_data = array();
        foreach ($data as $index => $array) {
            $table_data[$index] = "";
            foreach ($array as $value) {
                $table_data[$index] .= "<td>$value</td>\n";
            }
            if (!$is_array)
                $table_data[$index] = "<tr>\n" . $table_data[$index] . "</tr>\n";
        }
        if ($is_array)
            return $table_data;
        else
            return join("\n", $table_data);
    }

    static function autocomplete_data() {
        
    }

    static function load_list_options($list_name) {
        if (method_exists('Lists', $list_name))
            $req_list = forward_static_call_array(array('Lists', $list_name), array());
        else
            return;
        foreach ($req_list as $option => $data) {
            $output.= "<option value='{$data['value']}'>{$data['text']}</option>\n";
        }
        return $output;
    }

    static function editable_table() {
        
    }

}