<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

/**
 * Seminars Model
 */
class SubatechModelSeminars extends JModelList
{
    public function getListQuery()
    {
        $query = parent::getListQuery();

        $year = $this->getState('year');

        $query->select('id, author, date, location, summary, title, state, type,title2');
        $query->from('#__seminars');

        $user   = JFactory::getUser();
        if (!$user->authorise('core.edit.state', 'com_subatech'))
        {
            $query->where('state=1');
        }

        if ( $year !=0  && $year > 1990 )
        {
            $query->where('YEAR(date)='.$year);
        }

        $query->order('date desc');

        return $query;
    }

    protected function populateState($ordering = null, $direction = null)
    {
        $app = JFactory::getApplication();

        // Load the parameters.
        $params = $app->getParams();
        if (empty($params))
        {
            $params = new stdClass();
        }

        // set access related params

        $user   = JFactory::getUser();
        $userId = $user->get('id');
        $asset  = 'com_subatech';

        // Check general edit permission first.
        if ($user->authorise('core.edit', $asset)) {
            $params->set('access-edit', true);
        }
        // Now check if edit.own is available.
        elseif (!empty($userId) && $user->authorise('core.edit.own', $asset)) {
            // Check for a valid user and that they are the owner.
            if ($userId == $value->created_by) {
                $params->set('access-edit', true);
            }
        }

        // Check edit state permission.
        $params->set('access-change', $user->authorise('core.edit.state', $asset));

        $params->set('show_print_icon',true);

        $this->setState('params', $params);

        // layout
        $this->setState('layout', JRequest::getCmd('layout'));

        // the year will be taken from the params or the request
        // the request will have priority
        $year = $params->get('year');

        $yearFromRequest = JRequest::getInt('year',$year);
        // 0 = all years
        // < 0 = current year

        if ( isset($yearFromRequest) )
        {
            $year = $yearFromRequest;
        }

        if (!isset($year))
        {
            $year= -1;
        }

        if ( ($year<0) )
        {
            $year = date('Y');
        }

        $this->setState('year', $year);


    }

}
