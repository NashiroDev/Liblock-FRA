<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610145208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_themes DROP FOREIGN KEY FK_AF7AE6F31EBAF6CC');
        $this->addSql('ALTER TABLE articles_themes DROP FOREIGN KEY FK_AF7AE6F394F4A9D2');
        $this->addSql('DROP TABLE articles_themes');
        $this->addSql('ALTER TABLE articles CHANGE images images JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles_themes (articles_id INT NOT NULL, themes_id INT NOT NULL, INDEX IDX_AF7AE6F31EBAF6CC (articles_id), INDEX IDX_AF7AE6F394F4A9D2 (themes_id), PRIMARY KEY(articles_id, themes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE articles_themes ADD CONSTRAINT FK_AF7AE6F31EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_themes ADD CONSTRAINT FK_AF7AE6F394F4A9D2 FOREIGN KEY (themes_id) REFERENCES themes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles CHANGE images images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }
}
