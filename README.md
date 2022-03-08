# 0. Getting up to date
Before starting work, you must first download the current version of the application from the remote repository:

git pull

# 1. Adding a new entry

hugo new posts / title_new_wpisu.md

## Adding a new logo

hugo new logotypes / title_new_logo.md

## Editing the entry

Go to the posts directory and edit the file title_new_post.md - fill in the fields accordingly

``
---
title: "Tytul_nowego_wpisu"
date: 2021-11-22T23: 16: 43 + 01: 00
draft: true
alternativeUrl:
summary:
thumbnail: "i / europe.svg"
---
``

The alternativeUrl field is used if we want to refer us to an external page instead of a subpage with the content of the link

The thumbnail field is used to add a thumbnail image to the entry - it must be added to the static directory beforehand and the path entered in this field starts inside the static directory, e.g. for static / i / europe.svg, just enter i / europe.svg

The summary field can be used with markdown syntax eg to make a link

## Editing the logotype

Go to the logotypes directory and edit the file title_new_logo.md - fill in the fields accordingly

``
---
title: ""
draft: true
link: ""
image: "i / europe.svg"
---

``


The image field is used to add an image with the organization's logo - it must be added to the static directory beforehand and the path entered in this field starts inside the static directory, e.g. for static / i / europe.svg, just enter i / europe.svg

The link field is a link to the website of the organization associated with the added logo

### IMPORTANT

After editing, you have to change the draft to false - this is how the new entry is published

## Usage Guide [markdown] (https://www.markdownguide.org/getting-started/)

# 2. Committing changes

Perform the following operations:

`hugo -D`

`git add .`

`git commit -a -m 'Information about adding a new entry`

`git push`

### The page will refresh itself on the server after about a minute of executing the above combination of commands

# 3. Local preview

While editing the page on the computer, you can preview the effect of work by typing in the terminal:
`hugo server -D`

As a result, the test server will be launched at the following address:

`http: // localhost: 1313 /`
