<?php

declare(strict_types=1);

namespace Backend\Api\User\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191011092259 extends AbstractMigration
{
    /**
     * Migration description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return 'Create table `users`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE users
            (
                uuid uuid
                    constraint users_pk
                        primary key,
                id serial,
                nickname varchar,
                password varchar,
                firstname varchar,
                lastname varchar,
                age smallint default 0,
                created_at timestamp default now(),
                updated_at timestamp default null
            );
        ');

        $this->addSql('CREATE UNIQUE index users_id_uindex on users (id);');
        $this->addSql('CREATE UNIQUE index users_nickname_uindex on users (nickname);');
        //$this->addSql('CREATE INDEX users_age_INDEX on users (age);');

        $this->addSql('
            CREATE OR REPLACE FUNCTION update_update_at_column()
                RETURNS TRIGGER AS $$
            BEGIN
                IF row(NEW.*) IS DISTINCT FROM row(OLD.*) THEN
                    NEW.updated_at = now();
                    RETURN NEW;
                ELSE
                    RETURN OLD;
                END IF;
            END;
            $$ language \'plpgsql\';
		');

        $this->addSql('
            CREATE TRIGGER update_users_modtime BEFORE UPDATE ON users FOR EACH ROW EXECUTE PROCEDURE update_update_at_column();
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP FUNCTION update_update_at_column;');
        $this->addSql('DROP TRIGGER update_users_modtime;');
        $this->addSql('DROP TABLE users;');
    }
}
