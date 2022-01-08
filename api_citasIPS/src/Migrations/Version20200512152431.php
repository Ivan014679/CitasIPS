<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512152431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE cita_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE estado_seguimiento_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE estudiante_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE modalidad_afiliacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE paciente_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE parentezco_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE periodo_academico_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE persona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE personal_salud_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE programa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE semestre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE servicio_aplicado_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE servicio_complementario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_identificacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_personal_salud_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE citas (id BIGSERIAL NOT NULL, id_paciente BIGINT NOT NULL, id_parentezco BIGINT NOT NULL, id_estado_seguimiento BIGINT NOT NULL, id_servicio_aplicado BIGINT NOT NULL, id_personal_salud BIGINT NOT NULL, id_servicio_complementario BIGINT NOT NULL, id_periodo_academico BIGINT NOT NULL, acudiente VARCHAR(200) NOT NULL, fecha_cita DATE NOT NULL, hora_cita TIME(0) WITHOUT TIME ZONE NOT NULL, observaciones TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3E379A626B021723 ON citas (id_paciente)');
        $this->addSql('CREATE INDEX IDX_3E379A62C2849151 ON citas (id_parentezco)');
        $this->addSql('CREATE INDEX IDX_3E379A62EECA02EF ON citas (id_estado_seguimiento)');
        $this->addSql('CREATE INDEX IDX_3E379A62360B5E6C ON citas (id_servicio_aplicado)');
        $this->addSql('CREATE INDEX IDX_3E379A62547464FD ON citas (id_personal_salud)');
        $this->addSql('CREATE INDEX IDX_3E379A629F860DE7 ON citas (id_servicio_complementario)');
        $this->addSql('CREATE INDEX IDX_3E379A62F0795D13 ON citas (id_periodo_academico)');
        $this->addSql('CREATE TABLE estados_seguimientos (id BIGSERIAL NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE estudiantes (id BIGSERIAL NOT NULL, id_programa BIGINT NOT NULL, id_semestre BIGINT NOT NULL, id_persona BIGINT NOT NULL, codigo VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B3F3FADE598BEDF ON estudiantes (id_programa)');
        $this->addSql('CREATE INDEX IDX_3B3F3FAD4D65622C ON estudiantes (id_semestre)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B3F3FAD50720D6E ON estudiantes (id_persona)');
        $this->addSql('CREATE TABLE modalidades_afiliacion (id BIGSERIAL NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pacientes (id BIGSERIAL NOT NULL, id_estudiante BIGINT NOT NULL, id_modalidad_afiliacion BIGINT NOT NULL, eps VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C6CBA95EE771DD5C ON pacientes (id_estudiante)');
        $this->addSql('CREATE INDEX IDX_C6CBA95E4BE9EC44 ON pacientes (id_modalidad_afiliacion)');
        $this->addSql('CREATE TABLE parentezcos (id BIGSERIAL NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE periodos_academicos (id BIGSERIAL NOT NULL, anio INT NOT NULL, periodo SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE personas (id BIGSERIAL NOT NULL, id_tipo_identificacion BIGINT NOT NULL, identificacion INT NOT NULL, primer_nombre VARCHAR(50) NOT NULL, segundo_nombre VARCHAR(50), primer_apellido VARCHAR(50) NOT NULL, segundo_apellido VARCHAR(50), genero VARCHAR(2) NOT NULL, fecha_nacimiento DATE NOT NULL, telefono VARCHAR(10) NOT NULL, celular VARCHAR(10) NOT NULL, correo_electronico VARCHAR(50) NOT NULL, direccion VARCHAR(50) NOT NULL, barrio VARCHAR(50) NOT NULL, estrato SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_51E5B69B65963A51 ON personas (id_tipo_identificacion)');
        $this->addSql('CREATE TABLE personal_salud (id BIGSERIAL NOT NULL, id_persona BIGINT NOT NULL, id_tipo_personal_salud BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FAC9A1C450720D6E ON personal_salud (id_persona)');
        $this->addSql('CREATE INDEX IDX_FAC9A1C42F52AE7E ON personal_salud (id_tipo_personal_salud)');
        $this->addSql('CREATE TABLE personal_salud_periodos_academicos (id_personal_salud BIGINT NOT NULL, id_periodo_academico BIGINT NOT NULL, PRIMARY KEY(id_personal_salud, id_periodo_academico))');
        $this->addSql('CREATE INDEX IDX_4C254FE8A5430CEA ON personal_salud_periodos_academicos (id_personal_salud)');
        $this->addSql('CREATE INDEX IDX_4C254FE8FC89ACB7 ON personal_salud_periodos_academicos (id_periodo_academico)');
        $this->addSql('CREATE TABLE programas (id BIGSERIAL NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE semestres (id BIGSERIAL NOT NULL, numero SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE servicios_aplicados (id BIGSERIAL NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE servicios_complementarios (id BIGSERIAL NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tipos_identificacion (id BIGSERIAL NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tipos_personal_salud (id BIGSERIAL NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE citas ADD CONSTRAINT FK_3E379A626B021723 FOREIGN KEY (id_paciente) REFERENCES pacientes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE citas ADD CONSTRAINT FK_3E379A62C2849151 FOREIGN KEY (id_parentezco) REFERENCES parentezcos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE citas ADD CONSTRAINT FK_3E379A62EECA02EF FOREIGN KEY (id_estado_seguimiento) REFERENCES estados_seguimientos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE citas ADD CONSTRAINT FK_3E379A62360B5E6C FOREIGN KEY (id_servicio_aplicado) REFERENCES servicios_aplicados (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE citas ADD CONSTRAINT FK_3E379A62547464FD FOREIGN KEY (id_personal_salud) REFERENCES personal_salud (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE citas ADD CONSTRAINT FK_3E379A629F860DE7 FOREIGN KEY (id_servicio_complementario) REFERENCES servicios_complementarios (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE citas ADD CONSTRAINT FK_3E379A62F0795D13 FOREIGN KEY (id_periodo_academico) REFERENCES periodos_academicos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE estudiantes ADD CONSTRAINT FK_3B3F3FADE598BEDF FOREIGN KEY (id_programa) REFERENCES programas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE estudiantes ADD CONSTRAINT FK_3B3F3FAD4D65622C FOREIGN KEY (id_semestre) REFERENCES semestres (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE estudiantes ADD CONSTRAINT FK_3B3F3FAD50720D6E FOREIGN KEY (id_persona) REFERENCES personas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pacientes ADD CONSTRAINT FK_C6CBA95EE771DD5C FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pacientes ADD CONSTRAINT FK_C6CBA95E4BE9EC44 FOREIGN KEY (id_modalidad_afiliacion) REFERENCES modalidades_afiliacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE personas ADD CONSTRAINT FK_51E5B69B65963A51 FOREIGN KEY (id_tipo_identificacion) REFERENCES tipos_identificacion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE personal_salud ADD CONSTRAINT FK_FAC9A1C450720D6E FOREIGN KEY (id_persona) REFERENCES personas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE personal_salud ADD CONSTRAINT FK_FAC9A1C42F52AE7E FOREIGN KEY (id_tipo_personal_salud) REFERENCES tipos_personal_salud (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE personal_salud_periodos_academicos ADD CONSTRAINT FK_4C254FE8A5430CEA FOREIGN KEY (id_personal_salud) REFERENCES personal_salud (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE personal_salud_periodos_academicos ADD CONSTRAINT FK_4C254FE8FC89ACB7 FOREIGN KEY (id_periodo_academico) REFERENCES periodos_academicos (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE citas DROP CONSTRAINT FK_3E379A62EECA02EF');
        $this->addSql('ALTER TABLE pacientes DROP CONSTRAINT FK_C6CBA95EE771DD5C');
        $this->addSql('ALTER TABLE pacientes DROP CONSTRAINT FK_C6CBA95E4BE9EC44');
        $this->addSql('ALTER TABLE citas DROP CONSTRAINT FK_3E379A626B021723');
        $this->addSql('ALTER TABLE citas DROP CONSTRAINT FK_3E379A62C2849151');
        $this->addSql('ALTER TABLE citas DROP CONSTRAINT FK_3E379A62F0795D13');
        $this->addSql('ALTER TABLE personal_salud_periodos_academicos DROP CONSTRAINT FK_4C254FE8FC89ACB7');
        $this->addSql('ALTER TABLE estudiantes DROP CONSTRAINT FK_3B3F3FAD50720D6E');
        $this->addSql('ALTER TABLE personal_salud DROP CONSTRAINT FK_FAC9A1C450720D6E');
        $this->addSql('ALTER TABLE citas DROP CONSTRAINT FK_3E379A62547464FD');
        $this->addSql('ALTER TABLE personal_salud_periodos_academicos DROP CONSTRAINT FK_4C254FE8A5430CEA');
        $this->addSql('ALTER TABLE estudiantes DROP CONSTRAINT FK_3B3F3FADE598BEDF');
        $this->addSql('ALTER TABLE estudiantes DROP CONSTRAINT FK_3B3F3FAD4D65622C');
        $this->addSql('ALTER TABLE citas DROP CONSTRAINT FK_3E379A62360B5E6C');
        $this->addSql('ALTER TABLE citas DROP CONSTRAINT FK_3E379A629F860DE7');
        $this->addSql('ALTER TABLE personas DROP CONSTRAINT FK_51E5B69B65963A51');
        $this->addSql('ALTER TABLE personal_salud DROP CONSTRAINT FK_FAC9A1C42F52AE7E');
        $this->addSql('DROP SEQUENCE cita_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE estado_seguimiento_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE estudiante_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE modalidad_afiliacion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE paciente_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE parentezco_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE periodo_academico_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE persona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE personal_salud_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE programa_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE semestre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE servicio_aplicado_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE servicio_complementario_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_identificacion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_personal_salud_id_seq CASCADE');
        $this->addSql('DROP TABLE citas');
        $this->addSql('DROP TABLE estados_seguimientos');
        $this->addSql('DROP TABLE estudiantes');
        $this->addSql('DROP TABLE modalidades_afiliacion');
        $this->addSql('DROP TABLE pacientes');
        $this->addSql('DROP TABLE parentezcos');
        $this->addSql('DROP TABLE periodos_academicos');
        $this->addSql('DROP TABLE personas');
        $this->addSql('DROP TABLE personal_salud');
        $this->addSql('DROP TABLE personal_salud_periodos_academicos');
        $this->addSql('DROP TABLE programas');
        $this->addSql('DROP TABLE semestres');
        $this->addSql('DROP TABLE servicios_aplicados');
        $this->addSql('DROP TABLE servicios_complementarios');
        $this->addSql('DROP TABLE tipos_identificacion');
        $this->addSql('DROP TABLE tipos_personal_salud');
    }
}
