from pymongo import MongoClient
import psycopg2
import numpy as np


client = MongoClient('act4dgem.cse.iitd.ac.in', 27017)
db = client['eventwise_media-db']
coll_list = ['aadhar_articles_hindi','demon_articles_hindi','GST_articles_hindi','DI_articles_hindi']
data_list = ['article_data_Aadhar14.csv','article_data_Demon_14.csv','article_data_GST_14.csv','article_data_DI_18.csv']
event_idlist = [4,5,6,7]

conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")

cur = conn.cursor()

cur.execute('''CREATE TABLE hindi_art_info_final
	 (event_id INT NOT NULL,
	 article_id text NOT NULL,
	 asp_id numeric[] NOT NULL,
	 url text NOT NULL,
	 word_cnt numeric NOT NULL,
	 newssource text NOT NULL,
	 pos_sentiment numeric NOT NULL,
	 neg_sentiment numeric NOT NULL,
	 date DATE NOT NULL,
      PRIMARY KEY (event_id,article_id));''')
      
print ("Table created successfully")
conn.commit()
cnt = 0

for index in range(4):
	coll = db[coll_list[index]]
	docs = coll.find({})
	data = np.loadtxt(data_list[index],dtype=str,delimiter=';')
	for art in docs:
		cnt+=1
		print('Done for '+str(cnt)+' article')
		id1=str(art['_id'])
		arturl = art['url'].strip()
		date = art['published_date']
			
		asp = []
			
		for val in data:
			if(arturl==val[5].strip()):
				source = val[1]
				asp.append(int(val[0]))
				word = int(val[2])
				sent_pos = float(val[3])
				sent_neg = float(val[4])
			
		cur.execute("""INSERT INTO hindi_art_info_final(event_id,article_id,asp_id,url,word_cnt,newssource,pos_sentiment,neg_sentiment,date)
		VALUES (%(a)s,%(b)s,%(c)s,%(d)s,%(e)s,%(f)s,%(g)s,%(h)s,%(i)s);""",
		{'a':event_idlist[index],'b':id1,'c':asp,'d':arturl,'e':word,'f':source,'g':sent_pos,'h':sent_neg,'i':date})

	
conn.commit()
print('Records inserted succesfully')
conn.close()
					
				
