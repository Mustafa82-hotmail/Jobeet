<?php

/**
 * JobeetJobTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class JobeetJobTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object JobeetJobTable
     */
    static public $types = array(
        'full-time' => 'Full time',
        'part-time' => 'Part time',
        'freelance' => 'Freelance',
    );
    public function getTypes()
    {
        return self::$types;
    }
    public static function getInstance()
    {
        return Doctrine_Core::getTable('JobeetJob');
    }
     public function getActiveJobs()
     {
         $q = $this->createQuery('j')
                 ->where('j.expires_at > ?', date('Y-m-d H:i:s', time()))
                 ->orderBy('j.expires_at DESC');
         return $q->execute();
    }
    
    public function getActiveJobs1(Doctrine_Query $q=null)
    {
        $q=$this->addActiveJobQuery($q);
        return $q->execute();
    }
    
    
    public function countActiveJobs(Doctrine_Query $q)
    {
        return $this->addActiveJobQuery($q)->count();
    }
    
    
    public function addActiveJobQuery(Doctrine_Query $q=null)
    {
        if($q==null)
        {
            $q = Doctrine_Query::create()
                    ->from('JobeetJob j');
        }
        $alias=$q->getRootAlias();
        $q->andWhere($alias.'.expires_at > ?',date('Y-m-d H:i:s', time()))
                ->addOrderBy($alias.'.created_at DESC');
        $q->andWhere($alias . '.is_activated = ?', 1);
 
        return $q;
    }
}