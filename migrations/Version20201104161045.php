<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201104161045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE label (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, comment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location_accounting (id INT AUTO_INCREMENT NOT NULL, operation_type_id INT NOT NULL, label_id INT NOT NULL, location_id INT NOT NULL, value INT NOT NULL, date DATE DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_D4ED003A668D0C5E (operation_type_id), INDEX IDX_D4ED003A33B92F39 (label_id), INDEX IDX_D4ED003A64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, property_type_id INT NOT NULL, location_id INT NOT NULL, name VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_8BF21CDE9C81C6EB (property_type_id), INDEX IDX_8BF21CDE64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_accounting (id INT AUTO_INCREMENT NOT NULL, operation_type_id INT NOT NULL, label_id INT NOT NULL, property_id INT NOT NULL, value INT NOT NULL, date DATE DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_D86421D6668D0C5E (operation_type_id), INDEX IDX_D86421D633B92F39 (label_id), INDEX IDX_D86421D6549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location_accounting ADD CONSTRAINT FK_D4ED003A668D0C5E FOREIGN KEY (operation_type_id) REFERENCES operation_type (id)');
        $this->addSql('ALTER TABLE location_accounting ADD CONSTRAINT FK_D4ED003A33B92F39 FOREIGN KEY (label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE location_accounting ADD CONSTRAINT FK_D4ED003A64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE9C81C6EB FOREIGN KEY (property_type_id) REFERENCES property_type (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE property_accounting ADD CONSTRAINT FK_D86421D6668D0C5E FOREIGN KEY (operation_type_id) REFERENCES operation_type (id)');
        $this->addSql('ALTER TABLE property_accounting ADD CONSTRAINT FK_D86421D633B92F39 FOREIGN KEY (label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE property_accounting ADD CONSTRAINT FK_D86421D6549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location_accounting DROP FOREIGN KEY FK_D4ED003A33B92F39');
        $this->addSql('ALTER TABLE property_accounting DROP FOREIGN KEY FK_D86421D633B92F39');
        $this->addSql('ALTER TABLE location_accounting DROP FOREIGN KEY FK_D4ED003A64D218E');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE64D218E');
        $this->addSql('ALTER TABLE location_accounting DROP FOREIGN KEY FK_D4ED003A668D0C5E');
        $this->addSql('ALTER TABLE property_accounting DROP FOREIGN KEY FK_D86421D6668D0C5E');
        $this->addSql('ALTER TABLE property_accounting DROP FOREIGN KEY FK_D86421D6549213EC');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE9C81C6EB');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE location_accounting');
        $this->addSql('DROP TABLE operation_type');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE property_accounting');
        $this->addSql('DROP TABLE property_type');
        $this->addSql('DROP TABLE user');
    }
}
