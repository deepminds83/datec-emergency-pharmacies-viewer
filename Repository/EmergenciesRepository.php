<?php
namespace Datec\EmergencyServices\Repository;

class EmergenciesRepository {
	
	public function loadEntry($url) {
		if(!empty($url)) {
			$xml = simplexml_load_file($url);
			return $xml;
		} else {
			throw new Exception("Geben Sie bitte eine Url in der config.php an");
		}
	}
}