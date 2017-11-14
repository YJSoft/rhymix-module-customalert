<?php
class customalertAdminController extends customalert
{
	function init()
	{
	}

	function procCustomalertAdminInsertConfig()
	{
		$oModuleController = getController('module');
		$oModuleModel = getModel('module');

		$args = Context::getRequestVars();
		$args->module = 'customalert';
		$args->mid = 'customalert_module_2fa';
		$info = $oModuleModel->getModuleInfoByMid('customalert_module_2fa');
		$args->module_srl = $info->module_srl;
		if(!$args->skin) $args->skin='default';

		$oModuleController = getController('module');
		$oModuleController->updateModuleConfig('customalert', $args);

		$output = $oModuleController->updateModule($args);
		if(!$output->toBool()) {
			return $output;
		}
		if(!in_array(Context::getRequestMethod(),array('XMLRPC','JSON')))
		{
			$returnUrl = Context::get('success_return_url') ? Context::get('success_return_url') : getNotEncodedUrl('', 'module', 'admin', 'act', 'dispCustomalertAdminConfig');
			header('location: ' . $returnUrl);
			return;
		}
	}
}
