CREATE TABLE`patient`(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COLLATE utf8mb4_unicode_ci ,
    `address` VARCHAR(100) COLLATE utf8mb4_unicode_ci ,
    `birth_date` DATETIME ,
    `phone` VARCHAR(30) COLLATE utf8mb4_unicode_ci ,
    `email` VARCHAR(100)COLLATE utf8mb4_unicode_ci ,
    `ns` VARCHAR(30)COLLATE utf8mb4_unicode_ci ,
    `CURP` VARCHAR(20)COLLATE utf8mb4_unicode_ci ,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `gender` BOOLEAN,
    `occupation` VARCHAR(100)COLLATE utf8mb4_unicode_ci ,
    `marita_status` VARCHAR(30)COLLATE utf8mb4_unicode_ci ,
    `weight` FLOAT,
    `height` FLOAT,
    `phone_sec` VARCHAR(100)COLLATE utf8mb4_unicode_ci ,
    `status` VARCHAR(20)COLLATE utf8mb4_unicode_ci ,
    `id_user` bigint(20) unsigned NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT `fk_id_patient_user`
    	FOREIGN KEY (id_user) REFERENCES users (id)
    	ON DELETE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE`medic_employees`(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COLLATE utf8mb4_unicode_ci ,
    `address` VARCHAR(100) COLLATE utf8mb4_unicode_ci ,
    `birth_date` DATETIME ,
    `phone` VARCHAR(30) COLLATE utf8mb4_unicode_ci ,
    `email` VARCHAR(100)COLLATE utf8mb4_unicode_ci ,
    `ns` VARCHAR(30)COLLATE utf8mb4_unicode_ci ,
    `CURP` VARCHAR(20)COLLATE utf8mb4_unicode_ci ,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `gender` BOOLEAN,
    `occupation` VARCHAR(100)COLLATE utf8mb4_unicode_ci ,
    `marita_status` VARCHAR(30)COLLATE utf8mb4_unicode_ci ,
    `weight` FLOAT,
    `height` FLOAT,
    `phone_sec` VARCHAR(100)COLLATE utf8mb4_unicode_ci ,
    `status` VARCHAR(20)COLLATE utf8mb4_unicode_ci ,
    `cetificate_number` VARCHAR(30) COLLATE utf8mb4_unicode_ci ,
    `salary` FLOAT,
    `id_user`bigint(20) unsigned NOT NULL,
     PRIMARY KEY (id),
    CONSTRAINT `fk_id_doctor_user`
    	FOREIGN KEY (id_user) REFERENCES users (id)
    	ON DELETE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE`diagnose`(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `id_patient`bigint(20) unsigned NOT NULL,
    `id_doctor`bigint(20) unsigned NOT NULL,
    `disease` varchar(100) COLLATE utf8mb4_unicode_ci ,
    `description`varchar(100)COLLATE utf8mb4_unicode_ci,
    `weight` float,
    `notes` varchar(1000)COLLATE utf8mb4_unicode_ci,
    `drugs`varchar(1000)COLLATE utf8mb4_unicode_ci,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
     PRIMARY KEY (id),
    CONSTRAINT `fk_id_doctor_diagnose`
    	FOREIGN KEY (id_doctor) REFERENCES medic_employees (id)
    	ON DELETE RESTRICT,
     CONSTRAINT `fk_id_patient_diagnose`
    	FOREIGN KEY (id_patient) REFERENCES patient (id)
    	ON DELETE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `files`(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `id_diagnose`bigint(20) unsigned NOT NULL,
    `ulr_file`varchar(200) COLLATE utf8mb4_unicode_ci,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT `fk_id_files_diagnose`
    	FOREIGN KEY (id_diagnose) REFERENCES diagnose (id)
    	ON DELETE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `area`(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`varchar(100) COLLATE utf8mb4_unicode_ci,
    `place`varchar(100) COLLATE utf8mb4_unicode_ci,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `inventary`(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`varchar(200) COLLATE utf8mb4_unicode_ci,
    `quantity` int,
    `id_area` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT `fk_id_inventary_area`
    	FOREIGN KEY (id_area) REFERENCES area (id)
    	ON DELETE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `schedule`(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`varchar(100) COLLATE utf8mb4_unicode_ci,
    `all_schedule`varchar(500) COLLATE utf8mb4_unicode_ci,
    `id_area` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT `fk_id_schedyle_area`
    	FOREIGN KEY (id_area) REFERENCES area (id)
    	ON DELETE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `schedule_medic`(
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `id_employee` bigint(20) unsigned NOT NULL,
    `id_schedule` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT `fk_id_employee_schedule`
    	FOREIGN KEY (id_employee) REFERENCES medic_employees(id)
    	ON DELETE RESTRICT,
    CONSTRAINT `fk_id__schedule`
    	FOREIGN KEY (id_schedule) REFERENCES schedule(id)
    	ON DELETE RESTRICT
)ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

