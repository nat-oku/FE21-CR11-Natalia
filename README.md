# FE21-CR11-Natalia

Project description: “Adopt a Pet”
You love animals and think it is time to adopt one. You like all sorts of animals: small animals, large animals, you may even like reptiles and birds and may be open to adopting animals of any age. 

All animals have a photo and live at a specific location. They also have a description, age and belong to a breed.  

What all the animals have in common is a name, an image, a description and a location. A location should hold information about the city, ZIP-code, address (single line like “Praterstrasse 23”).

Small animals have a location, an image, a name, a description, hobbies and age.

Large animals have a location, an image, a name, a description, hobbies and age.

Senior animals (older than 8 years old) have a location, an image, a name, a description, hobbies and age.

Your MySQL database MUST be named: cr11_petadoption_yourname

For this CodeReview, the following criteria will be graded:

 
(5) Create a database (cr11_petadoption_yourname) and add sufficient test data (at least 4 small animals, 4 large animals and 4 seniors) 

(20) Display all animals on a single web page (home.php).      

(15) Display all senior animals on a single web page (senior.php).

(15) Create a registration and login system.

(15) Create separate sessions for normal users and administrators. 

(30) Create an admin panel. Only the admin is able to create, update and delete data about animals within the admin panel. The normal user will be able to see everything that was created for this website, without having administrative privileges in changing the data. 

Bonus points
(20)Pet Adoption

In order to accomplish this task, a new table PetAdoption will need to be created. This table should hold the userId and the petId plus other information that you may think is relevant.

Each Pet should have a button "Take me home" that if the user clicks on it, it should pick the pet. When it does, a new record should be created in the table PetAdoption.

Hint: if you use the POST method to create the adoption, you will need a form. Get method won't need it.

You can expand on it creating a status for the pet and it only shows to be adopted according to its status.