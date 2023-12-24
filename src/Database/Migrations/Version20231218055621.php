<?php

declare(strict_types=1);

namespace App\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218055621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message_user DROP CONSTRAINT fk_24064d90537a1329');
        $this->addSql('ALTER TABLE message_user DROP CONSTRAINT fk_24064d90a76ed395');
        $this->addSql('ALTER TABLE participant_conversation DROP CONSTRAINT fk_17a662bb9d1c3019');
        $this->addSql('ALTER TABLE participant_conversation DROP CONSTRAINT fk_17a662bb9ac0396');
        $this->addSql('ALTER TABLE participant_user DROP CONSTRAINT fk_5927c4779d1c3019');
        $this->addSql('ALTER TABLE participant_user DROP CONSTRAINT fk_5927c477a76ed395');
        $this->addSql('ALTER TABLE message_conversation DROP CONSTRAINT fk_4e8f130f537a1329');
        $this->addSql('ALTER TABLE message_conversation DROP CONSTRAINT fk_4e8f130f9ac0396');
        $this->addSql('DROP TABLE message_user');
        $this->addSql('DROP TABLE participant_conversation');
        $this->addSql('DROP TABLE participant_user');
        $this->addSql('DROP TABLE message_conversation');
        $this->addSql('ALTER TABLE message ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD conversation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B6BD307FA76ED395 ON message (user_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F9AC0396 ON message (conversation_id)');
        $this->addSql('ALTER TABLE participant ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participant ADD conversation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B119AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D79F6B11A76ED395 ON participant (user_id)');
        $this->addSql('CREATE INDEX IDX_D79F6B119AC0396 ON participant (conversation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE message_user (message_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(message_id, user_id))');
        $this->addSql('CREATE INDEX idx_24064d90a76ed395 ON message_user (user_id)');
        $this->addSql('CREATE INDEX idx_24064d90537a1329 ON message_user (message_id)');
        $this->addSql('CREATE TABLE participant_conversation (participant_id INT NOT NULL, conversation_id INT NOT NULL, PRIMARY KEY(participant_id, conversation_id))');
        $this->addSql('CREATE INDEX idx_17a662bb9ac0396 ON participant_conversation (conversation_id)');
        $this->addSql('CREATE INDEX idx_17a662bb9d1c3019 ON participant_conversation (participant_id)');
        $this->addSql('CREATE TABLE participant_user (participant_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(participant_id, user_id))');
        $this->addSql('CREATE INDEX idx_5927c477a76ed395 ON participant_user (user_id)');
        $this->addSql('CREATE INDEX idx_5927c4779d1c3019 ON participant_user (participant_id)');
        $this->addSql('CREATE TABLE message_conversation (message_id INT NOT NULL, conversation_id INT NOT NULL, PRIMARY KEY(message_id, conversation_id))');
        $this->addSql('CREATE INDEX idx_4e8f130f9ac0396 ON message_conversation (conversation_id)');
        $this->addSql('CREATE INDEX idx_4e8f130f537a1329 ON message_conversation (message_id)');
        $this->addSql('ALTER TABLE message_user ADD CONSTRAINT fk_24064d90537a1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_user ADD CONSTRAINT fk_24064d90a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_conversation ADD CONSTRAINT fk_17a662bb9d1c3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_conversation ADD CONSTRAINT fk_17a662bb9ac0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_user ADD CONSTRAINT fk_5927c4779d1c3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_user ADD CONSTRAINT fk_5927c477a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_conversation ADD CONSTRAINT fk_4e8f130f537a1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message_conversation ADD CONSTRAINT fk_4e8f130f9ac0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F9AC0396');
        $this->addSql('DROP INDEX IDX_B6BD307FA76ED395');
        $this->addSql('DROP INDEX IDX_B6BD307F9AC0396');
        $this->addSql('ALTER TABLE message DROP user_id');
        $this->addSql('ALTER TABLE message DROP conversation_id');
        $this->addSql('ALTER TABLE participant DROP CONSTRAINT FK_D79F6B11A76ED395');
        $this->addSql('ALTER TABLE participant DROP CONSTRAINT FK_D79F6B119AC0396');
        $this->addSql('DROP INDEX IDX_D79F6B11A76ED395');
        $this->addSql('DROP INDEX IDX_D79F6B119AC0396');
        $this->addSql('ALTER TABLE participant DROP user_id');
        $this->addSql('ALTER TABLE participant DROP conversation_id');
    }
}
