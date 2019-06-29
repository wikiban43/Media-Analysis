# GIANT ECONOMY MONITOR
The website is simple and straight forward. It uses normal HTML, CSS and javascript framework. I didn't use any front end framework like Angular or React as it was not sure how complex the website is going to be at the start of the project. For scaling and making the website show dynamic content, I did end up using PHP scripts. I tried to follow the best practices but you may find some bad code as well.

## Overview

### Root

Let's discuss the folders first. At the root, you will find an index.html page. It is the main page that gets loaded when we visit the website. It is a simple HTML page with mediocre CSS styling. the style.css is the main styling file. You can see a .min file which is the same file but a bit smaller in size in order to make the website load faster. As the website grew in size, I decided to import header and footer externally onto each page so that editing will be easier in the future. There are  header.html and footer.html in each folder where it is necessary. All the other files just import those two files to render the header and footer. The favicon.ico is just the icon file. **I have not inserted it on every page and that is to be done in the near future**.

### Folders

You will find many folders at the root of the website. The names of the folders are self-explanatory. I will write a brief description of each folder to make it easily accessible. They are as follows:

##### api
Contains the php scripts to connect to the postgres database and to fetch the required data. It has two main files : data.php and kld_data.php.

data.php handles the data fetch request from mediainfo.php(/Pages) file. The data fetched from this request is then used to create the *mass media* graph on each policy.

kld_data.php handles the data fetch request from mediainfo.php(/Pages) file. The data fetched from this request is then used to create the *K L Divergence* graph on each policy.

##### blog
Contains all the files related to the wordpress blog.
The blog is made using wordpress. The admin panel for the wordpress can be accessed by loading /wp-admin route on the main page.
Everything can be edited in wp-admin panel from styling to adding new post. The credentials for login have been already provided to Sir.

##### csv data
Contains all the csv files used all over the website. Data is arranged in simple folder format and is very easy to access. *For example:* if the data for the graph of Aadhar Policy in Mass Media tab for Hindustan times is needed to be updated for Social Plot in Aspect coverage, following file should be updated: **csv data/Mass Media/0/hindustantimes/AspectCoverage/Social/GraphData.csv**
`This is code that fetched the data: CSV format`
	
~~~~
chart.dataSource.url ="../csv data/Mass Media/<?php echo $_GET['event']; ?>/<?php echo $_GET['np']; ?>/AspectSentiment/Social/GraphData.csv";
chart.dataSource.parser = new am4core.CSVParser();
~~~~

For now the data for the Mass Media plots for all policies is being fetched from database. The social Media plots are fetched from CSV files ono server. That need to be updated to database driven approach as well in near future.
`This is code that fetched the data: JSON format`
	
~~~~
chart.dataSource.url = '<?php echo "../api/data.php?event=$event&np=$np&coverage=sentiment";?>
~~~~

##### Entities
All the main landing files for each tab.

>1. INTERLOCKS.htm            : Corporate Interlocks Tab,
>2. MASSMEDIABASIS.htm        : Media Bias Tab,
>3. POLITICALECONOMY.htm      : Political Economy Tab,
>4. SOCIO-ECODEV.htm          : Socio Economic Development Tab,
>5. politicalfunding.htm      : Political Funding Page inside Corporate Interlocks Tab,
>6. socialresponsibility.htm  : CSR Page inside Corporate Interlocks Tab

##### GeoJSON_Files
Contains the main data file for Socio-Economic tab graphs. **Ask the Sattelite Team**

##### Images
This folder contains all the images used on the website. Images on CSR Page,etc.

##### json data
This folder contains all the json data. Usually for the info.php(/Pages) graphs in Corporate Interlock graphs.
`This is code that fetched the data: JSON format`
	
~~~~
var json = $.getJSON("../json data/<?php echo $_GET['page']; ?>.json");
~~~~ 

##### library
Necessary scripts for the Socio-Economic tab. **Socio Economic tab has to be redesigned as it was developed by another team. These have to be changed in a single php file in future.**.

##### Pages
All the dynamic php scripts, one for each of the three tabs. We have used [**Amcharts**](https://www.amcharts.com/demos/) for all the graphs. Its a easy to use powerful javaScript graph plotting library. The code is easy to understand after going through demo examples on the website.

##### scripts
Normal css styling scripts.

##### text data
This folder contains all the text files that are dynamically loaded all over the website. The files are arranged in a simple *folder format* to make it easy to reach and load using PHP. There is nothing complex in this folder. It has the same format as csv data folder discussed above.

1. **Mass Media** folder contains files related to Media Bias tab and its policies.

2. **Political** folder contains files related to Political Economy tab and its policies.




> Website is currently hosted at http://act4d.iitd.ac.in/act4dgem/
