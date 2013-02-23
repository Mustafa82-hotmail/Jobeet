<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Testable
 *
 * @author mustafa
 */
class Testable extends Doctrine_Template{
    //put your code here
    protected $_options = array();
    
    public function setTableDefinition() {
        
        //parent::setTableDefinition();
         $table=Doctrine_Core::getTable("Post");
            $testable0 = new Testable(array(
             'scoreColumn' => 'score',
             'className' => 'Post',
             'clonedFields' => 
             array(
              0 => 'body',
              1 => 'title',
             ),
             ));
            $array=array(
             'scoreColumn' => 'score',
             'className' => 'Post',
             'clonedFields' => 
             array(
              0 => 'body',
              1 => 'title',
             ),
             );
            
            $table->addTemplate("Testable", $testable0);
            Doctrine_Manager::getInstance()->setImpl('Testable', 'Post');
    }
    public function setup()
    {
        if(isset($this->_options['className']))
        {
            /*$referenceClassName=$this->_options['className'];
            $className=  get_class($this->getInvoker());
            $option=array($className,"addNew",$this->_options['className'],$this->_options['clonedFields']);
            $table=Doctrine_Core::getTable($referenceClassName);
            $listner=new CloneListner($option);
            $table->addRecordListener(new CloneListner($option));
            
            */
           
          //$table->getRecordInstance()->actAs("Testable",$array);
          //Doctrine_Manager::getInstance()->setImpl('Testable', 'Post');
          
          
          
        }else{
            throw Exception();
        }
    }
    
    
    public function addNew(array $columns)
    {
        $query=$this->getTable()->createQuery();
        $invoker=$this->getInvoker();
        foreach($columns as $col)
        {
            if(is_null($invoker->get($col)))
            {
                $query->addWhere("$col is null");
            }else{
                $query->addWhere("$col=?",$invoker->get($col));
            } 
        }
        $results=$query->execute();
        if(count($results)>0)
        {
            $record=$results->getFirst();
            $record->set($this->_options['scoreColumn'],$record->get($this->_options['scoreColumn'])+1);
            $record->save();
        }else{
            $invoker->set($this->_options['scoreColumn'],1);
            $invoker->save();
        }
    }
}

?>
