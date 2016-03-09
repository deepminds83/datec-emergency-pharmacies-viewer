<?php
namespace Datec\EmergencyServices\Controller;

require_once('../Repository/EmergenciesRepository.php');
require_once('../Service/XMLParser.php');
require_once('../View/Render.php');
require_once('../Service/EntryFilter.php');


use Datec\EmergencyServices\Repository\EmergenciesRepository;
use Datec\EmergencyServices\Service\XMLParser;
use Datec\EmergencyServices\View\Render;
use Datec\EmergencyServices\Service\EntryFilter;

class EmergenciesController {
	
	/**
	 * @var EmergenciesRepository
	 */
	protected $emergenciesRepository;
	
	/**
	 * @var XMLParser
	 */
	protected $xmlParser;	

	/**
	 * Json Object
	 *
	 * @var stdClass
	 */
	protected $config;
	protected $render;
	protected $filter;
	
	/**
	 * Array of results from loaded emergencies.
	 * - period
	 * - entries => another array of emergency pharmacies
	 * 
	 * @var array
	 */
	protected $result;
	
	protected function init () {
		$this->loadConfig();
		$this->emergenciesRepository = new EmergenciesRepository();
		$this->render = new Render();
		$this->filter = new EntryFilter();
		$this->xmlParser = new XMLParser($this->config);
	}
	
	/**
	 * Loads all, parses, filters, renders.
	 * 
	 * return string HTML output after rendering
	 */
	public function main() {
		$content = 'EmergenciesController - runs';
		try {
			$this->init();
		} catch (\Exception $e) {
			// output config errors
		}
				
		
		try {
			$xmlResults = $this->emergenciesRepository ->loadEntry($this->config->url); //TODO: laden
			// xmlResults
		} catch (\Exception $e) {
			
		}	
		
		try {
			$entries = $this->xmlParser->parseEntries($xmlResults);
			// result
		} catch (\Exception $e) {
				
		}
		
		// TODO: filter
		$xmlEntries = $this->filter->filter($entries,"",5);
		// TODO: rendering
		$content = $this->render->renderEntries($xmlEntries,$this->config->displayElements);
		
		return $content;
	}
	
	private function loadConfig() {
		$jsonfile = "../Config/config.json";
		if (file_exists($jsonfile)) {
			$json = file_get_contents($jsonfile);
			$json = utf8_encode($json);
			$this->config = json_decode($json);
		} else {
			throw new Exception("Die Datei config.php konnte nicht gefunden werden.");
		}
	}
}

$emergencies = new EmergenciesController();

echo $emergencies->main();