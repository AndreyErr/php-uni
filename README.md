# phpuni

*Relevant for pr3 (practice 3) committee.*

Here is the nginx build (with static content) + apache (with dynamic content) and two types of authorization.

It is launched via docker, in the terminal, being in the project directory, you need to write `docker-compose up --build` to build the project. After launching, the project can be opened at `http://localhost:9000`
Admin page with php authorization: `http://localhost:9000/adm.php` (the authorization form itself is on the main page *http://localhost:9000*). 
(password hashing is performed in md5 by php methods)
Login: 2 | Password: 1
---
Admin page with apache authorization `http://localhost:9000/limit/adm2.php`. 
(password hashing is performed in md5 by apache methods)
Login: 1 | Password: 1
Login: admin | Password: admin
Login: adm |  Password: adm

*You'll figure out the rest yourself* :)