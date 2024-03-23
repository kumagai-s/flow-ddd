<?php
declare(strict_types=1);

namespace Vendor\Demo\Presentation\Api\Controller;

use Neos\Flow\Mvc\Controller\RestController;

class UserController extends RestController
{
    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('foos', array(
            'bar', 'baz'
        ));
    }
}
