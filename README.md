# Laravel Clean Architecture Project Template

## Overview

This is a Laravel project template that follows the principles of Clean Architecture, designed to help you build robust and maintainable applications. Clean Architecture promotes a clear separation of concerns, making your codebase more organized, testable, and adaptable. This README will guide you through the project structure, tools, and commands used in this template.

## Project Structure
The project is structured into four main directories, each representing a specific layer of the Clean Architecture:

1. **app/Application**: This layer contains application-specific code and use cases. It defines the application's high-level business rules and logic.

2. **app/Domain**: The domain layer represents the core business logic of your application. It contains entities, value objects, and the repository interfaces that define how data is stored and retrieved.

3. **app/Infrastructure**: The infrastructure layer handles the implementation details, including database connections, third-party integrations, and other external dependencies. This layer should be kept as thin as possible.

4. **app/Presenter**: The presenter layer is responsible for presenting data to the user, which can include views, controllers, and UI-specific logic.

## Prerequisites
Before using this project template, ensure you have the following prerequisites installed:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [PHP >= 8.1](https://www.php.net/downloads.php)


## Makefile Commands
This project template provides several Makefile commands to simplify common tasks:

- `make up`: Launch the application using Laravel Sail.
- `make down`: Stop the application and associated services.
- `make ssh`: Access the Laravel container via SSH.
- `make optimize`: Optimize the application for production.
- `make refresh`: Refresh the application's database with fresh migrations and seed data.
- `make test`: Run PHPUnit tests within the Laravel container.
- `make phpcs`: Run PHP CodeSniffer for code linting and coding standard checks.
- `make phpcbf`: Run PHP Code Beautifier and Fixer for automated code fixes.

Make sure you replace `make` with `./vendor/bin/sail` if you prefer running these commands directly through Laravel Sail.

## Getting Started
To get started with this project template, follow these steps:

1. Clone the project to your local machine.
2. Navigate to the project directory.
3. Run `make up` to start the application.
4. Access the application via your web browser at [http://localhost](http://localhost).
5. You can start building your application within the Clean Architecture structure.

## Additional Information
- You can customize the PHP CodeSniffer rules by editing the `phpcs.xml` file.
- Adjust the project structure and add your own code within the Clean Architecture layers as needed.
- Refer to Laravel and Clean Architecture documentation for more details on Laravel and Clean Architecture principles.


## Cleanup
Remember to run `make down` when you're done working on the project to stop the application and associated services.
 
This repository follows the conventional commits guid lines
https://www.conventionalcommits.org/en/v1.0.0/

## License
This project template is open-source and available under the [MIT License](LICENSE). Feel free to use it for your own projects and make any modifications as necessary.

