<?php

class db {

    /**
     * tables names
     * @var array of tables name
     */
    static $tables = array(
        //
        'customer' => '`foc_system`.`customer`',
        'daily_inventory_levels' => '`foc_system`.`daily_inventory_levels`',
        'discounts' => '`foc_system`.`discounts`',
        'discount_reasons' => '`foc_system`.`discount_reasons`',
        'employees' => '`foc_system`.`employees`',
        'invenory_level' => '`foc_system`.`invenory_level`',
        'invoices_state' => '`foc_system`.`invoices_state`',
        'invoices_transmission' => '`foc_system`.`invoices_transmission`',
        'invoice_transmissions_details' => '`foc_system`.`invoice_transmissions_details`',
        'invoice_types' => '`foc_system`.`invoice_types`',
        'markets' => '`foc_system`.`markets`',
        'messages_type' => '`foc_system`.`messages_type`',
        'notification_center' => '`foc_system`.`notification_center`',
        'notification_details' => '`foc_system`.`notification_details`',
        'notification_messages' => '`foc_system`.`notification_messages`',
        'notification_recivers' => '`foc_system`.`notification_recivers`',
        'notification_type' => '`foc_system`.`notification_type`',
        'owners' => '`foc_system`.`owners`',
        'products' => '`foc_system`.`products`',
        'products_desc' => '`foc_system`.`products_desc`',
        'products_type' => '`foc_system`.`products_type`',
        'product_price_tracing' => '`foc_system`.`product_price_tracing`',
        'purchasing_details' => '`foc_system`.`purchasing_details`',
        'purchasing_products_invoices' => '`foc_system`.`purchasing_products_invoices`',
        'repayments' => '`foc_system`.`repayments`',
        'sales_invoices' => '`foc_system`.`sales_invoices`',
        'sales_invoice_details' => '`foc_system`.`sales_invoice_details`',
        'system_users' => '`foc_system`.`system_users`',
        'traders' => '`foc_system`.`traders`',
    );

    /**
     * @var array of database information
     */
    private $db_info = array("host" => "localhost", "dbname" => "foc_system", "username" => "root", "password" => "123");

    /**
     * @var object of mysqli 
     */
    private $dbh;

    /**
     * @var instance from db class 
     */
    public static $instance = NULL;

    /**
     * @param array $db_info
     * @return void
     */
    public function __construct() {
        $this->dbh = new mysqli('localhost', 'root', '123', 'foc_system');
        $this->dbh->query("SET NAMES utf8");
    }

    /**
     * @return object from db class
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new db();
        }
        return self::$instance;
    }

    /**
     * @param string $query
     * @return array of all rows
     */
    public function fetchRows($query) {
        $rst = self::getinstance()->multiQuery($query);
        $data = $this->fetchAll($rst);

        return $data;
    }

    /**
     * @param string of $query
     * @param int of $page number
     * @param int of $count of data
     * @return array of data , morData (if there is more data 1 or  0  if not)
     */
    function fetchRowsPages($query, $page = 0, $count = 3) {

        $page = intval($page);
        $count = intval($count);
        $start = $count * $page;

        $res = $query . " limit $start , $count";

        $rst = self::getinstance()->multiQuery($res);
        $data = $this->fetch_all($rst);
        unset($res, $rst);
        // check if there is more data 

        $res = $query . " limit " . ($count * ($page + 1)) . " , 1";
        $rst = self::getinstance()->multiQuery($res);
        $morData = self::getinstance()->num_rows($rst);



        return array('data' => $data, 'moreData' => $morData);
    }

    /**
     * @param string $query
     * @return array
     */
    public function fetchRow($query) {
        $rst = self::getinstance()->multiQuery($query);
        return $rst->fetchArray();
    }

    /**
     * @param string $query
     * @return object of mysqli query pointer
     * @throws Exception
     */
    public function sendReport($exc) {
        $msg = "<div style='direction:ltr;'>Error No: " . $exc->getCode() . " - " . $exc->getMessage() . "<br >" . nl2br($exc->getTraceAsString()) . '</div>';
        exit('<!-- ' . $msg . ' -->');
        if (!class_exists('notification')) {
            $notfile = dirname(__file__) . '/notification.php';
            if (file_exists($notfile)) {
                include $notfile;
            } else {
                exit('<!-- ' . $msg . ' -->');
            }
        }

        $subject = "database error #" . $exc->getCode();
        $userinfo = array('email' => "hi@simple-sol.com", 'nickname' => "system tech team");
        notification::getNotifications()->sendMail($subject, $userinfo, 'blank', $msg);
    }

    public function query($query) {
        $rst = $this->dbh->query($query);

        if ($this->dbh->error) {
            try {
                throw new Exception("MySQL error {$this->dbh->error} <br> Query:<br> $query", $this->dbh->errno);
            } catch (Exception $exc) {
                // error handler
                // $this->sendReport($exc);
            }
        }

        return $rst;
    }

    function numRows($rst) {
        return $rst->num_rows;
    }

    /**
     * @param object $sth from query function
     * @return array
     */
    public function simpleFetchRow($sth) {
        return $sth->fetch_array(MYSQLI_BOTH);
    }

    /**
     * @return int of last insert id
     */
    public function insertId() {
        return $this->dbh->insert_id;
    }

    /**
     * @param string $name
     * @return string converted by mysqli real_escape_string
     */
    public function realEscapeString($name) {
        return $this->dbh->real_escape_string($name);
    }

    // mirror functions 

    function querySelf($query) {
        return db::getInstance()->fetch_row($query);
    }

    function fetchArray($result) {
        return db::getInstance()->simple_fetch_row($result);
    }

    /**
     * destory the current conncetion
     * @return boolean
     */
    function close() {
        return $this->dbh->close();
    }

    /**
     * free result
     * @return void 
     */
    function freeResult($rst) {

        $rst->free_result();
    }

    function multiQuery($query) {
        $this->dbh->multi_query($query);
        $result = $this->dbh->store_result();

        if ($this->dbh->error) {
            try {
                throw new Exception("MySQL error {$this->dbh->error} <br> Query:<br> $query", $this->dbh->errno);
            } catch (Exception $exc) {
                echo $exc->getMessage();
                //    $this->sendReport($exc);
            }
        }
        if (mysqli_more_results($this->dbh)) {
            mysqli_next_result($this->dbh);
        }

        return $result;
    }

    function fetchAll($rst) {

        if (!$rst) {
            return;
        }
        $data = array();
        while ($row = $rst->fetch_assoc()) {
            $data[] = $row;
        }
        $rst->free_result();
        return $data;
    }

}

