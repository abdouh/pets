<?php

Class Template {
    /*
     * @the registry
     * @access private
     */

    private $registry;

    /*
     * @Variables array
     * @access private
     */
    private $vars = array();

    /**
     *
     * @constructor
     *
     * @access public
     *
     * @return void
     *
     */
    function __construct($registry) {
        $this->registry = $registry;
    }

    /**
     *
     * @set undefined vars
     *
     * @param string $index
     *
     * @param mixed $value
     *
     * @return void
     *
     */
    public function __set($index, $value) {
        $this->vars[$index] = $value;
    }

    function show($name) {
        $path = __SITE_PATH . '/views/views' . '/' . $name . '.php';

        if (!file_exists($path)) {
            throw new Exception('Template not found in ' . $path);
            return false;
        }

        // Load variables
        foreach ($this->vars as $key => $value) {
            $$key = $value;
        }

        function get_codes($data, $type = 'style') {
            //paths to the views
            $style = TEMPLATE_URL . 'css/';
            $plugin = TEMPLATE_URL . 'plugins/';
            $script = TEMPLATE_URL . 'scripts/';

            //types of codes
            $types = array(
                'style' => '<link href=":filename" rel="stylesheet" type="text/css"/>',
                'js' => '<script type="text/javascript" src=":filename"></script>',
            );

            $output = array();
            foreach ($data as $link) {
                $output[] = str_replace(':filename', $$type . $link, $types[$type]);
            }
            return join("\n\t\t", $output) . "\n";
        }

        include ($path);
    }

}

?>
