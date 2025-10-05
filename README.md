# 🏫 School Management System (Laravel)

A comprehensive School Management System built using **Laravel**, designed to streamline academic and administrative processes for schools. It provides distinct dashboards for **Admins**, **Teachers**, **Students**, and **Parents**.

---

## 🚀 Features

### 🔐 Admin Panel

-   Manage user accounts (Teacher, Student, Parent)
-   Manage classes and subjects
-   Manage class routines
-   Manage exams and grades
-   Manage exam marks and send them via SMS
-   Manage student attendance
-   Accounting management (income & expenses)
-   School event management
-   Manage library, dormitory, and transport
-   Messaging between users
-   Configure system settings (general, SMS, language)

---

### 👨‍🏫 Teacher Panel

-   Manage students and their exam marks
-   Provide study materials/files to students
-   Manage student attendance

---

### 👨‍🎓 Student Panel

-   View class routine
-   View exam marks
-   Check attendance status
-   Download study materials from teachers
-   View payment invoices and pay online
-   Communicate with teachers

---

### 👨‍👩‍👧‍👦 Parent Panel

-   View children's exam marks
-   View children's payment invoices
-   View children's class routines
-   Message with teachers

---

## 🛠️ Tech Stack

-   **Backend**: Laravel (PHP Framework)
-   **Frontend**: Blade Templates / HTML / CSS / JS
-   **Database**: MySQL
-   **Others**: SMS Gateway Integration, Authentication, Role-based access control

---

## 📦 Installation

1. **Clone the repository**

    ```bash
    git clone https://github.com/niloy2107028/School-Management-System.git
    cd school-management-system
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install && npm run dev
    ```

3. **Create `.env` file**

    ```bash
    cp .env.example .env
    ```

4. **Configure environment**

    - Set your database, mail, and SMS gateway details in the `.env` file

5. **Generate application key**

    ```bash
    php artisan key:generate
    ```

6. **Run migrations**

    ```bash
    php artisan migrate --seed
    ```

7. **Serve the application**
    ```bash
    php artisan serve
    ```

---

## 👤 User Roles

| Role    | Email                                           | Password | Description              |
| ------- | ----------------------------------------------- | -------- | ------------------------ |
| Admin   | [admin@school.com](mailto:admin@school.com)     | password | Full control             |
| Teacher | [teacher@school.com](mailto:teacher@school.com) | password | Academic management      |
| Student | [student@school.com](mailto:student@school.com) | password | Access learning features |
| Parent  | [parent@school.com](mailto:parent@school.com)   | password | Monitor child's progress |

> You can change default users in the database or during seeding.

---

## 📧 Contact

For any queries, suggestions, or contributions, please reach out to:

**Your Name**
📧 [niloy2107028@stud.kuet.ac.bd](mailto:your.email@example.com)

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 🙌 Contributions

Feel free to fork the repository, raise issues, and submit pull requests to improve the system.
