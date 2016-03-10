<?php
namespace Datec\EmergencyServices\Repository;

class EntriesRepository {
	
	/**
	 * Load Entries form the url
	 * @param string $url
	 * @throws \Exception
	 */
	public function loadEntry($url) {
			$xml = simplexml_load_file($url);
			return $xml;
	}
}
?>