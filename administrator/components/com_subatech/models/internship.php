<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SubatechModelInternship extends JModelAdmin
{
    protected function prepareTable(&$table)
    {
        // Set the publish date to now
//        $db = $this->getDbo();
        if($table->state == 1 && intval($table->publish_up) == 0) {
            $table->publish_up = JFactory::getDate()->toSql();
        }
        // Set the created date to now
        if($table->state==1 && intval($table->created)==0) {
            $table->created = JFactory::getDate()->toSql();            
        }

        $table->modified = JFactory::getDate()->toSql();   
    }
    
  public function getTable($type='Internship', $prefix='SubatechTable', $config=array())
  {
  	return JTable::getInstance($type,$prefix,$config);
  }
  
  protected function loadFormData()
  {
  	$data = JFactory::getApplication()->getUserState('com_subatech.edit.internship.data',array());
  	
  	if (empty($data))
  	{
  		$data = $this->getItem();
  	}
  	
  	return $data;
  }
  
  public function getForm($data=array(), $loadData=true)
  {
    $form = $this->loadForm('com_subatech.internship','internship',array('control' => 'jform','load_data' => $loadData));
    return $form;
  }
  
}