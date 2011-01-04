<?php
/**
 * @package    StaticFiles
 *
 * @author     Luis Merino <mail@luismerino.name>
 * @copyright  Author
 *
 * @since      0.1.0
 *
 * @version    $Id: StaticFilesConfigHandler.class.php 4399 2010-09-01 16:52:20Z rendez $
 */
class StaticFilesConfigHandler extends AgaviXmlConfigHandler
{
	const XML_NAMESPACE = 'http://company.com/projectname/config/parts/static_files/1.0';
	
	/**
	 * Execute this configuration handler.
	 *
	 * @param      <b>AgaviXmlConfigDomDocument</b> The document to parse.
	 *
	 * @return     string Data to be written to a cache file.
	 *
	 * @throws     <b>AgaviUnreadableException</b> If a requested configuration
	 *                                             file does not exist or is not
	 *                                             readable.
	 * @throws     <b>AgaviParseException</b> If a requested configuration file is
	 *                                        improperly formatted.
	 *
	 * @author     Luis Merino <mail@luismerino.name>
	 * @since      0.1.0
	 */
	public function execute(AgaviXmlConfigDomDocument $document)
	{
		// setting up our default namespace
		$document->setDefaultNamespace(self::XML_NAMESPACE, 'static_files');
		
		$routing = $this->context->getRouting();
		
		$data = array();

		// let's do our fancy work
		foreach($document->getConfigurationElements() as $cfg) {
			if($cfg->has('routes')) {
				$this->parseRoutesAndFiles($routing, $cfg->get('routes'), $data);
			}
		}
		
		$code = sprintf('$this->files = %s;', var_export($data, true));
		
		return $this->generate($code, $document->documentURI);
	}
	
	protected function parseRoutesAndFiles(AgaviRouting $routing, $routes, &$data)
	{
		$controller = $this->context->getController();
		$request = $this->context->getRequest();
		
		foreach($routes as $route) {
			$outputTypes = array();
			$routeName = $route->getAttribute('name');
			if($routeName !== '*' && is_null($routing->getRoute($routeName))) {
				throw new AgaviConfigurationException('Route name "' . $routeName . '" does not exist or is not correct.');
			}
			if($route->hasAttribute('output_type')) {
				foreach(explode(' ', $route->getAttribute('output_type')) as $ot) {
					if($controller->getOutputType($ot)){
						$outputTypes[] = $ot;
					}
				}
			} else {
				$outputTypes[] = $controller->getOutputType()->getName(); // Defaults to HTML
			}
			foreach($route->get('filelist') as $filelist){
				$metatype = $filelist->getAttribute('metatype');
				foreach($filelist->getElementsByTagName('file') as $file) {
					foreach($outputTypes as $ot) {
						if ($file->hasAttribute('name')) {
							$data[$routeName][$ot][$metatype][$file->getAttribute('name')] = AgaviToolkit::expandDirectives($file->getValue());
						} else {
							$data[$routeName][$ot][$metatype][] = AgaviToolkit::expandDirectives($file->getValue());
						}
					}
				}
			}
		}
	}
}

?>