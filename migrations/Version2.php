<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version2 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `wallet` (id INT AUTO_INCREMENT NOT NULL, client_id INT(11) NOT NULL, balance DECIMAL(15, 2) NOT NULL, currency_id INT(11) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `wallet_history` (id INT AUTO_INCREMENT NOT NULL, wallet_id INT(11) NOT NULL, type_transaction_code VARCHAR(20) NOT NULL, amount DECIMAL(15, 2) NOT NULL, currency_id INT(11) NOT NULL, created DATETIME DEFAULT current_timestamp() NOT NULL, reason_code VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `currency_rate` (id INT AUTO_INCREMENT NOT NULL, from_currency_id INT(11) NOT NULL, to_currency_id INT(11) NOT NULL, rate DECIMAL(15, 4) NOT NULL, created DATETIME DEFAULT current_timestamp() NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `wallet`');
        $this->addSql('DROP TABLE `wallet_history`');
        $this->addSql('DROP TABLE `currency_rate`');
    }
}