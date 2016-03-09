<?php
namespace Datec\EmergencyServices\Service;

class EntryFilter {
	
	public function filter(array $entries,$start,$end) {
		$startTime = new \DateTime();
		if(!empty($start)){
			$startTime = new \DateTime($start);
		}
		$endTime = clone $startTime;
		if(!empty($end)) {
			$endTime->modify("+5 day");			
		}
		
		$resultEntry = array();
		$i = 0;
		
		foreach($entries as $entry) {
			if(array_key_exists("from",$entry)){
				$entryTime = new \DateTime($entry['from']);
				if($entryTime <= $endTime) {
					$resultEntry[$i] = $entry;
					$i++;
				}
			} else {
				$entryTime = new \DateTime($value);
			}
		}
		
		return $resultEntry;
	}
}