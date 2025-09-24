<?php
require_once "cadastro.php"; 

$user = new User();
$validator = new Validator();
$manager = new UserManager($user, $validator);


echo "Caso 1 — Cadastro válido:\n";
echo $manager->register("Maria Oliveira", "maria@email.com", "Senha123");
echo "\n\n";

echo "Caso 2 — Cadastro com e-mail inválido:\n";
echo $manager->register("Pedro", "pedro@@email", "Senha123");
echo "\n\n";

echo "Caso 3 — Tentativa de login com senha errada:\n";
echo $manager->login("joao@email.com", "Errada123");
echo "\n\n";

echo "Caso 4 — Reset de senha válido:\n";
echo $manager->resetPassword(1, "NovaSenha1");
echo "\n\n";

echo "Caso 5 — Cadastro de usuário com e-mail duplicado:\n";
echo $manager->register("João Silva 2", "joao@email.com", "SenhaForte2");
echo "\n\n";
