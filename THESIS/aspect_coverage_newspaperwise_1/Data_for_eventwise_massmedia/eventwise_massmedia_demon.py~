import sys
import sqlite3
import time
import itertools
import numpy as np
from pymongo import MongoClient
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer

client = MongoClient('mongodb://10.237.26.154:27017/')
db = client['media-db']
demon_article_data = np.loadtxt("demon_article_data_20.csv",dtype=str,delimiter=";")
url_list = demon_article_data[:,9]
word_count = demon_article_data[:,2]
sent_pos = demon_article_data[:,7]
sent_neg = demon_article_data[:,8]
sent = demon_article_data[:,6]

coll = db['Demonitisation_article_2Aug']
articles = coll.find({})

newspaper_list = ['thehindu','hindustantimes','timesofindia','telegraph','newindianexpress','indianexpress','deccanherald']
fp1=open('event_wise_count_category_massmedia_demon','w')
count_cat = np.zeros((7,1),dtype=int)
count_word = np.zeros((7,1),dtype=int)
count_sent = np.zeros((7,1),dtype=int)
count_pos = np.zeros((7,1),dtype=int)
count_neg = np.zeros((7,1),dtype=int)
count = 0

for art in articles:
	count+=1
	print('Done for '+str(count)+' url')
	url = art['articleUrl']
	for i in range(len(newspaper_list)):
		if(newspaper_list[i] in url):
			count_cat[i][0]+=1
			for j in range(len(url_list)):
				if(url_list[j]==url):
					count_word[i][0]+=int(word_count[j])
					count_sent[i][0]+=int(sent[j])
					count_pos[i][0]+=int(sent_pos[j])
					count_neg[i][0]+=int(sent_neg[j])
					break
			break
			
for i in range(len(newspaper_list)):
	fp1.write(str(newspaper_list[i])+'\n')
	fp1.write(str(count_cat[i][0])+';'+str(count_word[i][0])+';'+str(count_sent[i][0])+';'+str(count_pos[i][0])+';'+str(count_neg[i][0])+'\n')

fp1.close()
