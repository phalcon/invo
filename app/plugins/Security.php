<?php

use Phalcon\Flash as Flash;

class Security
{

	/**
	 * @var Phalcon\Acl\Adapter\Memory
	 */
	protected $_acl;

	public function getAcl()
	{
		if (!$this->_acl) {

			$acl = new Phalcon\Acl\Adapter\Memory();

			$acl->setDefaultAction(Phalcon\Acl::DENY);

			$this->_acl = $acl;
			return $acl;
		}
	}

	/**
	 * This action is executed before execute any action in the application
	 */
	public function beforeDispatch(Phalcon\Events\Event $event, Phalcon\Mvc\Dispatcher $dispatcher)
	{
		$controllerName = $dispatcher->getControllerName();

		/*if ($controllerName != 'index') {

			$acl = $this->getAcl();

			$actionName = $dispatcher->getActionName();
			$allowed = $acl->isAllowed('Users', $controllerName, $actionName);
			if ($allowed != Phalcon\Acl::ALLOW) {
				Flash::error('You don\'t have access to this module', 'alert alert-error');
				$dispatcher->forward(array('controller' => 'index', 'action' => 'index'));
				return false;
			}
		}*/

	}

}