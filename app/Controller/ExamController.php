<?php

use App\Model\Exam;

class ExamController
{
    final public function index()
    {
        try {
            $collectValues = Exam::selectAll();

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $params = array();
            $params['datas'] = $collectValues;
            // var_dump($params);exit;

            $content = $template->render($params);
            echo $content;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    final public function delete($id)
    {
        try {
            Exam::delete($id);

            echo '<script>alert("Exame excluído com sucesso!");</script>';
            echo '<script>location.href="http://localhost:85"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost:85"</script>';
        }
    }

    final public function filter()
    {
        try {
            $collectValues = Exam::filter($_POST);

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $params = array();
            $params['datas'] = $collectValues;

            $content = $template->render($params);
            echo $content;
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost:85"</script>';
        }
    }

    final public function register()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('register.html');

            echo $template->render();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    final public function insert()
    {
        try {
            Exam::insert($_POST);

            echo '<script>alert("Exame cadastrado com sucesso!");</script>';
            echo '<script>location.href="http://localhost:85/"</script>';
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="http://localhost:85/"</script>';
        }
    }

    final public function alter($id)
		{
			try {
				$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template = $twig->load('update.html');

                $exam = Exam::selectId($id);

                $params = array();
                $params['id'] = $exam->id;
                $params['id_estudo'] = $exam->id_estudo;
                $params['nome_paciente'] = $exam->nome_paciente;
                $params['id_paciente'] = $exam->id_paciente;
                $params['modalidade'] = $exam->modalidade;
                $params['data_estudo'] = $exam->data_estudo;
                $params['data_registro'] = $exam->data_registro;

                $content = $template->render($params);
                echo $content;
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}

        final public function update()
        {
            try {
				Exam::update($_POST);

				echo '<script>alert("Exame alterado com sucesso!");</script>';
				echo '<script>location.href="http://localhost:85"</script>';
			} catch (Exception $e) {
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost:85/"</script>';
			}
        }

}
