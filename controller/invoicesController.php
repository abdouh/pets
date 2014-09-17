<?php

Class invoicesController Extends baseController {

    public function index() {
        $this->registry->template->title = 'ريحانة | الفواتير';
        $this->registry->template->show('invoices');
    }

    public function addInvoice() {
        $this->registry->template->title = 'ريحانة | الفواتير';
        $this->registry->template->show('invoices');
    }

    public function addPayments() {
        $this->registry->template->title = 'ريحانة | اضافة دفعات';
        $this->registry->template->show('add_payment');
    }

    public function handle_invoice() {
        $errors = array();
        $invoice['info']['invoice_num'] = $_POST['invoice_num'];
        $company_name = select::select_by_field(array('company_name' => $_POST['company_id']), 'perfume_company', '1');
        $invoice['info']['company_id'] = $company_name[0]['company_id'];

        $myDateTime = DateTime::createFromFormat('m/d/Y', $_POST['contracted_date']);
        $contracted = $myDateTime->format('Y-m-d');
        $invoice['info']['contracted_date'] = $contracted;
        $myDateTime = DateTime::createFromFormat('m/d/Y', $_POST['delivery_date']);
        $delivery = $myDateTime->format('Y-m-d');
        $invoice['info']['delivery_date'] = $delivery;
        $invoice['info']['total_price'] = $_POST['total_price'];
        $invoice['info']['time'] = time();
        $invoice['info']['time_id'] = date('Y-m-d');

        function insert_new_product($product_name) {
            return Operations::get_instance()->init(array('product_name' => $product_name), 'products_info');
        }

        foreach ($_POST['product_name'] as $index => $val) {
            $product_id =
                    select::select_by_field(array('product_name' => $_POST['product_name'][$index]), 'products_info', '1');
            $product_id = empty($product_id[0]['product_id']) ?
                    insert_new_product($_POST['product_name'][$index]) : $product_id[0]['product_id'];
            $invoice['products'][$index] =
                    array('product_id' => $product_id, 'invoice_id' => 1,
                        'quantity' => $_POST['quantity'][$index],
                        'price' => $_POST['unit_price'][$index] * $_POST['quantity'][$index]);
        }
        $check = Operations::get_instance()->pre_validate($invoice['info'], 'invoices');
        if (is_array($check)) {
            $errors['info'] = Operations::get_instance()->generate_errors();
        }
        foreach ($invoice['products'] as $index => $product) {
            $check = Operations::get_instance()->pre_validate($product, 'invoices_products');

            if (is_array($check)) {
                $errors['products'][$index] = Operations::get_instance()->generate_errors();
            }
        }



        if (empty($errors)) {
            $invoice_id = Operations::get_instance()->init($invoice['info'], 'invoices');
            foreach ($invoice['products'] as $index => $product) {
                $product['invoice_id'] = $invoice_id;
                Operations::get_instance()->init($product, 'invoices_products');
                echo 1;
            }
        } else {
            $output = '';
            return;
            foreach ($errors['info'] as $error) {
                $output .= '<div class="alert alert-error">
                <button class="close" data-dismiss="alert"></button>
                <strong>' . $error . '</strong></div>';
            }
            foreach ($errors['products'] as $index => $error) {
                $output .= '<div class="alert alert-error">
                <button class="close" data-dismiss="alert"></button>
                <strong>خطأ فى المنتج رقم #' . $index . '</strong></div>';
            }
        }
    }

    function handle_payments() {
        $errors = array();
        $payments = array();
        $invoice_id = $_POST['invoice_id'];
        $total_price = invoices::get_total_price($invoice_id);
        $total_payments = 0;
        foreach ($_POST['payment_amount'] as $index => $payment_amount) {
            $myDateTime = DateTime::createFromFormat('m/d/Y', $_POST['payment_date'][$index]);
            $payment_date = $myDateTime->format('Y-m-d');
            $total_payments += $payment_amount;
            $payments[$index] = array(
                'invoice_id' => $invoice_id,
                'payment_amount' => $payment_amount,
                'payment_date' => $payment_date,
            );
            $check = Operations::get_instance()->pre_validate($payments[$index], 'invoices_payment');
            if (is_array($check)) {
                $errors['payments'][$index] = Operations::get_instance()->generate_errors();
            }
        }
        $check = ($total_price == $total_payments);
        if (!$check) {
            $errors['total_amount'] = 'error in payment';
        }
        
        
        if (empty($errors)) {
            foreach($payments as $index => $array) {
                Operations::get_instance()->init($array, 'invoices_payments');
            }
            echo 1;
        }else{
            echo 'error';
        }
    }

    public function update_table() {
        $table_data = "";
        $table_array = array();
        if (empty($_POST['product_name'])) {
            echo '<tr><td colspan="5">لا توجد منتجات</tr>';
            return;
        }
        foreach ($_POST['product_name'] as $index => $value) {
            $table_array[] = array($index, $value, $_POST['quantity'][$index],
                $_POST['unit_price'][$index], $_POST['quantity'][$index] * $_POST['unit_price'][$index]);
        }

        $table_data_array = Temp::table_data($table_array, true);
        foreach ($table_data_array as $index => $value) {
            $table_data .= "<tr>\n";
            $table_data .= "$value";
            $table_data .= '
<td>
                                        <a href="#portlet-box" data-toggle="modal" class="btn blue icn-only product-edit"><i class="icon-edit icon-white"></i></a>
                                        <a href="#" class="btn red icn-only product-del"><i class="icon-remove icon-white"></i></a>
                                    </td>                
';
            $table_data .= "</tr>\n";
        }
        echo $table_data;
    }

    public function update_payments_table() {
        $table_data = "";
        $table_array = array();
        if (empty($_POST['payment_amount'])) {
            echo '<tr><td colspan="3">لا توجد دفعاتaa</tr>';
            return;
        }
        foreach ($_POST['payment_amount'] as $index => $value) {
            $table_array[] = array($index, $value, $_POST['payment_date'][$index]);
        }

        $table_data_array = Temp::table_data($table_array, true);
        foreach ($table_data_array as $index => $value) {
            $table_data .= "<tr>\n";
            $table_data .= "$value";
            $table_data .= '
<td>
                                        <a href="#portlet-box" data-toggle="modal" class="btn blue icn-only payment-edit"><i class="icon-edit icon-white"></i></a>
                                        <a href="#" class="btn red icn-only product-del"><i class="icon-remove icon-white"></i></a>
                                    </td>                
';
            $table_data .= "</tr>\n";
        }
        echo $table_data;
    }

}

?>
