# GEM
GIANT ECONOMY MONITOR

The website is simple and straight forward. It uses normal HTML, CSS and javascript framework. I didn't use any front end framework like Angular or React as it was not sure how complex the website is going to be at the start of the project. For scaling and making the website show dynamic content, I did end up using PHP scripts. I tried to follow the best practices but you may find some bad code as well.

## Overview

### Root

Let's discuss the folders first. At the root, you will find an index.html page. It is the main page that gets loaded when we visit the website. It is a simple HTML page with mediocre CSS styling. the style.css is the main styling file. You can see a .min file which is the same file but a bit smaller in size in order to make the website load faster. As the website grew in size, I decided to import header and footer externally onto each page so that editing will be easier in the future. There are  header.html and footer.html in each folder where it is necessary. All the other files just import those two files to render the header and footer. The favicon.ico is just the icon file. **I have not inserted it on every page and that is to be done in the near future**.

### Folders

You will find many folders at the root of the website. The names of the folders are self-explanatory. I will write a brief description of each folder to make it easily accessible. They are as follows:

##### api
Contains the php scripts to connect to the postgres database and to fetch the required data.

##### blog
Contains all the files related to the wordpress blog.

##### csv data
Contains all the csv files used all over the website. Data is arranged in simple folder format and is very easy to access.

##### Entities
All the main landing files for each tab. Also contains the html files used in Socio-Economic tab. These have to be changed in a single php file in future.

##### GeoJSON_Files
Contains the main data file for Socio-Economic tab graphs.

##### Images
This folder contains all the images used on the website

##### json data
This folder contains all the json data. Usually for the info.php graphs in Corporate Interlock graphs.

##### library
Necessary scripts for the Socio-Economic tab. **Socio Economic tab has to be redesigned as it was developed by another team and is not on php,takes some time in loading.**.

##### Pages
All the dynamic php scripts, one for each of the three tabs.

##### scripts
Normal css styling scripts.

##### text data
This folder contains all the text files that are dynamically loaded all over the website. The files are arranged in a simple *folder format* to make it easy to reach and load using PHP. There is nothing complex in this folder.

1. **Mass Media** folder contains files related to Media Bias tab and its policies.

2. **Political** folder contains files related to Political Economy tab and its policies.
