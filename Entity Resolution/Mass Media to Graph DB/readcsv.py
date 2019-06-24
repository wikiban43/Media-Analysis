import pandas as pd
from pymongo import MongoClient

client = MongoClient('act4dgem.cse.iitd.ac.in', 27017)
db = client['eventwise_media-db']
coll = db['graph_city']


data = pd.read_csv('city.csv')

for val in data.itertuples():
	coll.insert({'name':val[2],'state':val[3],'uuid':val[4]})
	print('inserted another article')
