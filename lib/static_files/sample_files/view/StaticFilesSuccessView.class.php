<?php
/**
 * @package    StaticFiles
 *
 * @author     Luis Merino <mail@luismerino.name>
 * @copyright  Author
 *
 * @since      0.1.0
 *
 * @version    $Id: StaticFilesAction.class.php 4399 2010-09-01 16:52:20Z rendez $
 */
class Default_Widgets_StaticFilesSuccessView extends ProjectDefaultBaseView
{
	public function executeHtml(AgaviRequestDataHolder $rd)
	{
		$this->setupHtml($rd);
		
		$model = $this->context->getModel('StaticFiles');
		// it's recommended to pass the output type to emphasize in the code the array of files we're getting. 'html' is default.
		$files = $model->getFiles($this->getResponse()->getOutputType()->getName());
		
		$this->setAttributes(array(
			'sf:style' => isset($files['style']) ? $files['style'] : array(),
			'sf:script' => isset($files['script']) ? $files['script'] : array(),
			'ts' => filemtime($model->getCacheName())
		));
	}
}

?>