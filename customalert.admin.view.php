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
		
		$module_info = $oModuleModel->getModuleInfoByMid('customalert_module_2fa');
		if(!$module_info->module_srl) {
			return new Object(1,'need_to_install_module_first');
		}

		$oCustomalertModel = getModel('customalert');
		$module_config = $oCustomalertModel->getConfig();
		Context::set('config', $module_config);

		// Get the skin information
		$skin_list = $oModuleModel->getSkins($this->module_path);
		Context::set('skin_list', $skin_list);

		// If skin is not exist or not set, use default
		if(!$skin_list[$module_info->skin]) $config->skin = "default";

		$skin_info = $skin_list[$module_info->skin];

		// Set the skin colorset once the configurations is completed
		Context::set('colorset_list', $skin_info->colorset);

		Context::set('module_srl', $module_info->module_srl);
		
		if(count($skin_info->author) == 0) {
			$author = "Unknown";
		} else {
			for($i=0;$i<count($skin_info->author);$i++)
			{
				if(isset($skin_info->author[$i]->homepage) && $skin_info->author[$i]->homepage != "") {
					$author[] = sprintf('<a href="%s">%s</a>', htmlspecialchars($skin_info->author[$i]->homepage, ENT_COMPAT | ENT_HTML401, 'UTF-8', false), htmlspecialchars($skin_info->author[$i]->name, ENT_COMPAT | ENT_HTML401, 'UTF-8', false));
				} else {
					$author[] = sprintf('%s', htmlspecialchars($skin_info->author[$i]->name, ENT_COMPAT | ENT_HTML401, 'UTF-8', false));
				}
				
				$author = implode(", ",$author);
			}
		}
		
		Context::set('skin_info',htmlspecialchars($skin_info->description, ENT_COMPAT | ENT_HTML401, 'UTF-8', false) . "<br />By  " . $author);

		$security = new Security();
		$security->encodeHTML('config..');
		$security->encodeHTML('skin_list..title');
		$security->encodeHTML('colorset_list..name','colorset_list..title');
		$security->encodeHTML('module_srl');
	}

	/**
	 * Display skin setting page
	 */
	function dispCustomalertAdminSkinInfo()
	{
		$oModuleAdminModel = getAdminModel('module');
		$oModuleModel = getModel('module');
		
		$module_info = $oModuleModel->getModuleInfoByMid('customalert_module_2fa');
		if(!$module_info->module_srl) {
			return new Object(1,'need_to_install_module_first');
		}
		$skin_content = $oModuleAdminModel->getModuleSkinHTML($module_info->module_srl);
		Context::set('skin_content', $skin_content);
		$this->setTemplateFile('skin_info');
	}
}
