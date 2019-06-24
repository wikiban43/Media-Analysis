# Media-Analysis-Data<br/>

Analysis_Twitter: This contains all the scripts,documentation pdfs and read me files about twitter data collection and the analysis done on tweets.<br/>

Article Extraction:<br/>

1) findArticles<event_name>.py: This script collects all the event related articles form the global article collection which is getting enriched by our live crawlers everyday.It uses a set of keywords for filtering out the event related articles.<br/>
Input:the main article collection kept at our gem2 server;the name is "articles".<br/>
Output:the collection under "eventwise_media-db" database at gem2 containing the event related articles.<br/>

2) extractkeywordfromarticle<event_name>.py: This script filters out all the irrelevant articles from the event specific collection using a set of rules and helps us in creating an augmented keyword set.<br/>
Input: the event specific article collection.<br/>
Output: irrelevant articles will be removed from the event specific article collection.It will also write out a .txt file which will contain a list of top 100 keywords found out using RAKE api.We need to manually filter out some event specific relevant keywords.In this way we create an augmented keyword set and run the script mentioned in point 1 once again.<br/>

ExtractSentence.py,rake.py,FrenchStoplist.txt,FoxStoplist.txt,SmartStoplist.txt and SpanishStoplist.txt are the files which need to be imported during the execution of the above mentioned scripts.<br/>

Aspect Coverage across all newspapers comparison between MM SM QH:<br/>

aspect_wise.py: This script computes the aspect wise relative coverage across newspapers for mass media,social media and QH data(Question Hour data).<br/>
Input: event specific articles fetched from our postgres database tables,the tweet collection and the xlsx file containing the LS15 and LS16 QH data.<br/>
Output: a table in our postgres database containing all the resulting values.<br/>

Aspect-Coverage for different media houses:<br/>

Mass Media/sourcewise_coverage_massmedia.py: This script computes the newspaper wise relative aspect coverage,aggregate sentiment and degree of polarity values for mass media.It also computes the mean aspect coverage across all news sources.<br/>
Input: event specific articles fetched from the postgres table.<br/>
Output: Two postgres tables containing all the resulting values.<br/>

Social Media/Mean_Aspect_Coverage_Aadhar_sourcewise.py: This script computes the nespaper wise aspect coverage,aggregate sentiment and degpol values for social media.<br/>
Input: the tweet collection in mongodb.<br/>
Output: a .csv file containing the total count of tweets/aspect newspaper wise from which we can compute relative coverage by #(tweets,aspect,newspaper)/(sum of #(tweets,newpaper) for all the aspects).It will output another .csv file where we will get the aggregate sentiment,totpos and totneg sentiment values.All the formulae in details can be found in our Thesis.<br/>

Category Comparison across all newspapers:<br/>

categorywise_overall.py: This script computes the constituency(poor,middle class,corporate,informal sector and government) wise coverage across newspapers for mass media,social media and QH data.<br/>
Input:event related articles from postgres database table.<br/>,tweet collection and xlsx files for event specific QH data.<br/>
Output:A postgres table containing all the resulting values.<br/>

Category Cov newspaper wise Mass Media:<br/>

category_newspaperwise.py: This script computes the newspaper wise constituency coverage.<br/>
Input:event specific articles from the postgres table.<br/>
Output:A postgres table containing all the resulting values.<br/>

Database Master table info:

master_table2.py:This script populates the event_info and the aspect_info master tables of our postgres database.The event_info table contains event_id and the keywords used for the event data collection with a short description of the event.The aspect_info table contains the aspect ids and aspect names for each event we have analysed.<br/>
Input:Media sheets which contain the aspect ids and the aspect names.<br/>
Output:The respective master tables as described above.<br/>

master_table4.py:This script populates the main master table in the database called art_info_final which contains all the metainfo about the event related articles collected.<br/>
Input:The output files of LDA containing the article to aspect mappings and the mongodb collections for the events.<br/>
Output:The art_info table in our postgres database.<br/>

master_table4_hindi.py:Works the same as the previous script,but it populates the master table for the events analysed on the Hindi articles.The name of the table is hindi_art_info_final.<br/>

Entity Analysis:<br/>

