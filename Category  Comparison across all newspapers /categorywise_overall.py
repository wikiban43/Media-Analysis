import sys
import numpy as np
from pymongo import MongoClient
import pandas as pd
import xlrd 
import psycopg2

conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")
cur = conn.cursor()

welfare = [0,1,2,3,4,5,6,9,10,12,13,14,15,19]
middle_class = [4]
neo_liberal = []
informal_sector = []
government = [1,3,9,10,12,14,15,19]
asp_list = [0,1,2,3,4,5,6,9,10,12,13,14,15,19]

#cur.execute('''CREATE TABLE categorywise_cov_overall
#      (event_id INT NOT NULL,
#       category text NOT NULL,
#       massmedia_coverage numeric NOT NULL,
#       socialmedia_community_coverage numeric NOT NULL,
#       QH_coverage numeric NOT NULL,
#       PRIMARY KEY (event_id,category));''')
      
#print ("Table created successfully")
#conn.commit()



arr = np.zeros((5,3),dtype=float)

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

url_list = {}
tot_articles=0
cnt = 0
for art in range(len(art_urls)):
	cnt+=1
	print('Done for '+str(cnt)+' article')
	url = art_urls[art].strip()
	aspct = aspect[art]
	wrd = word_cnt[art]
	for asp in aspct:
		asp = int(asp)
		if((asp in asp_list) and (url not in url_list)):
			tot_articles+=wrd
			url_list[url]=[]
			if(asp in welfare):
				arr[0][0]+=float(wrd)
				url_list[url].append(0)
			if(asp in middle_class):
				arr[1][0]+=float(wrd)
				url_list[url].append(1)
			if(asp in neo_liberal):
				arr[2][0]+=float(wrd)
				url_list[url].append(2)
			if(asp in informal_sector):
				arr[3][0]+=float(wrd)
				url_list[url].append(3)
			if(asp in government):
				arr[4][0]+=float(wrd)
				url_list[url].append(4)
			
		elif((asp in asp_list) and (url in url_list)):
			lis = url_list[url.strip()]
			if((asp in welfare) and (0 not in lis)):
				arr[0][0]+=float(wrd)
				url_list[url].append(0)
			if((asp in middle_class) and (1 not in lis)):
				arr[1][0]+=float(wrd)
				url_list[url].append(1)
			if((asp in neo_liberal) and (2 not in lis)):
				arr[2][0]+=float(wrd)
				url_list[url].append(2)
			if((asp in informal_sector) and (3 not in lis)):
				arr[3][0]+=float(wrd)
				url_list[url].append(3)
			if((asp in government) and (4 not in lis)):
				arr[4][0]+=float(wrd)
				url_list[url].append(4)
			
					
xls = pd.ExcelFile('./LS_QH_Agriculture_Aspects.xlsx')
df1 = pd.read_excel(xls, 'LS15')
df2 = pd.read_excel(xls, 'LS16')
tot_ques = 0
url_list_qh = []
data = df1.AspectID1
data2 = df1.AspectID2

for i in range(data.size):
	url_list_qh = []
	tot_ques+=1
	if(data[i] >= 0 ):
		if(int(data[i]) in welfare):
			arr[0][2]+=1
			url_list_qh.append(0)
		if(int(data[i]) in middle_class):
			arr[1][2]+=1
			url_list_qh.append(1)
		if(int(data[i]) in neo_liberal):
			arr[2][2]+=1
			url_list_qh.append(2)
		if(int(data[i]) in informal_sector):
			arr[3][2]+=1
			url_list_qh.append(3)
		if(int(data[i]) in government):
			arr[4][2]+=1
			url_list_qh.append(4)
		
	if(not pd.isnull(data2[i]) and data2[i] >= 0 ):
		if((int(data2[i]) in welfare) and (0 not in url_list_qh)):
			arr[0][2]+=1
		if((int(data2[i]) in middle_class) and (1 not in url_list_qh)):
			arr[1][2]+=1
		if((int(data2[i]) in neo_liberal) and (2 not in url_list_qh)):
			arr[2][2]+=1
		if((int(data2[i]) in informal_sector) and (3 not in url_list_qh)):
			arr[3][2]+=1
		if((int(data2[i]) in government) and (4 not in url_list_qh)):
			arr[4][2]+=1
			

