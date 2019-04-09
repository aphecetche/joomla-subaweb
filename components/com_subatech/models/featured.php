<?php
defined('_JEXEC') or die ;

jimport('joomla.application.component.modellist');

function cmp($a,$b)
{
    if ($a->date==$b->date) return 0;
    return ( $a->date > $b->date)  ?  -1:1;
}

class SubatechModelFeatured extends JModelList
{
    private $descriptionMaxChars = 100;
    private $replacer = '...';
    private $isStrips = true;

    public function getDateCondition($what,$dateName)
    {
        $past = JFactory::getApplication()->getParams()->get($what. '-pastdays');
        $future = JFactory::getApplication()->getParams()->get($what . '-futuredays');

        $datecondition = sprintf("( datediff(%s,now()) >= 0 and datediff(%s,now()) < %d) or ( datediff(%s,now()) < 0 and abs(datediff(%s,now())) < %d)",
            $dateName,$dateName,$future,$dateName,$dateName,$past);

        return $datecondition;
    }

    public function getSeminars(&$seminars)
    {
        $datecondition = $this->getDateCondition('seminars','date');

        $db = JFactory::getDbo();

        $query = $db -> getQuery(true);

        $query -> select('id, author, date, location, summary, title, type, state, title2');
        $query -> from('#__seminars');
        if (strlen($datecondition)>0) {
            $query -> where('(state=1) AND (' . $datecondition .')');
        }
        else {
            $query -> where('state=1');
        }

        $db -> setQuery($query);

        $rows = $db -> loadObjectList();

        foreach ($rows as $r => $row)
        {
            $row -> link = 'index.php?option=com_subatech&view=seminar&id=' . $row -> id;
            $row -> category = JText::_('COM_SUBATECH_SEMINAR');
            $row -> description = self::substring($row -> summary, $this->descriptionMaxChars, $this->replacer, $this->isStrips);
            if (strlen($row->title2)) {
                $row -> title = $row->title2 . " (+ " . $row->title . ")";
            }
            $row->label = $row->type;

            $seminars[] = $row;
        }

        uasort($seminars,'cmp');
    }

    public function getEvents(&$events)
    {
        $datecondition = $this->getDateCondition('events','date_start');

        $db = JFactory::getDbo();

        $query = $db -> getQuery(true);

        $query -> select('id, title, date_start as date, date_end, pre_summary, post_summary, location, datediff(date_start,now()) as deltadate, state');
        $query -> from('#__events')
               -> where("state=1")
               -> where($datecondition);

        $db -> setQuery($query);

        $rows = $db->loadObjectList();

        foreach ($rows as $r => $row)
        {
            $row -> link = 'index.php?option=com_subatech&view=event&id=' . $row -> id;
            $row -> category = JText::_('COM_SUBATECH_EVENT');
            $row -> description = self::substring($row->pre_summary ? $row->pre_summary : $row->post_summary,
                $this->descriptionMaxChars, $this->replacer, $this->isStrips);
            $events[] = $row;
        }

        uasort($events,'cmp');

    }

    public function getJobs(&$jobs,$phds)
    {
        $ltag = str_replace("-","_",JFactory::getLanguage()->getTag());

        if ($phds==true)
        {
            $datecondition = $this->getDateCondition('phds','date_start');
        }
        else
        {
            $datecondition = $this->getDateCondition('jobs','date_start');
        }

        $db = JFactory::getDbo();

        $query = $db -> getQuery(true);
        $query -> select('id, state, title_' . $ltag . ' as title, date_start as date, type, description_' . $ltag . ' as description');
        $query -> from('#__jobs')
               -> where("(state=1)");

        if  ($phds==false)
        {
            $query->where("(type!='thèse')");
        }
        else
        {
            $query->where("(type='thèse')");
        }

        $query->where("(".$datecondition.")");

        $db -> setQuery($query);

        $rows = $db->loadObjectList();

        if (count($rows)) {

            foreach ($rows as $r => $row)
            {
                $row -> link = 'index.php?option=com_subatech&view=job&id=' . $row -> id;
                if ($phds==true)
                {
                    $row -> category = JText::_('COM_SUBATECH_PHDS');
                }
                else
                {
                    $row -> category = JText::_('COM_SUBATECH_JOB');
                }
                $row -> description = self::substring($row->description,
                    $this->descriptionMaxChars, $this->replacer, $this->isStrips);

                $jobs[] = $row;
            }
        }
        uasort($jobs,'cmp');
    }

    public function getInternships(&$internships)
    {
        $datecondition = $this->getDateCondition('internships','date_start');

        $db = JFactory::getDbo();

        $query = $db -> getQuery(true);
        $query -> select('id, title, school_year, grade, description');
        $query -> from('#__internships')
               -> where("state=1");

        $db -> setQuery($query);

        $rows = $db->loadObjectList();

        if (count($rows)) {
            foreach ($rows as $r => $row)
            {
                $row -> link = 'index.php?option=com_subatech&view=internship&id=' . $row -> id;
                $row -> category = JText::_('COM_SUBATECH_INTERNSHIP');
                $row -> description = self::substring($row->description,
                    $this->descriptionMaxChars, $this->replacer, $this->isStrips);

                $row->type = $row->grade;

                $internships[] = $row;
            }
        }
    }

    public function getItems()
    {
        $maxage = 60;//JFactory::getApplication()->getParams()->get('age');

        $datecondition = "datediff(date_start,now()) > 0 or abs(datediff(date_start,now())) < $maxage";

        $indexSeminars = '"' . JText::_('COM_SUBATECH_SEMINARS') . '"';
        $indexEvents = '"' . JText::_('COM_SUBATECH_EVENTS') . '"';
        $indexJobs = '"' . JText::_('COM_SUBATECH_JOBS') . '"';
        $indexInternships = '"' . JText::_('COM_SUBATECH_INTERNSHIPS') . '"';
        $indexPhds = '"' . JText::_('COM_SUBATECH_PHDS') . '"';

        $items = array(  "head" => array(),
            $indexSeminars => array(),
            $indexEvents => array(),
            $indexJobs => array(),
            $indexInternships => array(),
            $indexPhds => array() );

        $db = JFactory::getDbo();

        $aid = $this->getState('article.id');

        $query = $db -> getQuery(true);

        $query->select('id,title,introtext')
              ->from('#__content')
              ->where("id=$aid");

        $db -> setQuery($query);

        $items["head"] = $db->loadAssoc();

        $this->getSeminars($items[$indexSeminars]);

        $this->getEvents($items[$indexEvents]);

        $this->getJobs($items[$indexJobs],false);

        $this->getJobs($items[$indexPhds],true);

        $this->getInternships($items[$indexInternships]);


        return $items;
    }

    protected function populateState($ordering = null, $direction = null)
    {
        // Load state from the request.

        $this->setState('article.id', JRequest::getInt('id'));
    }

    public static function substring( $text, $length = 100, $replacer='...', $isStrips=true )
    {
        $string = $isStrips ? strip_tags( $text ):$text;
        return JString::strlen( $string ) > $length ?  JHtml::_('string.truncate', $string, $length ): $string;
    }

}
