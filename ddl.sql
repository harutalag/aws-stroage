CREATE TABLE grade (
    grade_id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    grade TINYINT UNSIGNED NOT NULL,          -- сам номер оценки (1-10)
    min_mark TINYINT UNSIGNED NOT NULL,
    max_mark TINYINT UNSIGNED NOT NULL,
    UNIQUE KEY (grade),
    CHECK (min_mark <= max_mark)
);


CREATE TABLE students (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    marks TINYINT UNSIGNED NOT NULL,
    grade_id TINYINT UNSIGNED NOT NULL,
    INDEX idx_grade_id (grade_id),
    CONSTRAINT fk_grade FOREIGN KEY (grade_id) REFERENCES grade (grade_id)
);
