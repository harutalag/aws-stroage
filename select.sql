SELECT
  CASE
    WHEN g.grade >= 8 THEN s.name
    ELSE 'low'
  END AS name,
  g.grade,
  s.mark
FROM students s
JOIN grade g
  ON s.mark BETWEEN g.min_mark AND g.max_mark
ORDER BY
  g.grade DESC,
  CASE
    WHEN g.grade >= 8 THEN s.name
    ELSE NULL
  END ASC,
  CASE
    WHEN g.grade < 8 THEN s.mark
    ELSE NULL
  END ASC;
