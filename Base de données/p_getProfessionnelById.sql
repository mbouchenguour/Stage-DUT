DELIMITER |
CREATE PROCEDURE getProfessionnelById(IN id INT)
BEGIN
    SELECT * 
    FROM Professionnel
    where Professionnel.id = id;  
END|
DELIMITER ;

Call getProfessionnelById(1);