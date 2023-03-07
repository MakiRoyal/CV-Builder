<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306210529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cv (id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, postal VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, linkedin VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cv_diploma (cv_id INT NOT NULL, diploma_id INT NOT NULL, PRIMARY KEY(cv_id, diploma_id))');
        $this->addSql('CREATE INDEX IDX_A7A8DA19CFE419E2 ON cv_diploma (cv_id)');
        $this->addSql('CREATE INDEX IDX_A7A8DA19A99ACEB5 ON cv_diploma (diploma_id)');
        $this->addSql('CREATE TABLE cv_skill (cv_id INT NOT NULL, skill_id INT NOT NULL, PRIMARY KEY(cv_id, skill_id))');
        $this->addSql('CREATE INDEX IDX_D1393468CFE419E2 ON cv_skill (cv_id)');
        $this->addSql('CREATE INDEX IDX_D13934685585C142 ON cv_skill (skill_id)');
        $this->addSql('CREATE TABLE cv_language (cv_id INT NOT NULL, language_id INT NOT NULL, PRIMARY KEY(cv_id, language_id))');
        $this->addSql('CREATE INDEX IDX_45F49471CFE419E2 ON cv_language (cv_id)');
        $this->addSql('CREATE INDEX IDX_45F4947182F1BAF4 ON cv_language (language_id)');
        $this->addSql('CREATE TABLE cv_hobby (cv_id INT NOT NULL, hobby_id INT NOT NULL, PRIMARY KEY(cv_id, hobby_id))');
        $this->addSql('CREATE INDEX IDX_B6602328CFE419E2 ON cv_hobby (cv_id)');
        $this->addSql('CREATE INDEX IDX_B6602328322B2123 ON cv_hobby (hobby_id)');
        $this->addSql('CREATE TABLE diploma (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hobby (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE language (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE professional_experience (id INT NOT NULL, cv_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, date_begin DATE NOT NULL, date_end DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_32FDB9BACFE419E2 ON professional_experience (cv_id)');
        $this->addSql('CREATE TABLE skill (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, cv_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649CFE419E2 ON "user" (cv_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE cv_diploma ADD CONSTRAINT FK_A7A8DA19CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_diploma ADD CONSTRAINT FK_A7A8DA19A99ACEB5 FOREIGN KEY (diploma_id) REFERENCES diploma (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_skill ADD CONSTRAINT FK_D1393468CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_skill ADD CONSTRAINT FK_D13934685585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_language ADD CONSTRAINT FK_45F49471CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_language ADD CONSTRAINT FK_45F4947182F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_hobby ADD CONSTRAINT FK_B6602328CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cv_hobby ADD CONSTRAINT FK_B6602328322B2123 FOREIGN KEY (hobby_id) REFERENCES hobby (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE professional_experience ADD CONSTRAINT FK_32FDB9BACFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cv_diploma DROP CONSTRAINT FK_A7A8DA19CFE419E2');
        $this->addSql('ALTER TABLE cv_diploma DROP CONSTRAINT FK_A7A8DA19A99ACEB5');
        $this->addSql('ALTER TABLE cv_skill DROP CONSTRAINT FK_D1393468CFE419E2');
        $this->addSql('ALTER TABLE cv_skill DROP CONSTRAINT FK_D13934685585C142');
        $this->addSql('ALTER TABLE cv_language DROP CONSTRAINT FK_45F49471CFE419E2');
        $this->addSql('ALTER TABLE cv_language DROP CONSTRAINT FK_45F4947182F1BAF4');
        $this->addSql('ALTER TABLE cv_hobby DROP CONSTRAINT FK_B6602328CFE419E2');
        $this->addSql('ALTER TABLE cv_hobby DROP CONSTRAINT FK_B6602328322B2123');
        $this->addSql('ALTER TABLE professional_experience DROP CONSTRAINT FK_32FDB9BACFE419E2');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649CFE419E2');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE cv_diploma');
        $this->addSql('DROP TABLE cv_skill');
        $this->addSql('DROP TABLE cv_language');
        $this->addSql('DROP TABLE cv_hobby');
        $this->addSql('DROP TABLE diploma');
        $this->addSql('DROP TABLE hobby');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE professional_experience');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
