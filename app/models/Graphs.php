<?php

class Graphs
{
    function constructor() {}

    /**
     * Sends databse information to python script which returns data visualisation
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function construct_graph()
    {
        $result = exec("python /resources/python/visual.py args");

        
    }
}


?>