<?php
/*------------------------------------------------------------------------
# JTrax
# ------------------------------------------------------------------------
# author    Michał Ostrykiewicz
# copyright Copyright (C) 2020 Michał Ostrykiewicz. All rights reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Technical Support:  https://github.com/nodenetworks/jtrax/
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

echo "<p>";
echo JText::_('COM_JTRAX_RESULTS_FOR');
echo $this->searchterm;
echo "</p>";
$results=$this->information;
echo "<table class='results' style='width:100%'><thead>";
echo "<tr>";
echo "<td><style='width:30%'>";
echo JText::_('COM_JTRAX_RESULTS_DATE');
echo "</td>";
echo "<td>";
echo JText::_('COM_JTRAX_RESULTS_STATUS');
echo "</td>";
echo "</tr></thead><tbody>";
foreach($results as $el) //print all results
{
	echo "<tr>";
	$date = explode('-', $el->datetime); //converts date format
	echo "<td class='time' style='width:30%'>".$date[2]."/".$date[1]."/".$date[0]."</td>";
	echo "<td class='status'>".$el->status."</td>";
	echo "</tr>";
}
echo "</tbody></table>";