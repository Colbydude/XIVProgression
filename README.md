FFXIV Progression Checker
=========================
[![Actions Status](https://github.com/Colbydude/FFXIVProgressionChecker/workflows/CI/badge.svg)](https://github.com/Colbydude/FFXIVProgressionChecker/actions)

*I really couldn't think of a better name...*

This tool is used for quickly checking a character's raid progression in FFXIV. This saves the effort of having to actually go to the Lodestone and look things up. Information is collected using the [XIVAPI](https://xivapi.com) and checks for certain achievements. However, keep in mind that this tool will not work of the specified character does not have achievements viewable to the public.

**Website:** http://ffxiv.voidteam.net/progression  
**Powered By:** [Laravel](https://laravel.com/) and [Vue](https://vuejs.org/)

Release Notes
-------------
**October 29th, 2019**
- Update for 5.1 Content.

**July 30th, 2019**
- Update for 5.05 Content.
- Make instances with more than one turn collapsable.

**July 16th, 2019**
- Update for 5.01 Content.

**July 2nd, 2019**
- Update for 5.0 Content.

**June 28th, 2019**
- Add Gunbreaker and Dancer jobs.
- Prepare for 5.0 Content.

**June 24th, 2019**
- Add ability to filter instances by expansion.
- Add Spriggan and Twintania to the list of worlds.

**March 27th, 2019**
- Update for 4.56 Content.

**February 3rd, 2019**
- Refactor to leverage the XIVAPI since XIVDB shut down.
- Update app to Laravel 5.7.
- Update for 4.5 Content.
- Update for 4.4 Content.
- Update for 4.36 Content.
- Update for 4.31 Content.

**May 22nd, 2018**
- Update for 4.3 Content.

**January 30th, 2018**
- Update for 4.2 Content.

**October 27th, 2017**
- Update for 4.11 Content.

**October 10th, 2017**
- Full rebuild using Vue and referencing the XIVDB API for better performance.
- Addition of link to character's XIVDB Profile.
- Addition of character's class information.
- Update for 4.1 Content.

**August 2nd, 2017**
- Update for 4.05 Content.
- Update for 4.01 Content.
- Update for 4.0 Content.
- Update for 3.5 Content.
- Update for 3.4 Content.

**July 10th, 2017**
 - Update app to Laravel 5.4.
 - Implement first phase redesign.
 - Update Lodestone API.

**June 27th, 2016**
 - Update for 3.3 Content.

**April 16th, 2016**
 - Fix bug causing multiple clears displaying the wrong number.

**March 2nd, 2016**
 - Update for 3.2 Content.

**November 13th, 2015**
 - Update for 3.1 Content.

**July 24th, 2015**
 - Implement a brand new redesign.
 - Update for 3.0.5 Content.
 - Use relative path to include the Lodestone API. Composer gets wonky here.

**June 20th, 2015**
 - Update to Lumen 5.1.
 - Refactor with PSR-2 Standards.
 - Refactor to use the LodestoneAPI v5.
 - Display Character Data even if public achievements are not enabled.
 - Heavensward content coming soon!!

**June 3rd, 2015**
 - Fix error when trying to access with a trailing slash.

**April 17th, 2015**
 - Start to import project into the Lumen framework.

**April 3rd, 2015**
 - Update for 2.5.2 Content.

**January 28th, 2015**
 - Update for 2.5.0 Content.
 - Split raids into 8-man and 24-man.

**October 28th, 2014**
 - Hugely refactor assets for easier development.
 - Add Final Coil of Bahamut and Akh Afah Amphitheatre EX (Shiva).
 - Lodestone recieved a slight update for 2.4 breaking somethings with the Lodestone API. I'll have to wait to address these issues when the API is updated.
 - Made the update date point to the repository, rather than just the READEME file.

**July 14th, 2014**
 - Added icons for better understanding how the achievements work. TODO: XIVDB Tooltips.
 - Added basic character profile displaying character portrait, active class and level, and average item level.

**July 8th, 2014**
 - Added results for Syrcus Tower and Striking Tree EX (Ramuh).
 - Added results for the Second Coil of Bahamut (Savage). Note that the achievements for clearing indivdual turns are actually clears, instead of mapping achievements. There is also no overall clear achievement, so the number of clears will not be used.
 - Removed the number of clears from Labyrinth of the Ancients and Syrcus Tower.
 - Made the update date point to this README file.

**July 7th, 2014**
 - Made a slight change to the Lodestone API so I can associate each achievement by it's ID instead of the sequential number it's given. This way, when patches come out, I won't have to manually go through and figure out which achievement is which.

**July 6th, 2014**
 - Load data based on URL parameters.
 - URL automatically changes when the form is submitted (must have a compatible HTML5 browser).
 - BCoB and SCoB is broken down by each turn using the "Mapping of the Realm" achievements.
 - Results will now show all content, with uncleared instances marked in red.

**July 5th, 2014**
 - Initial Release.
