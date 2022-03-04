<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version3 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("
            INSERT INTO `currency_rate` (`id`, `from_currency_id`, `to_currency_id`, `rate`, `created`)
            VALUES
                   (1, 810, 840, 0.0131, now()),
                   (2, 840, 810, 71.5100, now());

            INSERT INTO `wallet` (`id`, `client_id`, `balance`, `currency_id`)
            VALUES
                   (1, 111, 0, 810),
                   (2, 222, 0, 840);

        ");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM `currency_rate`');
        $this->addSql('DELETE FROM `wallet`');
    }
}