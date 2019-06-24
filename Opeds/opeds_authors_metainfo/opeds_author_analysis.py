import psycopg2
from pymongo import MongoClient
import numpy as np

newssource = ['thehindu','hindustantimes','telegraph','timesofindia','newindianexpress','indianexpress','deccanherald']

conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")
cur = conn.cursor()

#cur.execute('''CREATE TABLE opeds_authors_metainfo
#      (event_id int NOT NULL,
#       author_name text NOT NULL,
#       url_list text[] NOT NULL,
#       word_cnt_list numeric[] NOT NULL,
#       newspaper_list text[] NOT NULL,
#       agg_sent_list numeric[] NOT NULL,
#       pos_sent_list numeric[] NOT NULL,
#       neg_sent_list numeric[] NOT NULL,
#       PRIMARY KEY (event_id,author_name));''')
      
#print ("Table created successfully")
#conn.commit()

cur.execute("SELECT url,word_cnt,asp_id,senti,senti_pos,senti_neg from art_info_final where event_id=3")
rows = cur.fetchall()

cnt = 0

url_lis = []
wrd_cnt = []
asp_list = []
senti = []
senti_pos = []
senti_neg = []
for art in rows:
	url_lis.append(art[0])
	wrd_cnt.append(art[1])
	asp_list.append(art[2])
	senti.append(art[3])
	senti_pos.append(art[4])
	senti_neg.append(art[5])
	
conn.commit()

	
client = MongoClient('act4dgem.cse.iitd.ac.in', 27017)
db = client['eventwise_media-db']
coll = db['farmers_opinion']

author_map_url={}
author_map_word={}
author_map_news={}
author_map_sent={}
author_map_pos={}
author_map_neg={}


docs = coll.find({})

for doc in docs:
	url = doc['articleUrl']
	try:
		auth = doc['author']
		for i in range(len(auth)):
			try:
				auth[i] = auth[i].decode("utf-8")
			except AttributeError as err:
				print('pass')
				
		if (len(auth)>0):
			for art in range(len(url_lis)):
				if(url==url_lis[art]):
					wrd = wrd_cnt[art]
					sent = senti[art]
					sent_pos = senti_pos[art]
					sent_neg = senti_neg[art]
					for people in auth:
						if people not in author_map_url:
							author_map_url[people] = []
							author_map_word[people] = []
							author_map_news[people] = []
							author_map_sent[people] = []
							author_map_pos[people] = []
							author_map_neg[people] = []
							
							author_map_url[people].append(url)
							author_map_word[people].append(wrd)
							author_map_sent[people].append(sent)
							author_map_pos[people].append(sent_pos)
							author_map_neg[people].append(sent_neg)
							
							for i in range(7):
								if newssource[i] in url:
									author_map_news[people].append(newssource[i])
									break
									
						else:
							author_map_url[people].append(url)
							author_map_word[people].append(wrd)
							author_map_sent[people].append(sent)
							author_map_pos[people].append(sent_pos)
							author_map_neg[people].append(sent_neg)
							
							for i in range(7):
								if newssource[i] in url:
									author_map_news[people].append(newssource[i])
									break
									
					break
	except KeyError as err:
		print('author key not found')
		
		
for key,data in author_map_url.items():

	cur.execute("""INSERT INTO opeds_authors_metainfo(event_id,author_name,url_list,word_cnt_list,newspaper_list,agg_sent_list,pos_sent_list,neg_sent_list)
				VALUES (3,%(b)s,%(c)s,%(d)s,%(e)s,%(f)s,%(g)s,%(h)s);""",
				{'b':str(key),'c':author_map_url[key],'d':author_map_word[key],'e':author_map_news[key],'f':author_map_sent[key],'g':author_map_pos[key],'h':author_map_neg[key]})
					
conn.commit()
print('Records inserted succesfully')
conn.close()


