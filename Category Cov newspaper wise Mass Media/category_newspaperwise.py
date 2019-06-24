import sys
import numpy as np
from pymongo import MongoClient
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

#cur.execute('''CREATE TABLE category_newspaperwise_cov
#      (event_id INT NOT NULL,
#       newspaper text NOT NULL,
#       category text NOT NULL,
#      coverage decimal NOT NULL,
#       PRIMARY KEY (event_id,newspaper,category));''')
      
#print ("Table created successfully")
#conn.commit()

cur.execute("SELECT event_id,asp_id,url,word_cnt from art_info_final")
rows = cur.fetchall()
category_list = []
art_urls = []
word_count = []

for row in rows:

   if(row[0] == 3):
      category_list.append(row[1])
      art_urls.append(row[2])
      word_count.append(row[3])

print ("Operation done successfully")
conn.commit()

cnt = 0
arr = np.zeros((7,6),dtype=float)
url_list = {}
newspaper_list = ['thehindu','hindustan','timesofindia','telegraph','newindianexpress','indianexpress','deccanherald']
cat_lis = ['poor','middle_class','corporate','informal_sector','government']

for i in range(len(art_urls)):
	cnt+=1
	print('Done for '+str(cnt)+' article')
	aspct = category_list[i]
	words = word_count[i]
	url = art_urls[i]
	for j in range(7):
		if(newspaper_list[j] in url):
			for asp in aspct:
				if((int(asp) in asp_list) and (url.strip() not in url_list)):
					arr[j][5]+=float(words)
					url_list[url.strip()] = []
					if(int(asp) in welfare):
						arr[j][0]+=float(words)
						url_list[url.strip()].append(0)
					if(int(asp) in middle_class):
						arr[j][1]+=float(words)
						url_list[url.strip()].append(1)
					if(int(asp) in neo_liberal):
						arr[j][2]+=float(words)
						url_list[url.strip()].append(2)
					if(int(asp) in informal_sector):
						arr[j][3]+=float(words)
						url_list[url.strip()].append(3)
					if(int(asp) in government):
						arr[j][4]+=float(words)
						url_list[url.strip()].append(4)

				elif((int(asp) in asp_list) and (url.strip() in url_list)):
					lis = url_list[url.strip()]
					if((int(asp) in welfare) and (0 not in lis)):
						arr[j][0]+=float(words)
						url_list[url.strip()].append(0)
					if((int(asp) in middle_class) and (1 not in lis)):
						arr[j][1]+=float(words)
						url_list[url.strip()].append(1)
					if((int(asp) in neo_liberal) and (2 not in lis)):
						arr[j][2]+=float(words)
						url_list[url.strip()].append(2)
					if((int(asp) in informal_sector) and (3 not in lis)):
						arr[j][3]+=float(words)
						url_list[url.strip()].append(3)
					if((int(asp) in government) and (4 not in lis)):
						arr[j][4]+=float(words)
						url_list[url.strip()].append(4)

			break

for i in range(7):
	for j in range(5):
		val = arr[i][j]/arr[i][5]
		cur.execute("""INSERT INTO category_newspaperwise_cov(event_id,newspaper,category,coverage)
		VALUES (3,%(txt1)s,%(txt2)s,%(fl)s);""",
		{'txt1':newspaper_list[i],'txt2':cat_lis[j],'fl':val})
			
conn.commit()
print('Records inserted succesfully')
conn.close()


