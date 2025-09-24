Dupla:Miguel Pires 1999181, Vinicius Press 2003646

Execução XAMPP:
1-Instale o XAMPP no seu computador  
2-Copie a pasta do projeto para `htdocs` dentro da instalação do XAMPP.    
3. Abra o painel do XAMPP e clique em Start no Apache.  
4. No navegador, acesse: http://localhost/usuarios/public/index.php

Funcionalidades: cadastro de usuários com validação de e-mail e senha
Login com autenticação segura usando password_verify
Reset de senha com validação de força
Prevenção de e-mails duplicados
Uso de POO (classes User, Validator e UserManager
Senhas armazenadas com password_hash

Regras de Negócio:
Senha deve ter mínimo 8 caracteres, 1 letra maiúscula e 1 número
E-mail deve ser válido segundo `filter_var`
Não é permitido cadastrar dois usuários com o mesmo e-mail
Usuários são armazenados em memória (array) apenas para simulação

Limitaçoes:
Não há persistência em banco de dados, os dados somem ao reiniciar o script
Sem interface gráfica — apenas execução em console ou saída textual no navegador
Não há testes automatizados somente casos de uso manuais no index.php

Casos de uso:
1 Cadastro válido  
Entrada: nome = "Mariana Costa", email = "mariana@example.com", senha = "SenhaForte9"  
Saída esperada: "Usuário cadastrado com sucesso!"  

2 Cadastro com e-mail inválido  
Entrada: nome = "Pedro", email = "pedro@@email", senha = "Senha123"  
Saída esperada: "Erro: E-mail inválido."  

3 Tentativa de login com senha errada 
Entrada: email = "joao@email.com", senha = "Errada123"  
Saída esperada: "Erro: Credenciais inválidas."  

4 Reset de senha válido 
Entrada: id = 1, novaSenha = "NovaSenha1"  
Saída esperada: Senha alterada com sucesso 

5 Cadastro de usuário com e-mail duplicado
Entrada: nome = "João Silva 2", email = "joao@email.com", senha = "SenhaForte2"  
Saída esperada: "Erro: E-mail já está em uso."  
