from pymongo import MongoClient
import psycopg2
import numpy as np
from py2neo import Graph


client = MongoClient('act4dgem.cse.iitd.ac.in', 27017)
db = client['eventwise_media-db']
db_from = client['media-db']
coll = db['all_media_entities_unresolved']
coll_from = db_from['resolved_entities_overall']
'''
conn = psycopg2.connect(database="media_database", user = "deb", password = "Deb@12345", host = "act4dgem.cse.iitd.ac.in", port = "5432")

print ("Opened database successfully")

cur = conn.cursor()

cur.execute("SELECT author_name from aspect_cov_authors")
rows = cur.fetchall()
author_list = []
for name in rows:
	print('Done1')
	if(name[0] not in author_list):
		coll.insert({'resolved':'false','associatedEntities':[],'stdName':name[0],'type':'Person','aliases':[name[0]],'articleIds':[]})
		author_list.append(name[0])
		
conn.commit()

cur.execute("SELECT author_name from category_cov_authors")
rows = cur.fetchall()
for name in rows:
	print('Done2')
	if(name[0] not in author_list):
		coll.insert({'resolved':'false','associatedEntities':[],'stdName':name[0],'type':'Person','aliases':[name[0]],'articleIds':[]})
		author_list.append(name[0])
		
conn.commit()
conn.close()
'''
author_list = []
docs = coll_from.find({})
for doc in docs:
	print('Done1')
	try:
		name = doc['stdName']
		alias_list = doc['aliases']
		art_ids = doc['articleIds']
		coll.insert({'resolved':'false','associatedEntities':[],'stdName':name,'type':'Person','aliases':alias_list,'articleIds':art_ids})
	except:
		print('key error')
		
	

graph = Graph(host='10.237.27.115', user='neo4j', password='yoyo', port=7474, scheme='https')
print('connected')
for record in graph.run("MATCH (p:person) RETURN p.alias,p.aliases,labels(p),p.name"):
	try:
		if(record[0]!=""):
			record[1].append(record[0])
		if record[1]==[]:
			record[1].append(record[3])
		coll.insert({'resolved':'false','associatedEntities':[],'stdName':record[3],'type':'Person','aliases':record[1],'labels':record[2],'articleIds':[]})
	except AttributeError as err:
		lis = []
		lis.append(record[0])
		if lis==[]:
			lis.append(record[3])
		coll.insert({'resolved':'false','associatedEntities':[],'stdName':record[3],'type':'Person','aliases':lis,'labels':record[2],'articleIds':[]})
	print('Done2')
		
