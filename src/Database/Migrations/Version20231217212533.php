<?php

declare(strict_types=1);

namespace App\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217212533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE conversation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE participant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE conversation (id INT NOT NULL, last_message_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8A8E26E9BA0E79C3 ON conversation (last_message_id)');
        $this->addSql('CREATE INDEX last_message_id_index ON conversation (last_message_id)');
        $this->addSql('CREATE TABLE message (id INT NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX created_at_index ON message (created_at)');
        $this->addSql('CREATE TABLE message_user (message_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(message_id, user_id))');
        $this->addSql('CREATE INDEX IDX_24064D90537A1329 ON message_user (message_id)');
        $this->addSql('CREATE INDEX IDX_24064D90A76ED395 ON message_user (user_id)');
        $this->addSql('CREATE TABLE message_conversation (message_id INT NOT NULL, conversation_id INT NOT NULL, PRIMARY KEY(message_id, conversation_id))');
        $this->addSql('CREATE INDEX IDX_4E8F130F537A1329 ON message_conversation (message_id)');
        $this->addSql('CREATE INDEX IDX_4E8F130F9AC0396 ON message_conversation (conversation_id)');
        $this->addSql('CREATE TABLE participant (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE participant_user (participant_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(participant_id, user_id))');
        $this->addSql('CREATE INDEX IDX_5927C4779D1C3019 ON participant_user (participant_id)');
        $this->addSql('CREATE INDEX IDX_5927C477A76ED395 ON participant_user (user_id)');
        $this->addSql('CREATE TABLE participant_conversation (participant_id INT NOT NULL, conversation_id INT NOT NULL, PRIMARY KEY(participant_id, conversation_id))');
        $this->addSql('CREATE INDEX IDX_17A662BB9D1C3019 ON participant_conversation (participant_id)');
        $this->addSql('CREATE INDEX IDX_17A662BB9AC0396 ON participant_conversation (conversation_id)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9BA0E79C3 FOREIGN KEY (last_message_id) REFERENCES message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_user ADD CONSTRAINT FK_24064D90537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_user ADD CONSTRAINT FK_24064D90A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_conversation ADD CONSTRAINT FK_4E8F130F537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_conversation ADD CONSTRAINT FK_4E8F130F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_user ADD CONSTRAINT FK_5927C4779D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_user ADD CONSTRAINT FK_5927C477A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_conversation ADD CONSTRAINT FK_17A662BB9D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_conversation ADD CONSTRAINT FK_17A662BB9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE conversation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE participant_id_seq CASCADE');
        $this->addSql('ALTER TABLE conversation DROP CONSTRAINT FK_8A8E26E9BA0E79C3');
        $this->addSql('ALTER TABLE message_user DROP CONSTRAINT FK_24064D90537A1329');
        $this->addSql('ALTER TABLE message_user DROP CONSTRAINT FK_24064D90A76ED395');
        $this->addSql('ALTER TABLE message_conversation DROP CONSTRAINT FK_4E8F130F537A1329');
        $this->addSql('ALTER TABLE message_conversation DROP CONSTRAINT FK_4E8F130F9AC0396');
        $this->addSql('ALTER TABLE participant_user DROP CONSTRAINT FK_5927C4779D1C3019');
        $this->addSql('ALTER TABLE participant_user DROP CONSTRAINT FK_5927C477A76ED395');
        $this->addSql('ALTER TABLE participant_conversation DROP CONSTRAINT FK_17A662BB9D1C3019');
        $this->addSql('ALTER TABLE participant_conversation DROP CONSTRAINT FK_17A662BB9AC0396');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_user');
        $this->addSql('DROP TABLE message_conversation');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE participant_user');
        $this->addSql('DROP TABLE participant_conversation');
    }
}
