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
class Default_Widgets_StaticFilesAction extends ProjectDefaultBaseAction
{
	/**
	 * Remember: this action is meant to be called as a Slot.
	 */
	public function getDefaultViewName()
	{
		return 'Success';
	}
	
	public function isSimple()
	{
		return true;
	}
}

?>