<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SubatechViewSeminar extends JViewLegacy
{
    protected $item;
    protected $form;

    public function display($tpl=null)
    {
        $this->item = $this->get('Item'); // get from model
        $this->form = $this->get('Form');

        $this->addToolBar();

        parent::display($tpl);
    }

    public function addToolBar()
    {
        if ($this->item->id)
        {
            JToolBarHelper::title(JText::_('COM_SUBATECH_EDIT_SEMINAR_TITLE'));
        }
        else
        {
            JToolBarHelper::title(JText::_('COM_SUBATECH_ADD_SEMINAR_TITLE'));
        }

        JToolBarHelper::apply('seminar.apply','JTOOLBAR_APPLY');
        JToolBarHelper::save('seminar.save','JTOOLBAR_SAVE');
        JToolBarHelper::save2new('seminar.save2new','JTOOLBAR_SAVE_AND_NEW');

        JToolBarHelper::cancel('seminar.cancel');
    }

}
