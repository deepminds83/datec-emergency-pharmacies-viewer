<?php
namespace Datec\EmergencyServices\Controller;

require_once('Repository/EntriesRepository.php');
require_once('Service/XMLParser.php');
require_once('View/Renderer.php');
require_once('Service/EntryFilter.php');
require_once('Service/ConfigValidater.php');


use Datec\EmergencyServices\Repository\EntriesRepository;
use Datec\EmergencyServices\Service\XMLParser;
use Datec\EmergencyServices\View\Renderer;
use Datec\EmergencyServices\Service\EntryFilter;
use Datec\EmergencyServices\Service\ConfigValidater;

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
	
	/**
	 * @var Renderer
	 */
	protected $renderer;
	
	/**
	 * @var EntryFilter
	 */
	protected $entryFilter;
	
	/**
	 * 
	 * @var ConfigValidater
	 */
	protected $configValidater;
	
	/**
	 * Array of results from loaded emergencies.
	 * - period
	 * - entries => another array of emergency pharmacies
	 * 
	 * @var array
	 */
	protected $result;
	
	protected function init () {
		$this->renderer = new Renderer();
		$this->emergenciesRepository = new EntriesRepository();		
		$this->entryFilter = new EntryFilter();
		$this->configValidater = new ConfigValidater();
		$this->loadConfig();
		$this->xmlParser = new XMLParser($this->config);
	}
	
	/**
	 * Loads all, parses, filters, renderers.
	 * 
	 * return string HTML output after renderering
	 */
	public function main() {
		$content = 'EmergenciesController - runs';
		$errors = array();
		$xmlEntries = array();
		
		try {
			$this->init();
		
			$xmlResults = $this->emergenciesRepository->loadEntry($this->config->url); //TODO: laden
		
			$entries = $this->xmlParser->parseEntries($xmlResults);
			
			$xmlEntries = $this->entryFilter->filter($entries, (bool) $this->config->useCurrentTime, $this->config->toDay); // validate userCurrentTime isset
		} catch (\Exception $e) {
			$errors[] = $e->getMessage();
		}
		
		$this->renderer->setConfig($this->config);
		$content = $this->renderer->renderEntries($xmlEntries, $errors);
		
		return $content;
	}
	
	/**
	 * Load the config file
	 * @throws Exception
	 */
	private function loadConfig() {
		$jsonfile = "Config/config.json";
		if (file_exists($jsonfile)) {
			$json = file_get_contents($jsonfile);
			$json = utf8_encode($json);
			$this->config = json_decode($json);
			
			//Validate cofig 
			$this->configValidater->configValidate($this->config);
		} else {
			throw new \Exception("Die Datei config.json konnte nicht gefunden werden.");
		}
	}
}

$emergencies = new EmergenciesController();
echo $emergencies->main();

?>
