import sys
import numpy as np
from pymongo import MongoClient
import psycopg2

client = MongoClient('act4dgem.cse.iitd.ac.in', 27017)
db = client['eventwise_media-db']
coll = db['farmers_opinion']
li = [0,1,2,3,4,5,6,9,10,12,13,14,15,19]
newssource = ['thehindu','hindustantimes','telegraph','timesofindia','newindianexpress','indianexpress','deccanherald']

docs = coll.find({})
opeds_url_lis = []
for doc in docs:
	url = doc['articleUrl']
	url = url.strip()
	opeds_url_lis.append(url)

conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")
cur = conn.cursor()

#cur.execute('''CREATE TABLE opeds_aspect_cov
#      (event_id integer NOT NULL,
#       aspect_id integer NOT NULL,
#       aspect_cov numeric NOT NULL,
#       aspect_aggr_sentiment numeric NOT NULL,
#       polarity numeric NOT NULL, 
#       PRIMARY KEY (event_id,aspect_id));''')
      
#print ("Table created successfully")
#conn.commit()

cur.execute("SELECT url,word_cnt,asp_id,senti,senti_pos,senti_neg from art_info_final where event_id=3")
rows = cur.fetchall()

arr_cov = np.zeros((21,1),dtype=float)
arr_sent = np.zeros((21,1),dtype=float)
arr_pos = np.zeros((21,1),dtype=float)
arr_neg = np.zeros((21,1),dtype=float)

art_urls = []
aspect = []
word_cnt = []
sentiment = []
sent_pos = []
sent_neg = []

for row in rows:
	art_urls.append(row[0])
	aspect.append(row[2])
	word_cnt.append(row[1])
	sentiment.append(row[3])
	sent_pos.append(row[4])
	sent_neg.append(row[5])

cnt = 0
total_words = 0

for i in range(len(art_urls)):
	cnt+=1
	print('Done for '+str(cnt)+' article')
	url = art_urls[i]
	url = url.strip()
	if url in opeds_url_lis:
		total_words+=word_cnt[i]	
		for a in aspect[i]:
			if  int(a) in li:
				arr_cov[int(a)][0]+=float(word_cnt[i])
				arr_sent[int(a)][0]+=float(sentiment[i])
				arr_pos[int(a)][0]+=float(sent_pos[i])
				arr_neg[int(a)][0]+=abs(float(sent_neg[i]))
				
for j in li:
	val = float(arr_cov[j][0])/float(total_words)	
	if arr_sent[j][0]>=0:
		if arr_neg[j][0]>0:
			pol = arr_pos[j][0]/arr_neg[j][0]
		else:
			pol = arr_pos[j][0]
		
	else:
		if arr_pos[j][0]>0:
			pol = arr_neg[j][0]/arr_pos[j][0]
		else:
			pol = arr_neg[j][0]
		

	cur.execute("""INSERT INTO opeds_aspect_cov(event_id,aspect_id,aspect_cov,aspect_aggr_sentiment,polarity)
				VALUES (3,%(b)s,%(c)s,%(d)s,%(e)s);""",
				{'b':j,'c':val,'d':arr_sent[j][0],'e':pol})			
											
conn.commit()
print('Records inserted succesfully')
conn.close()
