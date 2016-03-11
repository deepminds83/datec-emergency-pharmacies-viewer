<?php
namespace Datec\EmergencyServices\Service;
class ConfigValidater {

	public function configValidate($config){
		if($config === null) {
			throw new \Exception('Die Einstellungen konnten nicht geladen werden');
		}
		
		if(empty($config->url) || !is_string($config->url)) {
			throw new \Exception('Tragen Sie bitte eine URL ein.');
		}
		
		if(!is_bool($config->useCurrentTime)) {
			throw new \Exception('"useCurrentTime" darf nur True oder False sein');
		}
				
		if(!is_int($config->toDay)) {
			throw new \Exception('Geben Sie bei "toDay" nur Zahlen ein.');
		}
				
		foreach($config->propertiesXmlPaths as $prop => $value) {
			
			if (!is_array($value)) {
				throw new \Exception('F&uuml;r die Eigenschaft "'.$prop.'" wurden keine XML-Pfade angegeben.');
			}
			
			if(empty($value) || empty($value[0])) {
				throw new \Exception('Geben Sie f&uuml;r die Eigenschaft "'.$prop.'" mindestens einen XPath an.');
			}
		}
		
		if(empty($config->propertiesDisplay)) {
			throw new \Exception('Geben Sie bitte Elemente an die angezeigt werden soll');
		}
		
		foreach($config->propertiesDisplay as  $prop => $value) {
			if(!isset($config->propertiesXmlPaths->{$prop})) {
			
				throw new \Exception('Die Eigenschaft "'.$prop.'" ist nicht konfiguriert.');
			}
			if(empty($value)) {
				throw new Exception("Geben Sie bitte f&uuml;r das Element ".$prop." einen HTML Tag ein");
			}
		}
	}
	
}
?>