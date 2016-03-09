<?php
namespace Datec\EmergencyServices\View;
class Render {
	/**
	 * Render HTML Ansicht
	 */
	public function renderEntries(array $entries, $displayElements) {

		$container = "<div id=\"notdienstliste\"> \n";
		$container .= "<div class=\"notdienste\">\n";
	
		foreach($entries as $entry) {
			$container .= "<div class=\"entry\">";
			if (array_key_exists("from", $entry) && array_key_exists("to", $entry)) {
				$container .= "<p class=\"date\">".date("d.m.Y G:i", strtotime($entry['from'])). " - ".date ("d.m.Y G:i", strtotime($entry['to'])) . "</p>";
			}
				
			foreach($displayElements as $key => $val){
				if(!empty($val)){
					if ($key === "from" || $key === "to" || $key === "period") {
						continue;
					}
						
					$container .= "<".$val." class=\"".$key."\"> ".$entry[$key]."</".$val.">";
				} else {
					throw new Exception("<br /> Geben Sie bitte f&uuml;r das Element ".$key." einen HTML Tag ein");
				}
			}
			$container .= "</div>";
		}
		$container .= "</div>";
		$container .= "</div>";
		$container .= "<div class=\"datecCopyright\">powered by <a href=\"https://www.datec-schmidt.de\">Datentechnik Schmidt Software GmbH</a></div>";
	
		return $container;
	}
}