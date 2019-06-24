import psycopg2
from pymongo import MongoClient
import numpy as np
import operator


conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")
cur = conn.cursor()

#cur.execute('''CREATE TABLE opeds_authors_sentiment_analysis
#      (event_id int NOT NULL,
#       author_name text NOT NULL,
#       count_opeds_written numeric NOT NULL,
#       agg_sent numeric NOT NULL,
#       degpol numeric NOT NULL,
#       PRIMARY KEY (event_id,author_name));''')
      
#print ("Table created successfully")
#conn.commit()

cur.execute("SELECT author_name,url_list,word_cnt_list,agg_sent_list,pos_sent_list,neg_sent_list from opeds_authors_metainfo where event_id=3")
rows = cur.fetchall()

author_opeds_cnt={}
author_opeds_agg_sent={}
author_opeds_degpol={}
summ=0
summ_pos=0
summ_neg=0
pol=0

for row in rows:
	summ=0
	summ_pos=0
	summ_neg=0
	pol=0
	length = len(row[1])
	author_opeds_cnt[row[0]]=length
	for val in row[3]:
		summ+=val
	for val in row[4]:
		summ_pos+=val
	for val in row[5]:
		summ_neg+=abs(val)
	if summ>=0:
		if summ_neg==0:
			pol=summ_pos
		else:
			pol=float(summ_pos)/float(summ_neg)
			
	else:
		if summ_pos==0:
			pol=summ_neg
		else:
			pol=float(summ_neg)/float(summ_pos)
			
	author_opeds_agg_sent[row[0]]=summ
	author_opeds_degpol[row[0]]=pol
			

top20_author = []
top20_dic = {}
cnt=0

for key,data in sorted(author_opeds_cnt.items(), key=lambda item: item[1],reverse=True):
	cnt+=1
	top20_author.append(key)
	top20_dic[key]=data
	if(cnt==24):
		break

for auth in top20_author:
		
	cur.execute("""INSERT INTO opeds_authors_sentiment_analysis(event_id,author_name,count_opeds_written,agg_sent,degpol)
				VALUES (3,%(b)s,%(c)s,%(d)s,%(e)s);""",
				{'b':str(auth),'c':top20_dic[auth],'d':author_opeds_agg_sent[auth],'e':author_opeds_degpol[auth]})
					
conn.commit()
print('Records inserted succesfully')
conn.close()

			
					
