Student Marks Management System 
A full-stack web application designed for academic record management, focusing on 
automated grading and relational data integrity. 
1. Project Overview 
This system serves as a central hub for teachers to manage student registration and 
academic performance. It utilizes a relational database to store student profiles and 
course scores separately, ensuring data consistency and easy scalability. 
2. Tech Stack 
• Frontend: HTML5, CSS3, JavaScript (Vanilla ES6). 
• Backend: PHP (PDO Extension). 
• Database: MySQL (Relational Schema). 
• Methodology: AJAX-based interactions for a Single Page Application (SPA) 
experience. 
3. Key Features 
The application implements 7 core functionalities: 
1. Administrative Login: Secure teacher access using credential verification. 
2. Student Registration: Enrollment of new students into the system. 
3. Marks Management: Ability to input and update scores for specific courses 
(Math, Science, English). 
4. Automated Calculations: Real-time server-side logic to calculate: 
o Total Score. 
o Percentage. 
o Letter Grade (A+, A, B, F). 
5. Dynamic Search: Instantly locate specific student results via their Roll 
Number. 
6. Seamless Updates (Upsert): Integrated logic to update existing records if a 
duplicate roll number is entered. 
7. Data Persistence: Full CRUD capabilities allowing for the display and 
deletion of academic records. 
4. Project Structure 
1. database.sql: The database schema containing tables for Users, Students, 
Courses, and Marks. 
2. index.html: The main user interface. 
3. style.css: Custom UI styling and layout configuration. 
4. script.js: Client-side logic and API fetching. 
5. process.php: Backend logic and database processing engine. 
5. Project Structure 
1. Clone the Repository: Download the project files into your local server root 
(e.g., htdocs for XAMPP). 
2. Database Configuration: 
o Create a database named student_db. 
o Import the database.sql file. 
3. Run: Open your browser and navigate to localhost/your-project-folder. 
4. Default Credentials: 
o Username: admin 
o Password: admin123
