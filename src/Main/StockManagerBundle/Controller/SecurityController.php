<?php
namespace Main\StockManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller{
	public function loginAction(Request $request){
		$session = $request->getSession();
		
		// get the login error if there is one
		if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
			$error = "Invalid username or password";
			//$error = $request->attributes->get(
				//	SecurityContextInterface::AUTHENTICATION_ERROR
			//);
		} elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
			//$error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
			$error = "Invalid username or password";
			$session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
		} else {
			$error = '';
		}
		
		// last username entered by the user
		$lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);
		
		return $this->render(
				'MainStockManagerBundle:Pages:login.html.twig',
				array(
						// last username entered by the user
						'last_username' => $lastUsername,
						'error'         => $error,
				)
		);
	}
}
?>