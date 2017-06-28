# Construction Database | A Refactoring Story...

I thought it would be fun to take an old project and go through the process of refactoring it. 

So I picked one of the fist projects I ever did, a simple script for my dad's construction company. It was designed to help track projects that had been sent out to sub-contractors for bid. This is a slightly modified version of the original codebase, as I needed to remove any private information. I felt it important to leave it as untouched as possible, to show just how bad it was. 

I wanted to take this old piece of junk, and step by step turn it into something respectable. Along the way I hope to learn a thing or two.

# Captain's Log
## 2017.06.11
    - So this is among one of the first things I ever built. It was before I had any idea what I was doing. Before I had even decided I wanted to do web development as a career. Half the code is random stuff found on the internet and slightly modified to "work." As such you'll see variable names that make no sense, weird indentation, and all kinds of head scratchers. Super fun!

    - After a quick look around, refamiliarizing myself on exactly what this thing was suppose to do, I've decided my first objective is to write some really simple tests to document the basic behavior. I've got so many things to tackle that I'd like at least some security going forward that this thing still works. Who knows what change will be the dominio to make them all fall?
## 2017.06.13
    - Having all the files in the root directory is making my eye twitch so I moved files into public/, public/includes, and public/images directories.
    
    - The next thing I want to improve is readability. I'll be going through all the files fixing the spacing/indentation and converting tabs to spaces.
## 2017.06.14
    - The script is using php's depricated mysql library. The next major change will be switching that over to PDO. I've setup an App\Database helper class as a wrapper around a PDO object that I'll be using.
## 2017.06.15
    - Finished removing depricated mysql extensions. 

    - Going to start working on general refactoring; removing undeeded temporary variables, dry up code where possible, etc.
## 2017.06.25 
    - Finished the previous mentioned refactoring and cleanup. Added some new tests along the way as I discovered additional behvior in the app.

    - The next thing I'll be working on is the database. There are a number of areas where one table is referencing another table by something like company name, as opposed to a foreign key, and there are no constraints on the table to prevent duplicate company names. To prevent unexpected behavior, I'll be refactoring to use foreign keys. 

    - In order to help me get the ball rolling on refactoring the database I decided to pull in robmorgan/phinx so I could take advantage of database migrations. The first step here was to recreate the current tables (as is).
## 2017.06.27
    - I'm really starting to appreciate my test suite with this recent series of refactoring. I'm modifying tables and columns in the database and without being able to run my test after every change and get immediate feedback on what broke and where I'd be trying to finde a needle in a haystack.
## 2017.06.28 
    - I've done a lot of work updating the database relationships, however in the process I've created a (bigger) mess of my (honestly) already messy test suite. Before I continue on I want to pause to clean up and refactor the test suite itself. As well, I want to pull in fzaninotto/faker and create some seed data.