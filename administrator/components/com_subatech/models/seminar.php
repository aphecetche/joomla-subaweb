<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SubatechModelSeminar extends JModelAdmin
{
  public function getTable($type='Seminar', $prefix='SubatechTable', $config=array())
  {
  	return JTable::getInstance($type,$prefix,$config);
  }
  
  protected function loadFormData()
  {
  	$data = JFactory::getApplication()->getUserState('com_subatech.edit.seminar.data',array());
  	
  	if (empty($data))
  	{
  		$data = $this->getItem();
  	}
  	
  	return $data;
  }
  
  public function getForm($data=array(), $loadData=true)
  {
    $form = $this->loadForm('com_subatech.seminar','seminar',array('control' => 'jform','load_data' => $loadData));
    return $form;
  }
  
}