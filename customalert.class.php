<?php
class customalert extends ModuleObject
{
	private $triggers = array();

	function moduleInstall()
	{
		$oModuleController = getController('module');
		$oModuleModel = getModel('module');

		foreach($this->triggers as $trigger)
		{
			$oModuleController->insertTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]);
		}

		$module_info = $oModuleModel->getModuleInfoByMid('customalert_module_2fa');
		if($module_info->module_srl)
		{
			if($module_info->module != 'customalert')
			{
				return new Object(1,'already_installed_or_mid_duplicate');
			}
		}
		else
		{
			$args = new stdClass;
			$args->mid = 'customalert_module_2fa';
			$args->module = 'customalert';
			$args->browser_title = "DO_NOT_CHANGE_OR_USE_THIS_MID";
			$args->site_srl = 0;
			$args->skin = 'default';
			$args->order_type = 'desc';
			$output = $oModuleController->insertModule($args);
			if(!$output->toBool())
			{
				return new Object(-1, 'msg_invalid_request');
			}
		}

		return new Object();
	}

	function checkUpdate()
	{
		$oModuleModel = getModel('module');

		foreach($this->triggers as $trigger)
		{
			if(!$oModuleModel->getTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]))
			{
				return true;
			}
		}

		$module_info = $oModuleModel->getModuleInfoByMid('customalert_module_2fa');
		if(!$module_info->module_srl)
		{
			return true;
		}

		if($module_info->module_srl)
		{
			if($module_info->module != 'customalert')
			{
				return true;
			}
		}

		return false;
	}

	function moduleUpdate()
	{
		$oModuleModel = getModel('module');
		$oModuleController = getController('module');

		foreach($this->triggers as $trigger)
		{
			if(!$oModuleModel->getTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]))
			{
				$oModuleController->insertTrigger($trigger[0], $trigger[1], $trigger[2], $trigger[3], $trigger[4]);
			}
		}

		$module_info = $oModuleModel->getModuleInfoByMid('customalert_module_2fa');
		if($module_info->module_srl)
		{
			if($module_info->module != 'customalert')
			{
				return new Object(1,'already_installed_or_mid_duplicate');
			}
		}
		else
		{
			$args = new stdClass;
			$args->mid = 'customalert_module_2fa';
			$args->module = 'customalert';
			$args->browser_title = "DO_NOT_CHANGE_OR_USE_THIS_MID";
			$args->site_srl = 0;
			$args->skin = 'default';
			$args->order_type = 'desc';
			$output = $oModuleController->insertModule($args);
			if(!$output->toBool())
			{
				return new Object(-1, 'msg_invalid_request');
			}
		}

		return new Object(0, 'success_updated');
	}

	function moduleUninstall()
	{
		return new Object();
	}

	function recompileCache()
	{
		return new Object();
	}
}
