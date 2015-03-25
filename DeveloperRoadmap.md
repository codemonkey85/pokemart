# Basic PKM Support #
  * Eggs
  * Pokerus
  * Contest Stats
  * Alternate Forms
  * Encounter Types
  * Markings
  * Get Missing Ribbon Icons

# Further Development #
  * Move the HTML / CSS displaying of data to within the main class definition. This is largely for neatness, so that it can be contained within one file.
  * Create function to re-export the values as a new PKM file - this will eventually form the basis of making the values editable.
  * Create function to move between Box-type and Party-type PKM files.
  * Create a function to evolve a Pokemon to it's next stage
  * Create function for calculating what damage it deals / takes from other types of Pokemon

# Database Development #
  * Finish work on the evolutions table
  * Create standalone serverless-version of the database (most likely SQLite-compatible)
  * Create system to edit the database and commit changes publicly