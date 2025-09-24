    <?php


    class User
    {
        private array $users = [];

        public function __construct()
            {   
                $this->users = [
                    ['id' => 1, 'nome' => 'João Silva', 'email' => 'joao@email.com', 'senha' => password_hash('SenhaForte1', PASSWORD_DEFAULT)],
                    ['id' => 2, 'nome' => 'Maria Oliveira', 'email' => 'maria@email.com', 'senha' => password_hash('Senha123', PASSWORD_DEFAULT)],
                    ['id' => 3, 'nome' => 'Pedro', 'email' => 'pedro@email.com', 'senha' => password_hash('Senha123', PASSWORD_DEFAULT)],
                ];
            }


        public function getUsers(): array
        {
            return $this->users;
        }

        public function addUser(array $user): void
        {
            $this->users[] = $user;
        }

        public function updatePassword(int $id, string $novaSenhaHash): bool
        {
            foreach ($this->users as &$user) {
                if ($user['id'] === $id) {
                    $user['senha'] = $novaSenhaHash;
                    return true;
                }
            }
            return false;
        }
    }


    class Validator
    {
        public function validateEmail(string $email): bool 
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }

        public function validatePassword(string $senha): bool
        {
            return strlen($senha) >=8
            && preg_match('/[A-Z]/', $senha) 
            && preg_match('/[0-9]/', $senha);
        }


    }

    class UserManager
    {
        private User $user;
        private Validator $validator;

        public function __construct(User $user, Validator $validator)
        {
            $this->user = $user;
            $this->validator = $validator;
        }

        public function register(string $nome, string $email, string $senha): string
        {
            if (!$this->validator->validateEmail($email)) {
                return "Erro: E-mail inválido.";
            }

            if (!$this->validator->validatePassword($senha)) {
                return "Erro: Senha fraca. Deve ter no mínimo 8 caracteres, 1 letra maiúscula e 1 número.";
            }

            foreach ($this->user->getUsers() as $usuario) {
                if ($usuario['email'] === $email) {
                    return "Erro: E-mail já está em uso.";
                }
            }

            $novoUser = [
                'id' => count($this->user->getUsers()) + 1,
                'nome' => $nome,
                'email' => $email,
                'senha' => password_hash($senha, PASSWORD_DEFAULT),
            ];

            $this->user->addUser($novoUser);
            return "Usuário cadastrado com sucesso!";
        }

        public function login(string $email, string $senha): string
        {
            foreach ($this->user->getUsers() as $usuario) {
                if ($usuario['email'] === $email && password_verify($senha, $usuario['senha'])) {
                    return "Login realizado com sucesso. Bem-vindo, {$usuario['nome']}!";
                }
            }
            return "Erro: Credenciais inválidas.";
        }

        public function resetPassword(int $id, string $novaSenha): string
        {
            if (!$this->validator->validatePassword($novaSenha)) {
                return "Erro: Nova senha fraca.";
            }

            $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

            if ($this->user->updatePassword($id, $novaSenhaHash)) {
                return "Senha alterada com sucesso.";
            }

            return "Erro: Usuário não encontrado.";
        }
    }
