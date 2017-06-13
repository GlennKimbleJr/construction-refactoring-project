# Construct Database | A Refactoring Story...

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