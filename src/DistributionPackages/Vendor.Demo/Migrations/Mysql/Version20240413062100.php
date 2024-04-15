<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413062100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE companies (persistence_object_identifier VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies_accounts (company_id VARCHAR(40) NOT NULL, account_id VARCHAR(40) NOT NULL, INDEX IDX_87A68E7D979B1AD6 (company_id), INDEX IDX_87A68E7D9B6B5FBA (account_id), PRIMARY KEY(company_id, account_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employees (persistence_object_identifier VARCHAR(40) NOT NULL, company_id VARCHAR(40) DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_BA82C300979B1AD6 (company_id), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE punch_records (persistence_object_identifier VARCHAR(40) NOT NULL, employee_id VARCHAR(40) DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_5B578B418C03F15C (employee_id), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE companies_accounts ADD CONSTRAINT FK_87A68E7D979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (persistence_object_identifier)');
        $this->addSql('ALTER TABLE companies_accounts ADD CONSTRAINT FK_87A68E7D9B6B5FBA FOREIGN KEY (account_id) REFERENCES neos_flow_security_account (persistence_object_identifier)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (persistence_object_identifier)');
        $this->addSql('ALTER TABLE punch_records ADD CONSTRAINT FK_5B578B418C03F15C FOREIGN KEY (employee_id) REFERENCES employees (persistence_object_identifier)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('ALTER TABLE companies_accounts DROP FOREIGN KEY FK_87A68E7D979B1AD6');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300979B1AD6');
        $this->addSql('ALTER TABLE punch_records DROP FOREIGN KEY FK_5B578B418C03F15C');
        $this->addSql('DROP TABLE companies');
        $this->addSql('DROP TABLE companies_accounts');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE punch_records');
    }
}
