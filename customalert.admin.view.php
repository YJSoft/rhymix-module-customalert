<?php
class customalertAdminView extends customalert
{
	function init()
	{
		$this->setTemplatePath($this->module_path.'tpl');
		$this->setTemplateFile(strtolower(str_replace('dispCustomalertAdmin', '', $this->act)));
	}

	function dispCustomalertAdminConfig()
	{
		$oCustomalertModel = getModel('customalert');
		$module_config = $oCustomalertModel->getConfig();
		Context::set('config', $module_config);
	}

	function dispCustomalertAdminTabEx()
	{
		//tab
	}
}
