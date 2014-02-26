 <?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class SubatechViewInternships extends JView
{
	protected $items;
	protected $params;
	protected $schoolyear;
	protected $layout;
	protected $title;
    protected $jobtype;
    
	// Overwriting JView display method
	function display($tpl = null) 
	{
		// Assign data to the view

		$this->items = $this->get('Items');
 		$this->params = JFactory::getApplication()->getParams();
 	    $this->schoolyear = $this->get('State')->get('schoolyear');
        $this->grade = $this->get('State')->get('grade');
 	    $this->layout = $this->get('layout');

        $this->title = "Liste des propositions";
 	            
        if ( strpos($this->grade,"master") !== false )
        {
            $this->title .= ' de stage de master';
        }
        else if ( strpos($this->grade,"license") !== false )
        {
            $this->title .= ' de stage de license';
        }
        else if ( $this->grade == "thèse" )
        {
            $this->title .= ' de sujet de thèse';
        }
        else {
            $this->title .= ' de stages et thèses';
        }
            
        $this->title .= ' schoolyear=' . $this->schoolyear;
        $this->title .= ' grade=' . $this->grade;
        
        echo "State<br/>";
        print_r($this->get('State'));
        echo "<br/>params<br/>";
        print_r($this->params);
        
		// Display the view
		parent::display($tpl);
	}
}