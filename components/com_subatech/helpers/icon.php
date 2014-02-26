<?php
// no direct access
defined('_JEXEC') or die;

class JHtmlIcon
{

	static function edit($what, $params)
	{
		// params["type"] should contains seminar or event
		// Initialise variables.
		
		$user	= JFactory::getUser();
		$userId	= $user->get('id');
		$uri	= JFactory::getURI();

		// Ignore if the state is negative (trashed).
		if ($what->state < 0) {
			return;
		}

		JHtml::_('behavior.tooltip');

		// Show checked_out icon if the 'what' is checked out by a different user
		if (property_exists($what, 'checked_out') && property_exists($what, 'checked_out_time') 
			&& $what->checked_out > 0 && $what->checked_out != $user->get('id')) {
			$checkoutUser = JFactory::getUser($what->checked_out);
			$button = JHtml::_('image', 'system/checked_out.png', NULL, NULL, true);
			$date = JHtml::_('date', $what->checked_out_time);
			$tooltip = JText::_('JLIB_HTML_CHECKED_OUT').' :: '.JText::sprintf('COM_CONTENT_CHECKED_OUT_BY', $checkoutUser->name).' <br /> '.$date;
			return '<span class="hasTip" title="'.htmlspecialchars($tooltip, ENT_COMPAT, 'UTF-8').'">'.$button.'</span>';
		}

		if ( is_object($params) )
		{
			$type = $params->type;
		}
		else 
	 	{
			$type = $params["type"];
		}
			
		$url	= 'index.php?option=com_subatech&task='.$type.'.edit&s_id='.$what->id.'&return='.base64_encode($uri);
		$icon	= ($what->state==1) ? 'edit.png' : 'edit_unpublished.png';
		$text	= JHtml::_('image', 'system/'.$icon, JText::_('JGLOBAL_EDIT'), NULL, true);

		$overlib = "";
		
		$button = JHtml::_('link', JRoute::_($url), $text);

		$output = '<span class="hasTip" title="'.JText::_('COM_SUBATECH_EDIT_ITEM').' :: '.$overlib.'">'.$button.'</span>';

		return $output;
	}


	static function print_popup($what, $params, $attribs = array())
	{
	    if ( is_object($params) )
        {
            $type = $params->type;
        }
        else 
        {
            $type = $params["type"];
        }
        
        
		$url  = 'index.php?option=com_subatech&view='.$type.'&id='.$what->id;
		$url .= '&tmpl=component&print=1&layout=poster&page='.@ $request->limitstart;

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=750,height=850,directories=no,location=no';

		// checks template image directory for image, if non found default are loaded
		$text = JHtml::_('image', 'system/printButton.png', JText::_('JGLOBAL_PRINT'), NULL, true);

		$attribs['title']	= JText::_('JGLOBAL_PRINT');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']		= 'nofollow';

		return JHtml::_('link', JRoute::_($url), $text, $attribs);
	}

}
