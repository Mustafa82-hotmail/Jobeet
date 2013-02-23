<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mus_AutoCompleteSource
 *
 * @author mustafa
 */
class Mus_AutoCompleteSource extends Doctrine_Template{
    protected $_options = array();
    public function setup(){
        if(!isset($this->_options['className']))
        {
            throw LogicException();
        }
        if(!isset($this->_options['autoCompleteField']))
        {
            $this->_options['autoCompleteField']="name";
        }
        $this->addListener(new AutoCompleteUpdateListner($this->_options));
    }
}

?>
