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
	public function getXMLArray($key) {
		if(property_exists($this->config, $key)) {
			$count = count($this->config->{$key});
			for($i = 0; $i < $count; $i ++) {
				if (count($this->xml->xpath($this->config->{$key}[$i]))) {
					return $this->xml->xpath($this->config->{$key}[$i]);
				}
			}
			
		} else {
			throw new \Exception("Das Element ".$key." konnte nicht gefunden werden.");
		}
		return array();
	}
	
	/**
	 * Lädt die Apotheken Daten und übergibt sie in ein assoziatives Array
	 * return void
	 */
	public function parseEntries($xmlResult) {
		$this->xml = $xmlResult;
		foreach($this->config->displayElements as $key => $val){
			$value = $this->getXMLArray($key);
			if (!empty($value)) {
				for($i = 0; $i < count($value); $i++) {
					if ($key === "period") {
						continue;
					}
					$entries[$i][$key] = $value[$i];
				}
			}
		}
		return $entries;
		
		
	}
}
?>