<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608174100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, owner_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', footer LONGTEXT DEFAULT NULL, proposed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', accepted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(20) NOT NULL, INDEX IDX_BFDD3168F675F31B (author_id), INDEX IDX_BFDD31687E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles_themes (articles_id INT NOT NULL, themes_id INT NOT NULL, INDEX IDX_AF7AE6F31EBAF6CC (articles_id), INDEX IDX_AF7AE6F394F4A9D2 (themes_id), PRIMARY KEY(articles_id, themes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31687E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE articles_themes ADD CONSTRAINT FK_AF7AE6F31EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_themes ADD CONSTRAINT FK_AF7AE6F394F4A9D2 FOREIGN KEY (themes_id) REFERENCES themes (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX name ON themes');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168F675F31B');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31687E3C61F9');
        $this->addSql('ALTER TABLE articles_themes DROP FOREIGN KEY FK_AF7AE6F31EBAF6CC');
        $this->addSql('ALTER TABLE articles_themes DROP FOREIGN KEY FK_AF7AE6F394F4A9D2');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE articles_themes');
        $this->addSql('CREATE UNIQUE INDEX name ON themes (name)');
    }
}
