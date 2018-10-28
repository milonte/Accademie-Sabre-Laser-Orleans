<?php

/**
 * Created by Milon Teddy.
 * User: milonte
 * Date: 17/10/2018
 * Time: 16:07
 * PHP version 7
 */
namespace Controller;

use Model\EventManager;
use Model\Event;

/**
 * Class EventsController
 *
 */
class EventController extends AbstractController
{
    const MIN_TITLE_LENGTH = 3;
    const MIN_CONTENT_LENGTH = 10;
    const CONTENT_FILTER = "#[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ!?,:'()\r\n ]$# ";
    const MIME_TYPES = [
        'png' => 'image/png',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
    ];
    const FILE_MAX_SIZE = 2000000;

    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        $eventManager = new EventManager($this->getPdo());
        $events = $eventManager->selectAll();

        return $this->twig->render('Event/events.html.twig', ['events' => $events]);
    }

    /**
     * Display admin listing events
     *
     * @return string
     */
    public function list()
    {
        $eventManager = new EventManager($this->getPdo());
        $events = $eventManager->selectAll();

        return $this->twig->render('Event/list.html.twig', ['events' => $events]);
    }

    /**
     * Display event creation page
     *
     * @return string
     */
    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventManager = new EventManager($this->getPdo());
            $event = new Event();

            if (!$this->formErrors()) {

                $event->setTitle(trim($_POST['title']));
                $event->setContent(trim($_POST['content']));
                $event->setDate(new \DateTime());

                if (strlen($_FILES['file']['name']) > 0) {
                    $uploadDir = 'assets/images/events/';
                    $mime_content = explode('/', mime_content_type($_FILES['file']['tmp_name']))[1];
                    $uniqueName = basename(uniqid('image_') . '.' . $mime_content);
                    $uploadFile = $uploadDir . $uniqueName;
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);
                    $event->setImageUrl($uniqueName);
                } else {
                    $event->setImageUrl("");
                }

                if (strlen(trim($_POST['linkUrl'])) > 0) {
                    $event->setLinkUrl(trim($_POST['linkUrl']));
                } else {
                    $event->setLinkUrl("");
                }

                $eventManager->insert($event);
                header('Location:/events');
            }

            $errors = $this->formErrors();
        }

        return $this->twig->render('Event/add.html.twig', ['errors' => $errors]);
    }

    /**
     * Check form inputs
     * @return table of errors (or bool false if no errors)
     */
    private function formErrors()
    {
        $errors = [];

        if (!isset($_POST['title']) || strlen(trim($_POST['title'])) < self::MIN_TITLE_LENGTH) {
            $errors['title_length'] = "Le titre doit contenir minimum " . self::MIN_TITLE_LENGTH . " caractères !";
        } else if (!preg_match(self::CONTENT_FILTER, $_POST['title'])) {
            $errors['title_regex'] = "Le titre contient des caractères spéciaux";
        }

        if (!isset($_POST['content']) || strlen(trim($_POST['content'])) < self::MIN_CONTENT_LENGTH) {
            $errors['content_length'] = "Le contenu doit contenir minimum " . self::MIN_CONTENT_LENGTH . " caractères !";
        } else if (!preg_match(self::CONTENT_FILTER, trim($_POST['content']))) {
            $errors['content_regex'] = "Le contenu contient des caractères spéciaux";
        }

        if (!empty($_FILES['file']['name'])) {

            $mime_content = explode('/', mime_content_type($_FILES['file']['tmp_name']))[1];
            echo $mime_content;

            if (!array_key_exists($mime_content, self::MIME_TYPES)) {
                $errors['image_type'] = "Formats d'images acceptés : " . implode(", ", array_keys(self::MIME_TYPES));
            }
            if (filesize($_FILES['file']['tmp_name']) > self::FILE_MAX_SIZE) {
                $errors['image_size'] = "Image trop lourde (>2Mo)";
            }
        }

        if ($_POST['linkUrl']) {
            if (!(filter_var($_POST['linkUrl'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED))) {
                $errors['link_regex'] = "Format non valide (format accepté : http://www.website.com)";
            }
        }

        if (count($errors) === 0) {
            $errors = false;
        } else {
            $errors['title'] = trim($_POST['title']);
            $errors['content'] = trim($_POST['content']);
            $errors['linkUrl'] = trim($_POST['linkUrl']);
        }
        return $errors;

    }
} 