Entity Coverage Sentiment partywise/PowerElite_parallel_power_elites_<event_name>.py: This script computes the "by" coverage given to the top entities found in the mass media specific to the event.<br/>
Input:The mongodb collection containing all the resolved entities and the event specific article collection.<br/>
Output:A folder named Result_<event_name> which contains a folder named "1" which contains all the "by" and "about" statements of the top entities.It contains two files containing the coverage given to the power elites and non power-elites.The second last column of the files contain the "#about" statements and the last column contain the "#by" statements.The entries from both the files need to be merged and we need to sort the entries in descending order on the basis of "#by statements" of the entities.We take the top 100 covered entities.We then calculate the coverage given in the same way as explained in our Thesis.<br/>

How to run:<br/>
We run this script in two rounds:-<br/>
a) We give two input arguments,startindex=0 and endindex=110 while running the script and the select mode is 1.Immediately a file named <event_name>_resolved_all_entity_names.txt is created under the Input directory.We stop the script,edit the names of the entities in the file,save the file and again rerun the script in the same way.After the script ends its execution,we look into the same file and remove all the entities below a given threshold of the number written beside it.We note down the index of the last entity after truncating the file.Another file input_to_top100_<event_name>.txt is created outside the Input directory.It contains the indices of all the entities who are non power-elites.Remove the entries in this file below the index of the last entity we noted down from <event_name>_resolved_all_entity_names.txt after truncating.Next,we mark the endindex(end line number -1) of input_to_top100_<event_name>.txt after truncation.<br/>
b) We run the script for the second time with startindex as 0 and endindex which is found from the previous point.The select mode given is 0.As soon as we run,an editing window will open in the terminal where we add aliases manually to the entities.We save it and exit from the editing window and then press enter.The script resumes.<br/>
make_database_tables_ent_cov.py: This creates the postgres tables with the resulting coverage values for the entities.<br/>

Entity Coverage Sentiment partywise/findEntityWisePolarity_<event_name>.py:This script computes the sentiment slant of the entities by analysing their "by" statements and also computes their degree of polarity.<br/>
Input:A folder containing the "by" statements of the top20 entities and a .txt file containing the names of all those entities.<br/>
Output:A csv file containing the aggregate sentiment,tpos and tneg values against each top20 entity name.The degree of polarity is computed as is there in our Thesis.<br/>
make_database_tables_ent_pol.py:this creates a table in postgres with the resulting sentiment and degpol values for the top20 entities for each event.<br/>

Entity Coverage Sentiment partywise/findAggr_<event_name>.py:This script computes the "by" and the "about" percentages for different entity groups like BJP,INC,etc....<br/>
Input:The final entity coverage file we obtained after running the first script.The file should contain the roles filled in against every entity name.<br/>
output:A csv file containing the resulting "by" and "about" percentages against the entity groups.<br/>
make_database_tables_ent_group.py:this creates a table in postgres with the resulting percentages of different entity groups for each event.<br/>

Entity Data By statements:<br/>

This directory contains the "by" statements of all the top20 entities for all the events we have analysed.<br/>

Entity Resolution:<br/>

Elastic search index(es_index) and Elastic search mapping(es_mapping) are generated using the commands in "ProjectMigration.pdf".<br/>

Mass Media to Graph DB/elasticsrch_graphdb_person_final.py:This script resolves the unresolved entities from graph database and mass media.<br/>
Input:A mongo db collection of unresolved entity names.<br/>
Output:A mongo db collection of resolved entities.<br/>

getHighTFIDFAssocs.py and fuzzy_subset.py are the scripts which are imported for executing the previous script.The "readcsv.py" creates separate mongodb collections for different types of entities from graphDB like business-person,ias officers,ministers,politicians,etc."graph_update.py" merges all these entities from different collections into a single unresolved collection.We then add all the unresolved entities extracted from mass media into the same unresolved collection.This is how we create the unresolved collection of entities from mass media and graphDB.<br/>

Mass Media to Mass Media/extract_entities_oc_<event_name>.py:This script extracts the entities from our mass media article collection.<br/>
Input:A collection containing all the articles.<br/>
Output:A collection of unresolved entities.<br/>

