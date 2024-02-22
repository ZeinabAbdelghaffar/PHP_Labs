# PHP Labs

![PHP Full Form](https://www.cheggindia.com/wp-content/uploads/2023/09/php-full-form.png)

## Lab1 - PHP Contact Form Project

This project implements a simple contact form using PHP for server-side processing. The project includes the following files:

- `index.html`: The HTML file containing the contact form markup.
- `styles.css`: The CSS file containing styles for the contact form and output messages.
- `process_form.php`: The PHP file that processes the form data and displays output messages.
- `config.php`: The PHP file containing configuration settings for the contact form.

### Features

- Validates user input for name, email, and message.
- Displays error messages if any of the validations fail.
- Outputs a thank you message and the submitted data if all validations pass.

## Lab 2: PHP Contact Form with Logs Information

This project implements a simple PHP contact form that collects user input (name, email, message) and logs the submissions to a text file (`log.txt`). The project consists of the following files:

- `config.php`: Configuration file containing settings for the contact form.
- `index.html`: HTML file containing the contact form.
- `log.txt`: Text file where the contact form submissions are logged.
- `process_form.php`: PHP file that processes the form submissions and logs the data.
- `style.css`: CSS file for styling the contact form.

### Features

- **Form Validation**: Input fields are validated to ensure that the name, email, and message are provided and meet certain criteria (e.g., valid email format).
- **Logging**: Form submissions are logged to a `log.txt` file, including the submission date, IP address, name, email, and visit count.
- **Customization**: The contact form's behavior and appearance can be customized by editing the `config.php` and `style.css` files.
- **Error Handling**: Error messages are displayed if the form submission fails validation, providing feedback to the user.
