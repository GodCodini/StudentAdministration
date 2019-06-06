# StudentAdministration

**Short description:**  
This is an administration interface for students grades as a school project.

**Languages:**  
Based on PHP (OOP)

**Dependencies:**  
Browser & connection to a database (own or dummy database)

**Requirements of the assignment:**  
- Students can be added (all students are in at least one class)
- Classes can be added
- Subjects can be added
- Grades can be added (different amount of grades are possible)
- Grades are present as percentage and school grade
- Grades can have different types (ex. exam, homework, presentation, projects, collaboration ...)
- Weighting of different grade types (ex. written and oral grades are weighted 50/50)
- Calculation of final grade (ex. based on: written & oral, quarter-year, hald-year, full-year ...)
- Calculation of grades based on two specific algorithms (German Highschool "Abitur" and Internship "IHK") 
- Algorithm can be choosen depending on which class the specific student is in
- Students, Classes and Grades are linked together in the database via foreign keys
- Access control via password protection
- Overview of student information (firstname, lastname, grades sortable acending and descending)
- Student overview as full-, half- & quarter-year possible to choose from
- Forgotten homework can be assigned to a student with a specific date
- Random generator of student name within a choosen subject

**ERM-Model:**  
![alt text](https://github.com/TheAmazingCodini/StudentAdministration/blob/master/ERM_Schuelerverwaltung.png)

**Database creation SQL script**
[a link](https://github.com/TheAmazingCodini/StudentAdministration/blob/master/database_structure.sql)