Mass Media to Mass Media/entity_resolution.py:This script resolves the unresolved entities within a mass media article collection.<br/>
Input:A collection of unresolved entities.<br/>
Output:A collection of resolved entities.<br/>

All the scripts which are used as support scripts in the previous point are used here as well.<br/>

KL Divergence:<br/>

2KLDivergence_updated.py:This script computes the deviation of a news source from the mean aspect coverage.<br/>
Input:A postgres table containing the mean aspect coverage data and the event specific articles from postgres master table.<br/>
Output:A postgres table containing the resulting values of newspaper wise KL Divergence from the mean aspect coverage.<br/>

LDA:<br/>

LDA Optimisation.ipynb:This script extracts aspects from the set of articles we have for an event and also maps an article to the most probable aspects.<br/>
Input: The mongodb collection containing the event specific articles.<br/>
Output: Optimal LDA models for the most optimal k value which we decide by choosing the k value for which we get the best coherence values and aspect separations.It also outputs a .txt file where we find the top 20 articles written for each aspect along with the top 50 keywords for each aspect along with their probabilities.It also outputs a csv file which contains the article to aspect mapping.An article is mapped to an aspect if the probability of the article getting mapped to the aspect is greater than or equal to 0.30.<br/>

For both English and Hindi,the goal of the script,Input and Output remains the same.<br/>

Opeds:<br/>

cov_newspaperwise/opeds_newspaperwise.py:This script computes the newspaper wise relative coverage,aggregate sentiment and degpol for the opinion articles.<br/>
Input:event specific articles from postgres table and the opinion mongodb collection.<br/>
Output:postgres table containing the resulting coverage,aggregate sentiment and degpol values.<br/>

cov_overall/opeds_aspect_general.py:This script computes overall relative coverage,aggregate sentiment and degpol for the opinion articles across news sources.<br/>
Input:event specific articles from postgres table and the opinion mongodb collection.<br/>
Output:postgres table containing the resulting coverage,aggregate sentiment and degpol values.<br/>

opeds_authors_metainfo/opeds_author_analysis.py:This script computes the information(metainfo) about the authors writing the opinion articles.<br/>
Input:event specific articles from postgres table and the opinion mongodb collection.<br/>
Output:A postgres table containing the metainfo of all the authors writing the opinion articles.<br/>

sentiments_of_top20_authors/author_sent_analysis.py:This script computes the sentiment slant of the most frequent 20 authors for every event in the opinion articles.<br/>
Input:the postgres table containing the metainfo of the authors.<br/>
Output:A postgres table containing the aggregate sentiment,degpol values of the most frequent 20 authors in the opinion articles for each policy.<br/>

Website/html:Contains all the scripts for the landing pages of our media website.<br/>

article_info_data:This folder contains the LDA output files for English as well as Hindi analysis.It also contains the QH data xlsx files for every policy we analysed.<br/>

MongoDB Tables:<br/>

1) Article collection:,br/>
Aadhaar:aadhar_articles_3july<br/>
Demon:Demonitisation_article_2Aug<br/>
gst:gst_articles<br/>
fp:farmers_articles_final<br/>

Main English article collection is "articles".<br/>
For Hindi,Hindustan articles are in "hindustan" and "hindustan_daily".<br/>
For Navbharat times,articles are in "navbharat" and in "navbharat_daily".<br/>

2) All Tweets:<br/>
Aadhaar:aadhar_new<br/>
Demon:Demonetization_New<br/>
gst:GST_New<br/>
fp:Agri_New<br/>

3) Direct URL Tweets:<br/>
Aadhaar:aadharTWEETS<br/>
Demon:demonTWEETS<br/>
gst:gstTWEETS<br/>
fp:agriTWEETS<br/>

4) Follower/Community Tweets:<br/>
Aadhaar:aadhar_url_tweets<br/>
Demon:demon_url_tweets<br/>
gst:gst_url_tweets<br/>
fp:agri_url_tweets<br/>

DATABASE info:<br/>

hostip: 10.237.26.159<br/>
username: debanjan_final<br/>
password: Deb@12345<br/>
database name: debanjan_media_database<br/>

I am uploading my MTech THESIS into this repository.One can find descriptions of methodologies used in details along with our findings and conclusions.<br/> 
