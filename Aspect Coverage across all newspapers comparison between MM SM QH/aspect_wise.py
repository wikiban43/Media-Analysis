import sys
import numpy as np
from pymongo import MongoClient
import pandas as pd
import xlrd 
import psycopg2

conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")
cur = conn.cursor()

client = MongoClient('localhost', 27017)
db = client['AAdhar_db']
db_comm = client['Social_Media']
coll = db['agriTWEETS']
coll_comm = db_comm['agri_url_tweets']
arr_mm = np.zeros((21,1),dtype=float).tolist()
arr_sm = np.zeros((21,1),dtype=float).tolist()
arr_sm_comm = np.zeros((21,1),dtype=float).tolist()

#cur.execute('''CREATE TABLE aspect_cov_across_newspapers
#      (event_id INT NOT NULL,
#       aspect_id INT NOT NULL,
#       massmedia_coverage decimal NOT NULL,
#       socialmedia_direct_coverage decimal NOT NULL,
#       socialmedia_community_coverage decimal NOT NULL,
#       QH_coverage decimal NOT NULL,
#       PRIMARY KEY (event_id,aspect_id));''')
      
#print ("Table created successfully")
#conn.commit()

cur.execute("SELECT event_id,asp_id,url,word_cnt from art_info_final")
rows = cur.fetchall()
art_urls = []
aspect = []
word_cnt = []

for row in rows:

   if(row[0] == 3):
      aspect.append(row[1])
      art_urls.append(row[2])
      word_cnt.append(row[3])

print ("Operation done successfully")
conn.commit()

cnt = 0
total_words = 0
total_tweets = 0
total_tweets_comm = 0

for i in range(len(art_urls)):
	cnt+=1
	print('Done for '+str(cnt)+' article')
	lis = aspect[i]
	total_words+=float(word_cnt[i])
	for cat in lis:
		arr_mm[int(cat)][0]+=float(word_cnt[i])

all_docs = coll.find({})
cnt = 0
for tweet in all_docs:
	cnt+=1
	print('Done for '+str(cnt)+' tweet')
	url=tweet['article_url']
	url = url.strip()
	for i in range(len(art_urls)):
		if(url==art_urls[i].strip()):
			total_tweets+=1
			lis = aspect[i]
			for cat in lis:
				arr_sm[int(cat)][0]+=1
			break

all_docs = coll_comm.find({})
cnt = 0
for tweet in all_docs:
	cnt+=1
	print('Done for '+str(cnt)+' tweet')
	url=tweet['article_url']
	url = url.strip()
	for i in range(len(art_urls)):
		if(url==art_urls[i].strip()):
			total_tweets_comm+=1
			lis = aspect[i]
			for cat in lis:
				arr_sm_comm[int(cat)][0]+=1
			break
			
xls = pd.ExcelFile('./LS_QH_Agriculture_Aspects.xlsx')
df1 = pd.read_excel(xls, 'LS15')
df2 = pd.read_excel(xls, 'LS16')
arr = np.zeros((21,1),dtype=float)
tot_ques = 0
data = df1.AspectID1
for i in data:
	tot_ques+=1
	if(i >= 0 ):
		arr[int(i)][0]+=1
		
data = df1.AspectID2
for i in data:
	if(i >= 0 ):
		arr[int(i)][0]+=1
		
data = df2.AspectID1
for i in data:
	tot_ques+=1
	if(i >= 0 ):
		arr[int(i)][0]+=1
		
data = df2.AspectID2
for i in data:
	if(i >= 0 ):
		arr[int(i)][0]+=1
	
li = [0,1,2,3,4,5,6,9,10,12,13,14,15,19]
for i in range(21):
	if i in li:
		val1=arr_mm[i][0]/total_words
		val2=arr_sm[i][0]/total_tweets
		val3=arr_sm_comm[i][0]/total_tweets_comm
		val4 = arr[i][0]/tot_ques
		cur.execute("""INSERT INTO aspect_cov_across_newspapers(event_id,aspect_id,massmedia_coverage,socialmedia_direct_coverage,socialmedia_community_coverage,QH_coverage)
		VALUES (3,%(int)s,%(fl1)s,%(fl2)s,%(fl3)s,%(fl4)s);""",
		{'int':i,'fl1':val1,'fl2':val2,'fl3':val3,'fl4':val4})
		
conn.commit()
print('Records inserted succesfully')
conn.close()		

