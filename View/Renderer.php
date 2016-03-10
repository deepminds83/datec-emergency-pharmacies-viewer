<?php
namespace Datec\EmergencyServices\View;


class Renderer {	
	
	protected $config;
	
	public function setConfig($config) {
		$this->config = $config;
	}
	
	/**
	 * Render HTML View
	 */
	public function renderEntries(array $entries, $errors) {

		$content = "<div id=\"notdienstliste\"> \n";
		
		if(count($errors)) {
			$content .="<div id=\"errors\">";
			foreach($errors as $error){
				$content .="<div class=\"error\">".$error."</div>";
			}
			$content .="</div>";
		} else {
			$content .= "<div class=\"notdienste\">\n";
		
			foreach($entries as $entry) {
				$content .= "<div class=\"entry\">";
				if (array_key_exists("from", $entry) && array_key_exists("to", $entry)) {
					$content .= "<p class=\"date\">".date("d.m.Y G:i", strtotime($entry['from'])). " - ".date ("d.m.Y G:i", strtotime($entry['to'])) . "</p>";
				}
					
				foreach($this->config->propertiesDisplay as $prop => $tags){
					
						if ($prop === "from" || $prop === "to" || $prop === "period") {
							continue;
						}
							
						$content .= $this->wrapByTags($tags, $entry[$prop], $prop);
					
				}
				$content .= "</div>";
			}
			$content .= "</div>";
		}
			$content .= "</div>";
			$content .= "<div class=\"datecCopyright\">powered by <a href=\"https://www.datec-schmidt.de\">Datentechnik Schmidt Software GmbH</a></div>";
		
		return $content;
	}
	

	private function wrapByTags($tags, $value, $prop) {
		$content = "";
		foreach($tags as $key => $tag) {
			$classes = ($key === 0) ? array($prop) : array();
			$content .= $this->renderStartTag($tag, $prop, $classes, $value);
		}
		$content .= $value;
	
		$tags = array_reverse($tags);
		foreach($tags as $tag) {
			$content .='</'.$tag.'>';
		}
	
		return $content;
	}
	
	private function renderStartTag($tag, $prop, array $classes, $value = NULL)  {
		// handle special renderings for specific tag-prop combinations	
		$linkContent = "";
		if ($tag === "a" && $prop === "phone") {
			$value = preg_replace("/[^0-9,.]/", "", $value); // cleanup	
			if (strpos($value, "0") === 0 && isset($this->config->phoneRegionPrefix)) {  // remove first zero if any 
				$value = substr($value, 1);
			}
			$linkContent = ' href="tel:'.$this->config->phoneRegionPrefix.$value.'"';
		}
		
		return '<'.$tag.' class="'.implode(" ", $classes).'"'.$linkContent.'>';
	}
}
?>