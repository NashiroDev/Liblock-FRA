<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619133902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_file (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) NOT NULL, file_size INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_file_articles (image_file_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_4A835CFE6DB2EB0 (image_file_id), INDEX IDX_4A835CFE1EBAF6CC (articles_id), PRIMARY KEY(image_file_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_file_articles ADD CONSTRAINT FK_4A835CFE6DB2EB0 FOREIGN KEY (image_file_id) REFERENCES image_file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_file_articles ADD CONSTRAINT FK_4A835CFE1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_file_articles DROP FOREIGN KEY FK_4A835CFE6DB2EB0');
        $this->addSql('ALTER TABLE image_file_articles DROP FOREIGN KEY FK_4A835CFE1EBAF6CC');
        $this->addSql('DROP TABLE image_file');
        $this->addSql('DROP TABLE image_file_articles');
    }
}