data = df2.AspectID1
data2 = df2.AspectID2
	
for i in range(data.size):
	url_list_qh = []
	tot_ques+=1
	if(data[i] >= 0 ):
		if(int(data[i]) in welfare):
			arr[0][2]+=1
			url_list_qh.append(0)
		if(int(data[i]) in middle_class):
			arr[1][2]+=1
			url_list_qh.append(1)
		if(int(data[i]) in neo_liberal):
			arr[2][2]+=1
			url_list_qh.append(2)
		if(int(data[i]) in informal_sector):
			arr[3][2]+=1
			url_list_qh.append(3)
		if(int(data[i]) in government):
			arr[4][2]+=1
			url_list_qh.append(4)
		
	if(not pd.isnull(data2[i]) and data2[i] >= 0 ):
		if((int(data2[i]) in welfare) and (0 not in url_list_qh)):
			arr[0][2]+=1
		if((int(data2[i]) in middle_class) and (1 not in url_list_qh)):
			arr[1][2]+=1
		if((int(data2[i]) in neo_liberal) and (2 not in url_list_qh)):
			arr[2][2]+=1
		if((int(data2[i]) in informal_sector) and (3 not in url_list_qh)):
			arr[3][2]+=1
		if((int(data2[i]) in government) and (4 not in url_list_qh)):
			arr[4][2]+=1
			

client = MongoClient('mongodb://act4dgem.cse.iitd.ac.in:27017')
db = client['eventwise_media-db']
coll = db['agri_url_tweets']
docs = coll.find({},  no_cursor_timeout=True)
cnt = 0
tot_tweets = 0
url_list_tweet = {}

for doc in docs:
	cnt+=1
	print('Done for '+str(cnt)+' tweet')
	tweet_url = doc['article_url'].strip()
	
	for art in range(len(art_urls)):
		url = art_urls[art].strip()
		aspct = aspect[art]
		if(tweet_url==url):
			for asp in aspct:
				asp = int(asp)
				if((asp in asp_list) and (url not in url_list_tweet)):
					tot_tweets+=1
					url_list_tweet[url]=[]
					if(asp in welfare):
						arr[0][1]+=1
						url_list_tweet[url].append(0)
					if(asp in middle_class):
						arr[1][1]+=1
						url_list_tweet[url].append(1)
					if(asp in neo_liberal):
						arr[2][1]+=1
						url_list_tweet[url].append(2)
					if(asp in informal_sector):
						arr[3][1]+=1
						url_list_tweet[url].append(3)
					if(asp in government):
						arr[4][1]+=1
						url_list_tweet[url].append(4)
			
				elif((asp in asp_list) and (url in url_list_tweet)):
					lis = url_list_tweet[url.strip()]
					if((asp in welfare) and (0 not in lis)):
						arr[0][1]+=1
						url_list_tweet[url].append(0)
					if((asp in middle_class) and (1 not in lis)):
						arr[1][1]+=1
						url_list_tweet[url].append(1)
					if((asp in neo_liberal) and (2 not in lis)):
						arr[2][1]+=1
						url_list_tweet[url].append(2)
					if((asp in informal_sector) and (3 not in lis)):
						arr[3][1]+=1
						url_list_tweet[url].append(3)
					if((asp in government) and (4 not in lis)):
						arr[4][1]+=1
						url_list_tweet[url].append(4)
						
			break
					
		
category_lis = ['poor','middle_class','corporate','informal_sector','government']

for i in range(5):
	val1 = float(arr[i][0])/float(tot_articles)
	val2 = float(arr[i][1])/float(tot_tweets)
	val3 = float(arr[i][2])/float(tot_ques)
	cur.execute("""INSERT INTO categorywise_cov_overall(event_id,category,massmedia_coverage,socialmedia_community_coverage,QH_coverage)
		VALUES (3,%(txt)s,%(fl1)s,%(fl2)s,%(fl3)s);""",
		{'txt':category_lis[i],'fl1':val1,'fl2':val2,'fl3':val3})
		
conn.commit()
print('Records inserted succesfully')
conn.close()		
		
		

