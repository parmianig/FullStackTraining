<?php

declare(strict_types=1);

class Persona
{
    private const VALID_ROLES = ['user', 'editor', 'admin'];

    private string $nome;
    private string $email;
    private array $ruoli;
    private string $stato;

    public function __construct(string $nome, string $email, array $ruoli, string $stato = 'attivo')
    {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setRuoli($ruoli);
        $this->stato = $stato;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRuoli(): array
    {
        return $this->ruoli;
    }

    public function getStato(): string
    {
        return $this->stato;
    }

    public function setNome(string $nome): void
    {
        $nome = trim($nome);

        if ($nome === '' || mb_strlen($nome) < 3) {
            throw new InvalidArgumentException('Il nome deve contenere almeno 3 caratteri.');
        }

        $this->nome = $nome;
    }

    public function setEmail(string $email): void
    {
        $email = trim($email);

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('L\'email non è valida.');
        }

        $this->email = $email;
    }

    public function setRuoli(array $ruoli): void
    {
        $roles = array_values(array_filter(array_map('trim', $ruoli), static function (string $ruolo): bool {
            return in_array($ruolo, self::VALID_ROLES, true);
        }));

        if ($roles === []) {
            throw new InvalidArgumentException('Almeno un ruolo valido è richiesto.');
        }

        $this->ruoli = array_unique($roles);
    }

    public function hasRole(string $ruolo): bool
    {
        return in_array($ruolo, $this->ruoli, true);
    }

    public function addRole(string $ruolo): void
    {
        if (!in_array($ruolo, self::VALID_ROLES, true)) {
            throw new InvalidArgumentException(sprintf('Ruolo non valido: %s', $ruolo));
        }

        if (!$this->hasRole($ruolo)) {
            $this->ruoli[] = $ruolo;
        }
    }

    public function isActive(): bool
    {
        return $this->stato === 'attivo';
    }

    public function activate(): void
    {
        $this->stato = 'attivo';
    }

    public function deactivate(): void
    {
        $this->stato = 'disattivo';
    }
}
