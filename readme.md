#PHP test task

Build a web application which creates a text self-destructing messages.

User opens website and creates a message. Application generates a safe link to this saved message

(like: http://yourapp.com/message/ftr45e32fgHJKv56d2 ).

User should be able to choose destruction option:

- destroy message after the first link visit
- destroy after 1 hour

All the messages stored on the server side should be encrypted using AES algorithm (you can use any

library for text encryption).

Use any PHP framework (Zend, Laravel, Symfony or any other) for php backend. Also please deploy

your application to GIT.

Also should be implemented:

- message should be encrypted on frontend side using password and should be sent to backend in
encrypted format (to view message user should enter a right password)
- self-destruction of messages after given number of link visits or after given number of hours