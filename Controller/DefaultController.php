<?php

namespace SC\DatetimepickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('StephaneCollotDatetimepickerBundle:Default:index.html.twig', array('name' => $name));
    }
}
