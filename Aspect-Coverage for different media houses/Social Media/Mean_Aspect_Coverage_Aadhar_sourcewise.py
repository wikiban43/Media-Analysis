import sys
import sqlite3
import time
import itertools
import numpy as np
from pymongo import MongoClient
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer

#CONNECT TO MONGO DATABASE

aadhar_article_data = np.loadtxt("aadhar_article_data_20.csv",dtype=str,delimiter=";")

client = MongoClient('localhost', 27017)
db = client['AAdhar_db']
coll = db['aadharTWEETS']

newspaper_list = ['thehindu','hindustantimes','timesofindia','telegraph','newindianexpress','indianexpress','deccanherald']
#fp1=open('newspaper_wise_count_category_aadhar_new','w')
fp1=open('newspaper_wise_sent_aadhar_new','w')

print('connection established successfully')

#New Tweet Part

all_docs=coll.find({})
url_list = []
sent = []
pos = []
neg = []

for art in all_docs:
	url_list.append(str(art['article_url'].strip()))
	sent.append(str(art['compound']))
	pos.append(str(art['pos']))
	neg.append(str(art['neg']))
		
array_to_write_sent = np.zeros((7,21),dtype=float)
array_to_write_pos = np.zeros((7,21),dtype=float)
array_to_write_neg = np.zeros((7,21),dtype=float)

mass_media_urls = aadhar_article_data[:,9]
mass_media_category = aadhar_article_data[:,0]
cat=[]

for i in range(len(url_list)):
	print("Done for "+str(i)+" url new")
	cat=[]
	for j in range(len(mass_media_urls)):
		if(url_list[i]==mass_media_urls[j]):
			for k in range(len(newspaper_list)):
				if(newspaper_list[k] in url_list[i]):
					array_to_write_sent[k][float(mass_media_category[j])]+=float(sent[i])
					array_to_write_pos[k][float(mass_media_category[j])]+=float(pos[i])
					array_to_write_neg[k][float(mass_media_category[j])]+=float(neg[i])
					break

'''
#Old Tweet Part

old_tweets = coll2.find({})

for art in old_tweets:
	u=art['article_url'].strip()
	url_list_old.append(u)
	sent_list_old.append(art['SentimentOfTweets'])

for i in range(len(url_list_old)):
	print("Done for "+str(i)+" url old")
	for j in range(len(mass_media_urls)):
		if(url_list_old[i]==mass_media_urls[j]):
			for k in range(len(newspaper_list)):
				if(newspaper_list[k] in url_list_old[i]):
					array_to_write_cat[k][int(mass_media_category[j])]+=1
					array_to_write_sent[k][int(mass_media_category[j])]+=float(sent_list_old[i])
				break
'''
li = [0,1,3,4,5,6,7,8,9,10,11,12,13,14,17,18,19]
for i in range(len(newspaper_list)):
	fp1.write(str(newspaper_list[i])+'\n')
	for j in range(21):
		if(j in li):
			fp1.write(str(array_to_write_sent[i][j])+';'+str(array_to_write_pos[i][j])+';'+str(array_to_write_neg[i][j])+'\n')

fp1.close()

