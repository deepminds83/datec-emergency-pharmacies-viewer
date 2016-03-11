<?php
namespace Datec\EmergencyServices\Service;

class EntryFilter {
	
	/**
	 * Filter the entry by date
	 * @param array $entries
	 * @param boolen $start
	 * @param string $end
	 
	 */
	public function filter(array &$entries, $useStartTime, $end= "") {
		$startTime = new \DateTime();
		$endTime = clone $startTime;
		
		if($end > 0){
			$endTime->modify("+".$end." day");
		}
		
		if(!empty($entries)) {
			foreach($entries as $key => $entry) {
				if(array_key_exists("from", $entry)) {
					$entryFrom = new \DateTime($entry['from']);
					$entryTo = new \DateTime($entry['to']);
					
					if($entryFrom > $endTime) {
						unset($entries[$key]);
					}
					if($useStartTime){
						if($entryFrom < $startTime && $entryTo < $startTime) {
							unset($entries[$key]);
						}
					}
				} else if(array_key_exists("date", $entry)) {
					$entryFrom = new \DateTime($entry['date']);
					if($entryFrom > $endTime) {
						unset($entries[$key]);
						
					}
					if($useStartTime) {
						if($entryFrom < $startTime && $entryTo < $startTime) {
							unset($entries[$key]);
						}
					}
				}
			}
		} else {
			
		}
		
		return $entries;
	}
}
?>