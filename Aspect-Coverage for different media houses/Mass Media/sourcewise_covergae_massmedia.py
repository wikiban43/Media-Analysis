import sys
import sqlite3
import time
import itertools
import numpy as np
from pymongo import MongoClient
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer
import psycopg2

li = [0,1,2,3,4,5,6,9,10,12,13,14,15,19]
conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")

cur = conn.cursor()

#cur.execute('''CREATE TABLE massmedia_aspectwise_coverage
#      (event_id INT NOT NULL,
#       aspect_id INT NOT NULL,
#       newspaper TEXT NOT NULL,
#      coverage decimal NOT NULL,
#       agg_sent decimal NOT NULL,
#       polarity decimal NOT NULL,
#       PRIMARY KEY (event_id,aspect_id,newspaper));''')
      
#print ("Table created successfully")
#conn.commit()

#cur.execute('''CREATE TABLE mean_aspect_cov
#      (event_id INT NOT NULL,
#       aspect_id INT NOT NULL,
#       mean_coverage decimal NOT NULL,
#       PRIMARY KEY (event_id,aspect_id));''')
      
#print ("Table created successfully")
#conn.commit()


cur.execute("SELECT event_id,asp_id,url,senti,word_cnt,senti_pos,senti_neg from art_info_final")
rows = cur.fetchall()
category_list = []
url_list = []
senti_list = []
word_count = []
senti_list_pos = []
senti_list_neg = []

for row in rows:

   if(row[0] == 3):
      category_list.append(row[1])
      url_list.append(row[2])
      senti_list.append(row[3])
      word_count.append(row[4])
      senti_list_pos.append(row[5])
      senti_list_neg.append(row[6])

print ("Operation done successfully")
conn.commit()

newspaper_list = ['thehindu','hindustantimes','timesofindia','telegraph','newindianexpress','indianexpress','deccanherald']

array_to_write_word = np.zeros((7,21),dtype=float).tolist()
array_to_write_sent = np.zeros((7,21),dtype=float).tolist()
array_to_write_sent_pos = np.zeros((7,21),dtype=float).tolist()
array_to_write_sent_neg = np.zeros((7,21),dtype=float).tolist()
total_words = np.zeros((7,1),dtype=float).tolist()


for i in range(len(url_list)):
	print('Done for '+str(i)+' url')
	lis = category_list[i]
	for j in range(len(newspaper_list)):
		if(newspaper_list[j] in url_list[i]):
			total_words[j][0]+=float(word_count[i])
			for cat in lis:
				array_to_write_word[j][int(cat)]+=float(word_count[i])
				array_to_write_sent[j][int(cat)]+=float(senti_list[i])
				array_to_write_sent_pos[j][int(cat)]+=float(senti_list_pos[i])
				array_to_write_sent_neg[j][int(cat)]+=float(senti_list_neg[i])
			break
			
for i in range(len(newspaper_list)):
	for j in range(21):
		if(j in li):
			val_cov = array_to_write_word[i][j]/total_words[i][0]
			agg_s = array_to_write_sent[i][j]
			if(array_to_write_sent[i][j]>=0):
				if(abs(array_to_write_sent_neg[i][j])>0):
					val_pol = array_to_write_sent_pos[i][j]/abs(array_to_write_sent_neg[i][j])
				else:
					val_pol = array_to_write_sent_pos[i][j]
			else:
				if(array_to_write_sent_pos[i][j]>0):
					val_pol = abs(array_to_write_sent_neg[i][j])/array_to_write_sent_pos[i][j]
				else:
					val_pol = abs(array_to_write_sent_neg[i][j])
				
			cur.execute("""INSERT INTO massmedia_aspectwise_coverage (event_id, aspect_id, newspaper, coverage, agg_sent, polarity)
			VALUES (3, %(int)s, %(txt)s, %(fl1)s, %(fl2)s, %(fl3)s);""",   
			{'int': j, 'txt': str(newspaper_list[i]), 'fl1': val_cov, 'fl2':agg_s, 'fl3':val_pol})

'''
sum_cov = 0
for j in range(21):
	sum_cov = 0
	if(j in li):
		for i in range(len(newspaper_list)):
			val_cov = array_to_write_word[i][j]/total_words[i][0]
			sum_cov+=val_cov
		final_val = float(sum_cov)/7.0
		cur.execute("""INSERT INTO mean_aspect_cov(event_id,aspect_id,mean_coverage)
		VALUES (3,%(int)s,%(fl)s);""",
		{'int':j,'fl':final_val})
'''
			
conn.commit()
print('Records inserted succesfully')
conn.close()

