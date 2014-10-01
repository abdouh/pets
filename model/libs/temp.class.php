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

    static function users_container_rows($users) {
        $output = '';

        $status[1] = 'مفعل';
        $status[2] = 'معطل';
        foreach ($users as $user) {
            $output .= <<<HERE
    <tr>
      <td><input type="checkbox" name="users[]" value="{$user['id']}"></td>
      <td>{$user['id']}</td>
      <td>{$user['email']}</td>
      <td>{$status[$user['status']]}</td>
    </tr>
HERE;
        }
        return $output;
    }

    static function ad_container_rows($ads) {
        $output = '';
        $status[0] = 'غير مفعل';
        $status[1] = 'مفعل';
        $status[2] = 'معطل';
        foreach ($ads as $ad) {
            $output .= <<<HERE
    <tr>
      <td><input type="checkbox" name="ads[]" value="{$ad['id']}"></td>
      <td>{$ad['id']}</td>
      <td>{$ad['title']}</td>
      <td>{$status[$ad['status']]}</td>
    </tr>
HERE;
        }
        return $output;
    }

    static function ad_container_list($ads) {
        $output = '';
        foreach ($ads as $ad) {
            $output .= self::ad_container($ad);
        }
        return $output;
    }

    static function ad_container($ad) {
        $template = TEMPLATE_URL;
        $view = READ_ONLY . '/ads/view?id';
        $output = <<<HERE
        <li><a href="$view={$ad['id']}">
                                    <div class="ad_title_view">
                                        {$ad['title']}
                                    </div>
                                    <img src="$template/ads_img/{$ad['img']}">
                                </a></li>
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

    static function load_list_options($list_name, $selected = 0, $params = array()) {
        if (method_exists('Lists', $list_name))
            $req_list = forward_static_call_array(array('Lists', $list_name), $params);
        else
            return;
        foreach ($req_list as $option => $data) {
            $select_this = '';
            if ($data['value'] == $selected)
                $select_this = 'selected';
            $output.= "<option value='{$data['value']}' $select_this>{$data['text']}</option>\n";
        }
        return $output;
    }

    static function editable_table() {
        
    }

}