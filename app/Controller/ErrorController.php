<?php

	class ErrorController
	{
		public function index()
		{
			try {

				$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template = $twig->load('error.html');

				$content = $template->render();
				echo $content;
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
	}