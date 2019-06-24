from pymongo import MongoClient
import psycopg2
import numpy as np


client = MongoClient('act4dgem.cse.iitd.ac.in', 27017)
db = client['eventwise_media-db']
coll_list = ['aadhar_articles_hindi','demon_articles_hindi','GST_articles_hindi','DI_articles_hindi']
data_list = ['article_data_Aadhar14','article_data_Demon_14','article_data_GST_14','article_data_DI_18.csv']
event_idlist = [4,5,6,7]

conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")

cur = conn.cursor()

cur.execute('''CREATE TABLE hindi_art_info_final
	 (event_id INT NOT NULL,
	 article_id text NOT NULL,
	 asp_id numeric[] NOT NULL,
	 category text[] NOT NULL,
	 url text NOT NULL,
	 word_cnt numeric NOT NULL,
	 newssource text NOT NULL,
	 senti numeric NOT NULL,
	 senti_pos numeric NOT NULL,
	 senti_neg numeric NOT NULL,
	 vader_comp numeric NOT NULL,
	 vader_pos numeric NOT NULL,
	 vader_neg numeric NOT NULL,
	 date DATE NOT NULL,
      PRIMARY KEY (event_id,article_id));''')
      
print ("Table created successfully")
conn.commit()
cnt = 0

for index in range(1):
	coll = db[coll_list[index]]
	docs = coll.find({})
	data = np.loadtxt(data_list[index],dtype=str,delimiter=';')
	for art in docs:
		cnt+=1
		print('Done for '+str(cnt)+' article')
		id1=str(art['_id'])
		arturl = art['articleUrl'].strip()
		date = art['publishedDate']
		cat = []
		try:
			cat = art['categories']
		except KeyError as err:
			print('categories not found')
			
		try:
			category = art['category']
			cat.append(category)
		except KeyError as err:
			print('category not found')
			
		asp = []
			
		for val in data:
			if(arturl==val[9].strip()):
				source = val[1]
				asp.append(int(val[0]))
				word = int(val[2])
				senti = float(val[6])
				senti_pos = float(val[7])
				senti_neg = float(val[8])
				vader_comp = float(val[3])
				vader_pos = float(val[4])
				vader_neg = float(val[5])
			
		cur.execute("""INSERT INTO art_info_final(event_id,article_id,asp_id,category,url,word_cnt,newssource,senti,senti_pos,senti_neg,vader_comp,vader_pos,vader_neg,date)
		VALUES (3,%(b)s,%(c)s,%(d)s,%(e)s,%(f)s,%(g)s,%(h)s,%(i)s,%(j)s,%(k)s,%(l)s,%(m)s,%(n)s);""",
		{'b':id1,'c':asp,'d':cat,'e':arturl,'f':word,'g':source,'h':senti,'i':senti_pos,'j':senti_neg,'k':vader_comp,'l':vader_pos,'m':vader_neg,'n':date})

	
conn.commit()
print('Records inserted succesfully')
conn.close()
					
				
