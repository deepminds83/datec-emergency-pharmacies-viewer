<?php
namespace Datec\EmergencyServices\Service;

class EntryFilter {
	
	public function filter(array $entries, $start = "", $end= "") {
		$startTime = new \DateTime();
		$endTime = clone $startTime;

		if(!empty($end)) {
			$endTime->modify("+".$end." day");			
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
				if(!empty($start)){
					$entryTime->modify("-".$start." day");
					if($entryTime >= $startTime && $entryTime <= $endTime) {
						$resultEntry[$i] = $entry;
						$i++;
					}
				}
			} else {
				$entryTime = new \DateTime($entry['date']);
				if($entryTime <= $endTime) {
					$resultEntry[$i] = $entry;
					$i++;
				}
				if(!empty($start)) {
					$entryTime->modify("-".$start." day");
					if($entryTime >= $startTime && $entryTime <= $endTime) {
						$resultEntry[$i] = $entry;
						$i++;
					}
				}
			}
		}
		
		return $resultEntry;
	}
}