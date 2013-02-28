<?php

/**
 * Description of Mus_AutoCompleteSource: any entity that implement the AutoCompleteSource will act as a source for an autocompletable entities. This 
 * behaviour will expect the class name of the autocompletable class which is mandatory and the name of the field to be used in autocomplete which is optional.
 *
 * @author mustafa
 */
class AutoCompleteSource extends Doctrine_Template{
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
