<?php
namespace Datec\EmergencyServices\Service;

/**
 * 
 * @author Andre Fischer - a.fischer@datec-schmidt.de
 *
 */
class XMLParser {
	
	
	
	/**
	 * Json Object
	 *
	 * @var stdClass
	 */
	protected $config;
	
	/**
	 * XML Entries
	 *
	 * @var array
	 */
	protected $xml;
	
	public function __construct($config) {
		$this->config = $config;
	}
	
	/**
	 * Gibt ein Array mit allen dazugehörigen Einträgen zurück
	 *
	 * @param string $name        	
	 * @return array
	 */
	private function getXMLArray($key) {
		foreach($this->config->propertiesXmlPaths->{$key} as $xmlPath) {
			$value = $this->xml->xpath($xmlPath);
			if (!empty($value)) {
				break;
			}
		}
		if ($value === FALSE || empty($value)) { // depending on libxml  version, both register as error of path not found
			throw new \Exception('Die Eigenschaft "'.$key.'" wurde nicht im Ergebnis gefunden.');
		}
		return $value;
	}
	
	/**
	 * Lädt die Apotheken Daten und übergibt sie in ein assoziatives Array
	 * return void
	 */
	public function parseEntries($xmlResult) {
		$entries = array();
		if(!empty($xmlResult)) {
			$this->xml = $xmlResult;
			foreach($this->config->propertiesDisplay as $key => $tags){
				$value = $this->getXMLArray($key);
				for($i = 0; $i < count($value); $i++) {
					if ($key === "period") {
						continue;
					}
					$entries[$i][$key] = $value[$i];
				}			
			}
		} else {
			throw new \Exception('Es konnten keine Inhalte gefunden werden.');
		}
		
		return $entries;
	}
}
?>