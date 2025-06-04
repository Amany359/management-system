# Management System

## Project Description

This is a **multi-user task management system** built with Laravel and Blade templates. It helps manage users, teams, projects, tasks, and subprojects with role-based access control.

## Technologies Used

- PHP 8.x  
- Laravel Framework  
- MySQL  
- Blade Templating  
- Bootstrap  

## User Roles

- Programmer  
- Tester  
- Team Leader  
- Testing Manager  
- General Manager  

## Workflow Overview

- Programmers update task status from `Pending` to `In Progress`.  
- Team Leader can mark tasks as `Completed`.  
- Testing Manager assigns tasks to testers after completion.  
- Testers test the tasks and either return them for fixes or approve them.  
- Role-based access limits users to their allowed sections only.

## Reports & Statistics

- Weekly reports for Team Leaders and General Manager.  
- Visual stats for tasks, users, and testing results.

## Installation & Setup

```bash
git clone https://github.com/Amany359/management-system.git
cd management-system
composer install
cp .env.example .env
php artisan key:generate
# Configure your database in .env file
php artisan migrate --seed
php artisan serve
