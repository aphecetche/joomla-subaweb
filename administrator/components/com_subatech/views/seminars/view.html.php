<?php
defined('_JEXEC') or die;

class SubatechViewSeminars extends JViewLegacy
{
    protected $items;
    protected $pagination;
    // protected $state;

    public function display($tpl = null)
    {
        $this->state     = $this->get('State'); // !! state must be set before going to get items otherwise pagination is not working !
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        $this->addToolbar();

        parent::display($tpl);
    }

    public function addToolbar()
    {
        $canDo = SubatechHelper::getActions();
        $state  = $this->get('State');

        JToolBarHelper::title(JText::_('COM_SUBATECH_SEMINARS_LIST_TITLE'), 'subatech');

        if ($canDo->get('core.create')) {
            JToolBarHelper::addNew('seminar.add');
        }

        if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
            JToolBarHelper::editList('seminar.edit');
        }

        if ($canDo->get('core.edit.state')) {
            JToolBarHelper::divider();
            JToolBarHelper::publish('seminars.publish', 'JTOOLBAR_PUBLISH', true);
            JToolBarHelper::unpublish('seminars.unpublish', 'JTOOLBAR_UNPUBLISH', true);
            JToolBarHelper::divider();
            JToolBarHelper::checkin('seminars.checkin');
            JToolBarHelper::archiveList('seminars.archive');
        }

        if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
            JToolBarHelper::divider();
        } elseif ($canDo->get('core.edit.state')) {
            JToolBarHelper::trash('seminars.trash');
            JToolBarHelper::divider();
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_subatech');
        }
    }
}
