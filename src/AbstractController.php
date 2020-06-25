<?php

namespace PHPNinja;

abstract class AbstractController
{
	private $templateEngine;

	private $_session;

    private $_flashbag;


	public function __construct()
	{
		$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__, 4) . '\templates');
		$this->templateEngine = new \Twig\Environment($loader);
	} 

	protected function render($view, $vars = [])
	{
		$data = array_merge(
			$vars,
			$this->session()->get()
		);

		return $this->templateEngine->render($view.'.html.twig', $data);
	}

	protected function session()
	{
		if($this->_session == null)
		{
			$this->_session = new Session();
		}
		return $this->_session;
	}

	protected function flashbag()
    {
        if($this->_flashbag === null) {
            $this->_flashbag = new FlashBag();
        }
        return $this->_flashbag;
    }

    protected function redirectToRoute(string $url)
    {
        header("location:".$url);
        exit();
	}
		
}