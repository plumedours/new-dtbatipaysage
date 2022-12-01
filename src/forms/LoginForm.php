<?php

include_once ROOT_DIR . '/src/models/User.php';
include_once ROOT_DIR . '/src/core/Security.php';
include_once ROOT_DIR . '/src/core/Session.php';

class LoginForm
{
    private User     $user;
    private Security $security;
    public array     $errors;
    private Session  $session;

    public function __construct()
    {
        $this->user = new User();
        $this->security = new Security();
        $this->session = new Session();
        $this->errors = [];
    }

    public function login(array $form): void
    {
        $email    = $form['email'];
        $password = $form['password'];

        if (empty($email) || empty($password)) {
            $this->errors['userNotFound'] = "L'utilisateur ou le mot de passe est incorrect.";
        } else {
            $userCheck = $this->user->getUserByMail($email);
            if ($userCheck && $password) {
                $passwordCheck = $this->security->checkPassword($password, $userCheck['password']);
            }

            if (!$userCheck || !$passwordCheck) {
                $this->errors['userNotFound'] = "L'utilisateur ou le mot de passe est incorrect.";
            }
        }

        if (!$this->errors) {
            $this->session->set('status', $userCheck['status']);
            $this->session->set('loggedIn', true);
            $this->session->set('loggedDate', time());
            $this->session->set('initials', strtoupper($userCheck['firstname'][0] . $userCheck['lastname'][0]));
            $this->session->set('userId', $userCheck['id']);

            header('Location: /gallery.php');
            exit;
        }
    }
}

$loginFormClass = new LoginForm();
