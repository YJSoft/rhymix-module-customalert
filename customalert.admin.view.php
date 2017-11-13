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
		$oModuleModel = getModel('module');
		$oCustomalertModel = getModel('customalert');
		$module_config = $oCustomalertModel->getConfig();
		Context::set('config', $module_config);

		// Get the skin information
		$skin_list = $oModuleModel->getSkins($this->module_path);
		Context::set('skin_list', $skin_list);

		// If skin is not set, use default
		if(!$skin_list[$config->skin]) $config->skin = "default";

		// Set the skin colorset once the configurations is completed
		Context::set('colorset_list', $skin_list[$config->skin]->colorset);

		$security = new Security();
		$security->encodeHTML('config..');
		$security->encodeHTML('skin_list..title');
		$security->encodeHTML('colorset_list..name','colorset_list..title');
	}
}
