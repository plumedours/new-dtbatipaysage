<?php

include_once  ROOT_DIR . '/src/core/Database.php';
include_once ROOT_DIR . '/src/core/Session.php';
include_once ROOT_DIR . '/src/models/Photo.php';

class UploadPhoto
{
    private $file = [];
    private $name = '';
    private $directory = 'img/gallery';
    private $max_size = '5';
    private $ext_allowed = ['jpg', 'jpeg', 'png', 'gif'];
    private $error = '';
    public Photo $photo;

    public function __construct()
    {
        $this->photo = new Photo();
    }

    public function set($f)
    {
        if (is_array($f)) {
            $this->file = $f;
        } else {
            $this->error = 'Le format du fichier est invalide !';
        }
        return $this;
    }

    public function name($n)
    {
        $this->name = $n;
        return $this;
    }

    public function max_size($s)
    {
        if (is_int($s) and $s > 0) {
            $this->max_size = $s * 1024 * 1024;
        } else {
            $this->error = 'Le fichier doit être supérieur à 0 octet !';
        }
        return $this;
    }

    public function directory($d)
    {
        $this->directory = $d;
        return $this;
    }

    public function get_extension()
    {
        $this->fn = explode(".", $this->file['name']);
        $this->ext = end($this->fn);
        if (!in_array($this->ext, $this->ext_allowed)) {
            $this->error = 'Il faut une image !';
        }
        return $this->ext;
    }

    public function get_size()
    {
        return $this->file['size'];
    }

    public function get_dir()
    {
        if (!is_dir($this->directory)) {
            mkdir($this->directory);
        }
        return $this->directory;
    }

    public function get_name()
    {
        if (empty($this->name)) {
            $this->name = date("YmdHis");
        }
        $this->fc = $this->get_dir() . DIRECTORY_SEPARATOR . $this->name . "." . $this->get_extension();
        if (file_exists($this->fc)) {
            $this->i = 0;
            do {
                $this->name = $this->name . $this->i;
                $this->fc = $this->get_dir() . DIRECTORY_SEPARATOR . $this->name . "." . $this->get_extension();
                $this->i++;
            } while (file_exists($this->fc));
        }
        return $this->name;
    }

    private function destination()
    {
        $this->d = '';
        $this->d .= $this->get_dir() . DIRECTORY_SEPARATOR;
        $this->d .= $this->get_name();
        $this->d .= "." . $this->get_extension();
        return $this->d;
    }

    public function upload()
    {
        if ($this->max_size < $this->get_size()) {
            $this->error = "Le fichier fait "
                . round($this->get_size() / (1024 * 1024), 2)
                . "MB, le maximum autorisé est de "
                . round($this->max_size / (1024 * 1024), 2)
                . "MB !";
        }
        if (empty($this->error)) {
            return move_uploaded_file($this->file['tmp_name'], $this->destination());
        } else {
            return false;
        }
    }

    public function report()
    {
        return $this->error;
    }

    public function newPhoto(array $form, $file): void
    {
        $photoName = $this->name . '.' . $this->ext;
        $category_id = $form['category'];
        $type = $file['type'];

        $photo = [
            'name' => $photoName,
            'category' => $category_id,
            'type' => $type,
        ];

        $this->photo->addPhoto($photo);
    }
}
