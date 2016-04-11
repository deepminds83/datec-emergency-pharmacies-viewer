<?php
namespace Datec\EmergencyServices\Service;

class ConfigValidater {
	
	/**
	 * Validatates the JSON config object, for all evaluated options
	 *
	 * @param object $config
	 */
	public function configValidate($config){
		if($config === null) {
			throw new \Exception('Keine valide JSON-Datei angegeben.');
		}
		
		if(empty($config->url) || !is_string($config->url)) {
			throw new \Exception('Tragen Sie bitte eine URL ein.');
		}
		
		if(!is_bool($config->useCurrentTime)) {
			throw new \Exception('"useCurrentTime" darf nur true oder false sein');
		}
				
		if(!is_int($config->toDay)) {
			throw new \Exception('Geben Sie bei "toDay" nur Zahlen ein.');
		}
		$arrObj = new \ArrayObject($config->propertiesXmlPaths);
		if(!$arrObj->count() || empty($config->propertiesXmlPaths)) {
			throw new \Exception("Geben Sie bitte f&uuml;r propertiesXmlPaths eine Liste (Array) an");
		}
		
		foreach($config->propertiesXmlPaths as $prop => $value) {			
			if (!is_array($value)) {
				throw new \Exception('F&uuml;r die Eigenschaft "'.$prop.'" wurden keine XML-Pfade angegeben.');
			}
			
			if(empty($value) || empty($value[0])) {
				throw new \Exception('Geben Sie f&uuml;r die Eigenschaft "'.$prop.'" mindestens einen XPath an.');
			}
		}
		
		$arrObj = new \ArrayObject($config->propertiesDisplay);
		if(!$arrObj->count() || empty($config->propertiesDisplay)) {
			throw new \Exception('Geben Sie bitte Elemente an die angezeigt werden soll');
		}
		
		foreach($config->propertiesDisplay as  $prop => $value) {
			if(!isset($config->propertiesXmlPaths->{$prop})) {			
				throw new \Exception('Die Eigenschaft "'.$prop.'" ist nicht in "propertiesXmlPaths" konfiguriert.');
			}
			if(empty($value)) {
				throw new Exception("Geben Sie bitte f&uuml;r das Element ".$prop." eine Liste (Array) von HTML-Tag-Namen oder reines HTML ein.");
			}
			if (!array($value)) {
				throw new Exception("Geben Sie bitte f&uuml;r das Element ".$prop." nur eine Liste (Array) von HTML-Tag-Namen oder reines HTML ein.");
			}
		}
	}
	
}
?>