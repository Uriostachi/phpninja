<?php

namespace PHPNinja;

abstract class AbstractController
{
	private $templateEngine;

	public function __construct()
	{
		$loader = new \Twig\Loader\FilesystemLoader(dirname(dirname(__DIR__)) . '/templates');
		$this->templateEngine = new \Twig\Environment($loader);
	} 

	protected function render($view, $vars = [])
	{
		//echo "$view.html.twig";
		return $this->templateEngine->render($view.'.html.twig', $vars);
	}
}