<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2010 Giovanni Mansillo. All Rights Reserved.
# copyright Copyright (C) 2020 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

class JTraxViewJTrax extends JViewLegacy
{
	// Overwriting JView display method
	function display($tpl = null) 
	{		
		/* load component params */
		$this->params=JFactory::getApplication()->getParams();
		
		/* Initializing variables */
		$this->searchterm = $this->get('searchterm');
		$this->information=0;
		$this->open=TRUE;
		
		/* Calculating opening and closing times */
		if($this->params->get('timetable','0')!=0){			
			$this->openingtime=$this->params->get('openingtime',1);
			$this->closingtime=$this->params->get('openingtime',1)+$this->params->get('duration',12);
			
			if($this->closingtime>24)
				$this->closingtime=$this->closingtime-24;
			
			if($this->openingtime>$this->closingtime)
			{
				if(date("H")>=$this->closingtime and date("H")<$this->openingtime)
					$this->open=FALSE;
			}
			else
			{
				if(date("H")>=$this->closingtime or date("H")<$this->openingtime)
					$this->open=FALSE;
			}
		}
		
		if($this->open==FALSE)
		{		
				$error=$this->params->get('errClose',JText::_('COM_JTRAX_ERROR_CLOSED'));
				JFactory::getApplication()->enqueueMessage($error,'error');
				$this->information=0;
		}
		else if (!empty($this->searchterm)){
			/* This regular expression check if deathly chars were included in the search code - DO NOT ignore this! */
			if (!preg_match("/^[a-z0-9]{4,31}$/i", $this->searchterm)){
				$error=$this->params->get('errInvalid','"'.$this->searchterm.'" '.JText::_('COM_JTRAX_ERROR_INVALID_CODE'));
				JFactory::getApplication()->enqueueMessage($error,'error');
				$this->information=0;
			}
			else
			{
				$this->information = $this->get('information');
				if ($this->information==NULL || $this->information=='')
				{
					// Check for request forgeries.
					JSession::checkToken() or die( 'Invalid Token' );
					$error=JText::_('COM_JTRAX_ERROR_NO_RESULTS_PREPEND').$this->searchterm.JText::_('COM_JTRAX_ERROR_NO_RESULTS_APPEND');
					JFactory::getApplication()->enqueueMessage($error,'notice');
					$this->information=0;
				}
			}
			
			// Check for errors.
			if (count($errors = $this->get('Errors')))
			{
			    JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			    
			    return false;
			}
			
		}
			parent::display($tpl);
	}
}
