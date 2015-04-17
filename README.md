FFXIV Progression Checker
=========================

*I really couldn't think of a better name...*

This tool is used for quickly checking a character's raid progression in FFXIV. This saves the effort of having to actually go to the Lodestone and look things up. Information is collected using the [Lodestone API](https://github.com/viion/XIVPads-LodestoneAPI) and checks for certain achievements. However, keep in mind that this tool will not work of the specified character does not have achievements viewable to the public.

**Website:** http://ffxiv.voidteam.net/progression/  
**Powered By:** [Lumen](http://lumen.laravel.com/)

Release Notes
-------------
*April 17th, 2015*
 - Start to import project into the Lumen framework.

*April 3rd, 2015*
 - Update for 2.5.2 Content.

*January 28th, 2015*
 - Update for 2.5.0 Content.
 - Split raids into 8-man and 24-man.

*October 28th, 2014*
 - Hugely refactor assets for easier development.
 - Add Final Coil of Bahamut and Akh Afah Amphitheatre EX (Shiva).
 - Lodestone recieved a slight update for 2.4 breaking somethings with the Lodestone API. I'll have to wait to address these issues when the API is updated.
 - Made the update date point to the repository, rather than just the READEME file.

*July 14th, 2014*
 - Added icons for better understanding how the achievements work. TODO: XIVDB Tooltips.
 - Added basic character profile displaying character portrait, active class and level, and average item level.

*July 8th, 2014*
 - Added results for Syrcus Tower and Striking Tree EX (Ramuh).
 - Added results for the Second Coil of Bahamut (Savage). Note that the achievements for clearing indivdual turns are actually clears, instead of mapping achievements. There is also no overall clear achievement, so the number of clears will not be used.
 - Removed the number of clears from Labyrinth of the Ancients and Syrcus Tower.
 - Made the update date point to this README file.

*July 7th, 2014*
 - Made a slight change to the Lodestone API so I can associate each achievement by it's ID instead of the sequential number it's given. This way, when patches come out, I won't have to manually go through and figure out which achievement is which.

*July 6th, 2014*
 - Load data based on URL parameters.
 - URL automatically changes when the form is submitted (must have a compatible HTML5 browser).
 - BCoB and SCoB is broken down by each turn using the "Mapping of the Realm" achievements.
 - Results will now show all content, with uncleared instances marked in red.

*July 5th, 2014*
 - Initial Release.
