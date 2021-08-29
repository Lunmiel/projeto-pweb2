<?php

require_once '../models/seller.php';
require_once '../dao/sellerDao.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$seller = new Seller($email, $password, $name);
$sellerDao = new SellerDao();

if ($sellerDao->get($seller) == null) {
  $sellerDao->create($seller);

  session_start();
  $_SESSION['userEmail'] = $seller->getEmail();

  header('Location: ../views/homeSeller.php');
} else {
  echo '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Criando conta...</title>
    </head>
    <body>
      <h1>Ops...</h1>
      <p>Já existe uma conta com o e-mail informado.</p>
      <p>
        Você pode
        <a href="../views/loginSeller.php">Fazer login</a>
        , se você for o proprietário da conta, ou
        <a href="../views/sellerSignup.php">Tentar novamente</a>
        com um e-mail e/ou nome de usuário diferente.
      </p>
    </body>
    </html>
  ';
}