<?php

class Template
{
    private $data;
    private $alert_types = array('alert alert-success, alert alert-warning', 'alert alert-danger');


    function __construct() {}
    

    /**
     * loads views into parent files
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function load($url, $title = '')
    {
        if ($title != '') { $this->set_data('page_title', $title); }
        include($url);
    }

        /**
         * redirects the user to a new template within a parent file
         *
         * Undocumented function long description
         *
         * @param Type $var Description
         * @return type
         * @throws conditon
         **/
        public function redirect($url)
        {
            header('Location: ' . $url);
            exit;
        }

    /**
     * stores data for later use in the view
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function set_data($name, $value, $clean = false)
    {
        if ($clean == true) { $this->data[$name] = htmlentities($value); } else { $this->data[$name] = $value; }
    }

    /**
     * returns stored data for display in the view
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function get_data($name, $echo = true)
    {
        $data = '';

        if (isset($this->data[$name]))
        {
            if ($echo == true)
            {
                echo $this->data[$name];
            }
            else
            {
                return $this->data[$name];
            }
        }
        
        
    }

    /**
     * sets alerts for later display in the view
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function set_alert($value, $alert = 'alert alert-success')
    {
        $_SESSION[$alert][] = $value;
    }

    /**
     * returns alert for display in the view
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function get_alert()
    {
        $data = '';

        foreach($alert_types as $alert)
        {
            if (isset($_SESSION[$alert]))
            {
                foreach($_SESSION[$alert] as $value)
                {
                    $data .= '<div class="' . $alert . '">' . $value . '</div>';
                }
            }
        }
        return $data;
    }


}



?>
