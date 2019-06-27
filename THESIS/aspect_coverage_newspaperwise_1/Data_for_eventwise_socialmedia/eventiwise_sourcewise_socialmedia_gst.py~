import sys
import sqlite3
import time
import itertools
import numpy as np
from pymongo import MongoClient
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer

client = MongoClient('localhost', 27017)
db = client['URL_RESOL']
db1 = client['Social_Media']
coll = db['gstURL']
coll1 = db1['GST_New']

newspaper_list = ['hindu','hindustan times','times of india','telegraph','new indian express','indian express','deccan herald']
fp1=open('event_wise_count_category_gst','w')
fp2=open('event_wise_agg_sent_gst','w')

count_cat = np.zeros((7,1),dtype=int)
count_sent = np.zeros((7,1),dtype=float)
count_pos = np.zeros((7,1),dtype=float)
count_neg = np.zeros((7,1),dtype=float)


docs=coll.find({},{'_id':0})
keylist = []

for doc in docs:
	for key,value in doc.items():
		keylist.append(str(key))
		
tweets = coll1.find({})
count = 0
for tweet in tweets:
	count+=1
	print('Done for '+str(count)+' tweet')
	list_of_newspapers = tweet['newspaper']
	tweet_id = tweet['_id']
	sent = tweet['compound']
	sent_pos = tweet['pos']
	sent_neg = tweet['neg']
	if(tweet_id not in keylist):
		for i in range(len(list_of_newspapers)):
			for j in range(len(newspaper_list)):
				if(newspaper_list[j]==list_of_newspapers[i]):
					count_cat[j][0]+=1
					count_sent[j][0]+=float(sent)
					count_pos[j][0]+=float(sent_pos)
					count_neg[j][0]+=float(sent_neg)
					break
					
for i in range(len(newspaper_list)):
	fp1.write(str(newspaper_list[i])+'\n')
	fp2.write(str(newspaper_list[i])+'\n')
	fp1.write(str(count_cat[i][0])+'\n')
	fp2.write(str(count_sent[i][0])+';'+str(count_pos[i][0])+';'+str(count_neg[i][0])+'\n')

fp1.close()
fp2.close()
						
