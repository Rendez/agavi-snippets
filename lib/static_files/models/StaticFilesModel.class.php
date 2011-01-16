<?php
/**
 * @package    StaticFiles
 *
 * @author     Luis Merino <mail@luismerino.name>
 * @copyright  Author
 *
 * @since      0.1.0
 *
 * @version    $Id: StaticFilesModel.class.php 4399 2010-09-01 16:52:20Z rendez $
 */
class StaticFilesModel extends AgaviModel implements AgaviISingletonModel
{
	/**
	 * @var        Array The array of files.
	 */
	protected $files = array();
	
	/**
	 * @var        String Name of the config file in cache to load.
	 */
	protected $cacheName = '';
	
	/**
	 * Initialize this model.
	 *
	 * @param      AgaviContext The current application context.
	 *
	 * @author     Luis Merino <mail@luismerino.name>
	 * @since      0.1.0
	 */
	public function initialize(AgaviContext $context, array $parameters = array())
	{
		$this->context = $context;
		
		try {
			$cfg = AgaviConfig::get('core.config_dir') . '/static_files.xml';
			$this->cacheName = AgaviConfigCache::checkConfig($cfg, $this->context->getName());
			require $this->cacheName;
		} catch(AgaviUnreadableException $e) {
			throw new AgaviConfigurationException($e->getMessage());
		}
	}
	
	public function getFiles($outputTypeName = null)
	{
		if($outputTypeName === null) { // if not indicated, then gets the default output type
			$outputTypeName = $this->context->getController()->getOutputType($outputTypeName)->getName();
		}
		
		$data = array();
		// include the 'match-all' wildcard
		$matchedRoutes = array_merge($this->context->getRequest()->getAttribute('matched_routes', 'org.agavi.routing', array()), array('*'));

		if(empty($data)) {
			foreach($this->files as $routeName => $files) {
				if(in_array($routeName, $matchedRoutes) && isset($files[$outputTypeName])) {
					// The route matches with at least one of the sequence for the given request
					$data = array_merge_recursive($data, $files[$outputTypeName]);
				}
			}
		}
		
		return $data;
	}
	
	public function getCacheName()
	{
		return $this->cacheName;
	}
}

?>