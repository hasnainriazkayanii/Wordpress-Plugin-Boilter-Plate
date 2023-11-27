# Table of Contents

1. [Introduction](#introduction)
2. [Directory Structure](#directory-structure)
3. [Dependencies](#dependencies)

## Introduction

Welcome to the DevOps documentation for the Smart WP Plugin WordPress Plugin Boilerplate. This comprehensive guide is designed to empower developers with the necessary insights into the project's architecture, dependencies, and deployment procedures.

Our WordPress Plugin Boilerplate serves as a robust foundation, offering a preconfigured structure for crafting custom plugins efficiently. This documentation aims to streamline your development and deployment processes by providing clear, concise information on how to leverage the boilerplate effectively.

Let's dive in and explore the key aspects of the Smart WP Plugin WordPress Plugin Boilerplate.

## Directory Structure

The project follows a modular directory structure for better organization. Here is an overview:

### Smart WP Plugin Directory Structure

#### 1. `app/`

- **Purpose:** Contains the core application logic.

- **Subdirectories:**
  - `Constants/`: Store constant values used across the application.
  - `Controllers/`: Organize controllers based on functionality, e.g., `Admin/`, `Api/`, `Front/`.
  - `Core/`: Houses core functionalities of the application.
  - `DB/`: Manages database-related tasks such as seeding and table definitions.
  - `Exceptions/`: Store custom exception classes.
  - `Helpers/`: Houses helper functions.
  - `Hooks/`: Organize hooks based on the context, e.g., `Admin/`, `Api/`.
  - `Models/`: Define application models.
  - `Repositories/`: Implement the repository pattern for database interactions.
  - `Requests/`: Handle HTTP requests, organized by context, e.g., `Admin/`, `Emails/`.
  - `Traits/`: Store reusable traits.

#### 2. `assets/`

- **Purpose:** Contains static assets like CSS, images, and JavaScript.

- **Subdirectories:**
  - `css/`: Store stylesheets.
    - Organize further based on the context, e.g., `admin/`.
  - `images/`: Keep image files.
  - `js/`: House JavaScript files.
    - Organize further based on the context, e.g., `admin/`, `short-codes/dashboard/`.
  - `scss/`: Store SCSS files for styles.
    - Organize based on the context, e.g., `abstracts/`, `admin/`, `front/short-codes/`.

#### 3. `templates/`

- **Purpose:** Holds WordPress custom page template files.

#### 4. `vendor/`

- **Purpose:** Managed by Composer, contains project dependencies.

- **Subdirectories:**
  - Organized by the vendor name, e.g., `divineomega/`, `rakit/`, `symfony/`.

#### 5. `views/`

- **Purpose:** Contains Blade templates for views.

- **Subdirectories:**
  - Organized by the context, e.g., `admin/settings/`, `global/email_templates/auth/`.

## Dependencies

The project uses Composer for dependency management. The `composer.json` file contains the necessary information about the project dependencies. To install the dependencies, run:

```bash
composer install
```

### Composer Dependencies

Following is the list of Dependencies/Packages provided:

| Dependency                    | Version | Description                                                                                                  |
| ------------------------------ | ------- | ------------------------------------------------------------------------------------------------------------ |
| [divineomega/dotenv-loader](https://github.com/DivineOmega/dotenv-loader) | [![Latest Version](https://img.shields.io/github/v/release/DivineOmega/dotenv-loader?label=Latest)](https://github.com/DivineOmega/dotenv-loader/releases/tag/v2.0.3)      | The dotenv-loader is a simple PHP helper that automatically loads in a .env file from the root of your project into environment variables. It is designed for use in projects that do not already make use of a .env file. |
| [rakit/validation](https://github.com/rakit/validation) | [![Version](https://img.shields.io/github/v/release/rakit/validation?label=Latest&color=blue&style=flat-square)](https://github.com/rakit/validation/releases/tag/v1.0.0) | Rakit Validation - PHP Standalone Validation Library. Inspired by Illuminate\Validation Laravel.  |
This modified markdown is GitHub-friendly and provides a more seamless experience for users reading the README on GitHub.
