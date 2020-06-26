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

	protected function uploadImage(string $name, string $path) 
	{

		$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
		
		$filename = $_FILES[$name]["name"];
        $filetype = $_FILES[$name]["type"];
		$filesize = $_FILES[$name]["size"];
		
		// Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
		
		// Verify MYME type of the file
		if(in_array($filetype, $allowed))
		{
            // Check whether file exists before uploading it
			if(file_exists(dirname(__DIR__, 4) . $path . $filename))
			{
                echo $filename . " already exists.";
			} 
			else
			{
                move_uploaded_file($_FILES[$name]["tmp_name"], dirname(__DIR__, 4) . $path . $filename);
                echo "Your file was uploaded successfully.";
            } 
		} 
		else
		{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
	} 
		
}