<?php
class customalertAdminController extends customalert
{
	function init()
	{
	}

	function procCustomalertAdminInsertConfig()
	{
		$vars = Context::getRequestVars();

		$oModuleController = getController('module');
		$oModuleController->updateModuleConfig('customalert', $vars);
		if(!in_array(Context::getRequestMethod(),array('XMLRPC','JSON')))
		{
			$returnUrl = Context::get('success_return_url') ? Context::get('success_return_url') : getNotEncodedUrl('', 'module', 'admin', 'act', 'dispCustomalertAdminConfig');
			header('location: ' . $returnUrl);
			return;
		}
	}
}
