<?php

include_once ROOT_DIR . '/src/models/User.php';
include_once ROOT_DIR . '/src/core/Security.php';

class RegistrationForm
{
    private const PASSWORD_LENGTH = 8;
    public array $errors;
    private Security $security;
    private User     $user;

    public function __construct()
    {
        $this->errors = [];
        $this->security = new Security();
        $this->user = new User();
    }

    public function register(array $form): void
    {
        $firstname      = $form['firstname'];
        $lastname       = $form['lastname'];
        $email          = $form['email'];
        $password       = $form['password'];
        $passwordRetype = $form['password_retype'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "L'email est incorrecte.";
        }
        if (empty($lastname)) {
            $this->errors['lastname'] = "Le nom ne peut être vide.";
        }
        if (empty($firstname)) {
            $this->errors['firstname'] = "Le prénom ne peut être vide.";
        }
        if (strlen($password) < self::PASSWORD_LENGTH) {
            $this->errors['password_short'] = sprintf("Le mot de passe doit contenir au moins %s caractères.", self::PASSWORD_LENGTH);
        }
        if (empty($password) || $password !== $passwordRetype) {
            $this->errors['password_not_match'] = "Les mots de passes ne correspondent pas.";
        }
        if ($this->user->getUserByMail($email)) {
            $this->errors['email_exists'] = "Cet adresse email est déjà enregistrée, veuillez en choisir une autre.";
        }

        $user = [
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email,
            'password'  => $this->security->createPassword($password),
            'status'    => 'user',
        ];

        if (!$this->errors) {
            $this->user->insertUser($user);
            header('Location: /login.php');
            exit;
        }
    }
}

$registrationFormClass = new RegistrationForm();