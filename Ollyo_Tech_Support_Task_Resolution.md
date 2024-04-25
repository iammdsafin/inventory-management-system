# Ollyo Tech Support Task - Issue Resolution Report

## Introduction
This document outlines the steps that has been taken to resolve the issues identified.

## Issues and Tasks
### Issue One:
DESCRIPTION: Upon opening the project, you may encounter error messages indicating issues that need to be resolved. Your task is to address these errors and fix the underlying issues.

ERRORS: 
1. "Call to undefined function mysql_connect()".
2. "Uncaught mysqli_sql_exception"

STEPS TAKEN:
1. mysql_connect() function being undefined was showing as it was trying to use mysql_* functions, which have been deprecated since PHP 5.5. I have used mysqli_connect() for improved security and functionality.
2. I have implemented error handling for the database connection using mysqli_connect_error().
3. session_register(), was deprecated so I have assigned session variables directly into the $_SESSION[] array.
4. I have used prepared statements with parameter binding for sql queries and updated session variable names from usar_id to user_id and usar_name to user_name also fixed typo in the (</labe> to </label>).


### Issue Two:
DESCRIPTION: The Total Credit Order column should display values, but currently, it appears empty. Your task is to address this issue and ensure that the column values are properly displayed.

ERRORS:
1. Fatal error: Uncaught Error: Call to undefined method mysqli_stmt::rowCount()

STEPS TAKEN:
1. I have replaced rowCount() with num_rows and used the mysqli_stmt_get_result() to retrieve retrieve the result set from a prepared statement.
2. Here in the "$result = $statement->fetchAll();" the fetchALL() method is associated with the PDO (PHP Data Objects) extension, not with the mysqli extension so I have replaced with "$result = mysqli_stmt_get_result($statement);".


### Issue Three
DESCRIPTION: Resemble the order table according to this layout (https://prnt.sc/_3v_5aiKCVpy). Task is to rectify the order table to match the desired layout and resolve any associated errors.

ERRORS:
1. When clicking on the "Add" button, the order modal fails to open as expected.

STEPS TAKEN:
1. In the "order.php" file I have added the data-target="#orderModal" attribute within the "Add" button 


### Issue Four
DESCRIPTION: The delete and update functions for the "Orders" table are currently not functioning as expected. Both the delete and update functions operate correctly.

ERRORS:

STEPS TAKEN:


### Issue Five
DESCRIPTION: The search feature for the orders table is presently encountering an issue. Specifically, when attempting to search by user last name, it fails to yield results.

ERRORS:

STEPS TAKEN:


### Issue Six
DESCRIPTION: When attempting to view the order details in PDF format, but the function is not functioning properly, as it is generating numerous error message.

ERRORS:

STEPS TAKEN:


### Task One
DESCRIPTION: Currently, there is no backend validation for the user's email field, allowing the creation of new users without a valid email address. It is necessary to implement backend validation for this field.

STEPS TAKEN:
1. Added email validation in JavaScript using a regular expression and xtracts email value from the input field with ID 'user_email', and checks against the specified pattern. If the email doesn't match the pattern, it displays an error message.


### Task Two
Currently, the date format on the order page appears as "2024-03-25". You need to modify the format to display as "25 March 2024".
STEPS TAKEN:


### Task Three
Currently, users can change their password from their profile page without providing their old password. You need to update the profile page update system to include the old password field. This way, users will be required to enter their old password to change their password.
STEPS TAKEN:
1. "Old Password" field created in the profile page and tested.

### Issue Seven
DESCRIPTION: While attempting to create a new user from the users page, using the username "Steven Paul Jobs", encountering an issue.

ERRORS:
1. Fatal error: Uncaught mysqli_sql_exception and execute() method expects a list array.

STEPS TAKEN:
1. mysqli_sql_exception was for the previous array uses named placeholder in SQL query with mysqli and it supports only "?". 


## Improvements / Issues Based on My Findings
### Improvement One
DESCRIPTION: The delete functions for the "Category", "Brand" and "User" table are currently not functioning as expected.

ERRORS:
1. Fatal error: Uncaught mysqli_sql_exception and execute() method expects a list array.

STEPS TAKEN:
1. mysqli_sql_exception was for the previous array uses named placeholder in SQL query with mysqli and it supports only "?". 


### Improvement Two
DESCRIPTION: The adding function for "Category", "Brand" table are currently nor functiioning as expected.

ERRORS:
1. Fatal error: Uncaught mysqli_sql_exception: You have an error in your SQL syntax; 

STEPS TAKEN:
1. mysqli does not support named placeholders so I have replaced it with "?" for placeholders and adjusted the method.


### Improvement Three
DESCRIPTION: User profile was not functional and showing error messages.

ERRORS:
1. Undefined method 'fetchAll'.

STEPS TAKEN:
1. The fetchAll() method is not a method in the mysqli extension so I changed to get_result() method.


## Testing and Verification
- Conducted thorough testing of each resolved issue to ensure proper functionality.
- Tested various scenarios and edge cases to verify the effectiveness of the fixes.

## Deployment
- Deployed the updated project to 000Webhost.
- Live URL: [https://ollyo-ims.000webhostapp.com]

## References
- [Link to PHP documentation](https://www.php.net/docs.php)
- [Link to MySQL documentation](https://dev.mysql.com/doc/)
- [Link to JavaScript documentation](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
