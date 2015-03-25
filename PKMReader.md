# Key Files #

PKM Reader consists of four main files. Here are how they work:

index.php - Aside from the formatting, this is really just a HTML form, pointing to the script for uploading and processing PKM files.

pkm.php - This is the file the form points to. It uploads a PKM file from the user's machine or retrieves one from an URL and then parses it to display the output.

Pokemon.php - This is the class that does all the work, reading the information from the PKM file, comparing it to various database objects and providing the user with readable information about the Pokemon.

expfunctions.php - These functions are used by the Pokemon.php file to calculate levels from experience points and vice versa.

# Database #

The PKM Reader relies heavily on a MySQL database to provide it with information. The SQL imports for this database are contained within the SQL folder in the source code download. You will need to create a MySQL database and then import these files into it. You will then need to add the details of your database server to the first couple of lines of "pkm.php" - speicifically changing the mysql\_connect() and mysql\_select\_db() commands.

Depending on how many developers / users we end up having, we may need to organise a shared public database server but I'll cross this bridge if I come to it.