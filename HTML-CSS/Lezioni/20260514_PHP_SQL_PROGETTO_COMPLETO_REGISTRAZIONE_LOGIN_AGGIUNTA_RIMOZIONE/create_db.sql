-- Creazione del DB
CREATE DATABASE IF NOT EXISTS `blog_system`;

-- Chiama il database appena creato
USE blog_system;

-- Creazione della tabella
CREATE TABLE IF NOT EXISTS `utenti` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(150) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `ruoli` VARCHAR(50) NOT NULL DEFAULT 'user',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabella per i post
CREATE TABLE IF NOT EXISTS post (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `titolo` VARCHAR(255) NOT NULL,
    `contenuto` TEXT NOT NULL,
    `utente_id` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utente_id) REFERENCES utenti(id) ON DELETE CASCADE
)

