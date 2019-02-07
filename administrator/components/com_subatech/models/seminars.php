<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SubatechModelSeminars extends JModelList
{
    public function __construct($config = array())
    {

        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 's.id',
                'title', 's.title',
                'alias', 's.alias',
                'checked_out', 's.checked_out',
                'checked_out_time', 's.checked_out_time',
                'catid', 's.catid', 'category_title',
                'state', 's.state',
                'access', 's.access', 'access_level',
                'created', 's.created',
                'created_by', 's.created_by',
                'ordering', 's.ordering',
                'featured', 's.featured',
                'language', 's.language',
                'hits', 's.hits',
                'publish_up', 's.publish_up',
                'publish_down', 's.publish_down',
            );
        }

        parent::__construct($config);
    }

    public function getItems()
    {
        $items = parent::getItems();

        foreach ($items as &$item)
        {
            $item->url = 'index.php?option=com_subatech&amp;task=seminar.edit&amp;id=' . $item->id;
        }

        return $items;
    }

    protected function populateState($ordering = null, $direction = null)
    {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Adjust the context to support modal layouts.
        if ($layout = JRequest::getVar('layout')) {
            $this->context .= '.'.$layout;
        }

        $search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
        $this->setState('filter.search', $search);


        $published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
        $this->setState('filter.state', $published);

        // List state information.
        parent::populateState('s.title', 'asc');
    }

    public function getListQuery()
    {
        $db       = $this->getDbo();
        $query  = $db->getQuery(true);


        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select',
                's.id, s.author, s.author_url, s.date, s.location, s.alias, s.summary, s.checked_out, '.
                's.checked_out_time,s.title,s.author_filiation,s.author_filiation_url,s.type,s.comment,'.
                's.state,s.created,s.created_by,s.modified,s.modified_by,s.publish_up,s.publish_down'
            )
        );
        $query->from($db->quoteName('#__seminars').' AS s');


        // Join over the users for the checked out user.
        $query->select('u.name AS editor');
        $query->join('LEFT', '#__users AS u ON u.id=s.checked_out');

        // Filter by published state
        $published = $this->getState('filter.state');
        if (is_numeric($published)) {
            $query->where('s.state = '.(int) $published);
        } elseif ($published === '') {
            $query->where('(s.state IN (0, 1))');
        }

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('s.id = '.(int) substr($search, 3));
            } else {
                $search = $db->Quote('%'.$db->escape($search, true).'%');
                $query->where('(s.title LIKE '.$search.' OR s.alias LIKE '.$search.')');
            }
        }
        return $query;
    }
}
