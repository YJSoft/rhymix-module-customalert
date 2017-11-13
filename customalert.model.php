<?php
class customalertModel extends customalert
{
	function init()
	{
	}

	/**
	 * @return Object config object
	 * @notice this function saves config object to private value $config.
	 */
	function getConfig()
	{
		$oModuleModel = getModel('module');
		$config = $oModuleModel->getModuleConfig('customalert');

		return $config;
	}
}
