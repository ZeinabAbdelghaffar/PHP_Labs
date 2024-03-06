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

#### Output
![form](https://github.com/ZeinabAbdelghaffar/PHP_Labs/assets/87963230/79dd2316-d6cb-4138-95c5-3b1c21b21966)
![form](https://github.com/ZeinabAbdelghaffar/PHP_Labs/assets/87963230/2e38267d-8ef4-48ec-ad94-cc3da0efd7fb)

## Lab 2: PHP Contact Form with Logs Information

This project implements a simple PHP contact form that collects user input (name, email, message) and logs the submissions to a text file (`log.txt`). The project consists of the following files:

- `index.html`: The HTML file containing the contact form markup.
- `styles.css`: The CSS file containing styles for the contact form and output messages.
- `process_form.php`: The PHP file that processes the form data and displays output messages.
- `config.php`: The PHP file containing configuration settings for the contact form.
- `read_output.php`: A PHP file that displays log information about visits to the contact form page.

### Features

- **Form Validation**: Input fields are validated to ensure that the name, email, and message are provided and meet certain criteria (e.g., valid email format).
- **Logging**: Form submissions are logged to a `log.txt` file, including the submission date, IP address, name, email, Browser and visit count.
- **Customization**: The contact form's behavior and appearance can be customized by editing the `config.php` and `style.css` files.
- **Error Handling**: Error messages are displayed if the form submission fails validation, providing feedback to the user.

#### Output
![image](https://github.com/ZeinabAbdelghaffar/PHP_Labs/assets/87963230/1a5fa37c-f75e-419d-99f7-df847e2c98a3)

## Lab 3: Unique Visits Counter Using OOP PHP

This project implements a unique visits counter for a web page using object-oriented programming (OOP) in PHP. The counter counts visits from different browsers as separate visits, while multiple visits from the same user/browser are counted as one visit.

## File Structure

- **Model**: Folder containing the `Counter` and `Visitor` classes.
- **autoload.php**: Autoloads the classes when needed.
- **config.php**: Stores settings such as the path of the file to store the visit count.
- **counter.txt**: Text file to store the overall visit count.
- **index.php**: Main file handling requests and displaying the visit count.

## How It Works

- The `Counter` class handles the logic for reading, incrementing, and saving the visit count.
- The `Visitor` class checks if a visitor has already been counted using sessions.
- Sessions are used to mark visits from the same browser and differentiate between users.

## Usage

1. Clone the repository.
2. Set up your web server to point to the project directory.
3. Visit the web page to see the visit count.

## Note

- Ensure that PHP sessions are enabled on your server.
- Use `$this->` when calling member variables and methods within a class.


