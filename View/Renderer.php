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
				foreach($this->config->propertiesDisplay as $prop => $tags) {							
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
			if (ctype_alpha($tag)) { // is only aplha-numeric tag name	
				$classes = (!isset($classes)) ? array($prop) : array(); // classes only on the first tag element
				$content .= $this->renderStartTag($tag, $prop, $classes, $value);
			} else if (!ctype_alpha($tag) && $key === 0) { // any other html content, can be rendered before (when first in taglist)
				$content .= $tag;
				unset($tags[$key]);
			}
		}	
		
		$content .= ($prop == "from" || $prop == "to" || $prop == "date") ? date("d.m.Y H:i", strtotime($value)) :  $value;  // default formatting dates
	
		$tags = array_reverse($tags);
		foreach($tags as $key => $tag) {
			if (ctype_alpha($tag)) { // is only aplha-numeric tag name, start tag was rendered			
				$content .='</'.$tag.'>';
		    } else if (!ctype_alpha($tag) && $key === 0) { // any other html content, can be rendered after (when last in taglist / first in reversed taglist)
				$content .= $tag;
			}
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