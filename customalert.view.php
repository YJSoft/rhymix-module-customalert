<?php
class customalertView extends customalert
{
	function init()
	{
		$oModuleModel = getModel('module');
		$module_info = $oModuleModel->getModuleInfoByMid('customalert_module_2fa');

		$template_path = sprintf("%sskins/%s/",$this->module_path, $module_info->skin);
		if(!is_dir($template_path)||!$module_info->skin)
		{
			$this->module_info->skin = 'default';
			$template_path = sprintf("%sskins/%s/",$this->module_path, $module_info->skin);
		}
		$this->setTemplatePath($template_path);
	}

	function dispCustomalert2fa() {
		$this->setTemplateFile('alert');
	}
}
