from pymongo import MongoClient
from elasticsearch import Elasticsearch
from elasticsearch import helpers
import pprint
from  bson import objectid
import re
from metaphone import doublemetaphone
import editdistance
import jellyfish
#import config
#import csv

#es = Elasticsearch(timeout=30)
pp = pprint.PrettyPrinter(indent=4)

es = Elasticsearch('act4dgem.cse.iitd.ac.in', port=9200, timeout=None)

#client = MongoClient(config.mongoConfigs['host'], config.mongoConfigs['port'], j=True)
client = MongoClient('mongodb://act4dgem.cse.iitd.ac.in:27017/')
db = client['eventwise_media-db'] 
es_index='media-all_auth'
es_mapping='entities_resolved_all_auth'
mongo_coll='all_author_entities_resolved'

f2=open('person.txt','a')
#write=csv.writer(f,delimiter=';')

def getAliasesObj(entity):
    aliases = ''
    if entity.get('aliases'):
        for t in entity['aliases']:
             t=str(t)
             if(t!='None'):
                 aliases += (' ' + t.lower())
    
    return {
             "match":{
                        "aliases": {
                          "query": aliases if entity.get('aliases') else 'abc',
                          "fuzziness": "AUTO"
                          # "boost":2
                        }
                }
    } 
    
def mergeAssociatedEntities(assEntities1, assEntities2):
    asscEn=assEntities1[:]
    if assEntities1==[{}]:
        if assEntities2!=[{}]:
            asscEn=assEntities2
            return asscEn
        else:
            return [{}]
    elif assEntities2==[{}]:
        if assEntities1!=[{}]:
            asscEn=assEntities1
            return asscEn
        else:
            return [{}]
    else:
        for a2 in assEntities2:
            notFound = True
            for a1 in asscEn:
                if jellyfish.jaro_winkler(a2['text'].strip().lower(),a1['text'].strip().lower())>=0.8:
                    a1['count'] = int(a1['count']) + 1
                    notFound = False
                    break
            if (notFound):
                asscEn.append(a2)
        asscEn = sorted(asscEn, key=lambda x:int(x['count']), reverse=True)
        asscEn = asscEn[:min(20, len(asscEn))]
        return asscEn

def getTitleObj(entity):
    if entity.get('title'):
        titleArr = []
        titles = ''
        for t in entity['title']:
            if t['text'] and not t['text'] in titleArr:
                titleArr.append(t['text'])
                titles = titles + ' ' + t['text']
        
        titles = titles.replace(entity['stdName'], '')
    return  {
        "match": {
                    "title.text": {
                      "query":titles if entity.get('title') else 'abc',
                      # "boost": 1.2,
                      "fuzziness": "AUTO"
                    }
                  }
    }
    
def getAssociatedEntities(entity):
    if entity.get('associatedEntities'):
        asscEntities = []
        asscEntText = ''
	
        for a in  entity['associatedEntities']:
             for i in a:
            	   if i['text'] and (not i['text'] in asscEntities):
                	  asscEntities.append(i['text'])
                	  asscEntText += (' ' + i['text'])
             if a['text'] and (not a['text'] in asscEntities):
                  asscEntities.append(a['text'])
                  asscEntText += (' ' + a['text'].lower())
    
    return  {
          "match": {
            "associatedEntities.text": {
              "query":asscEntText  if entity.get('associatedEntities') else "abc",
              # "boost": 1.2,
              "fuzziness": "AUTO"
            }
          }
        }

                                 
def containsTitle(array, title):
    for t in array:
        if t['text'] == title['text']:
            return True 
    return False

def containsContext(array, context):
    for c in array:
        if c['text'] == context['text']:
            return True
    return False

def matchExact(name1, name2):
    nametmp1=str(name1)
    nametmp2=str(name2)
    if(nametmp1=='None' or nametmp2=='None'):
        return False
    print(str(name1)+'    '+str(name2))
    name1 = re.sub('\W+',' ',name1.lower())
    name2 = re.sub('\W+',' ',name2.lower())
    name1=name1.strip()
    name2=name2.strip()
    
    if name1 == name2:
        return True
    
    splitNames1 = name1.split()
    splitNames2 = name2.split()
    
    if len(splitNames1) != len(splitNames2):
        return False
    
    for s1 in splitNames1:
        mf = False
        for s2 in splitNames2:
            if s1 == s2:
                mf = True
                break
        if not mf:
            return False
    return True

def match(name1, name2):
    nametmp1=str(name1)
    nametmp2=str(name2)
    if(nametmp1=='None' or nametmp2=='None'):
        return False
    print(str(name1)+'    '+str(name2))
    name1 = re.sub('\W+',' ',name1.lower())
    name2 = re.sub('\W+',' ',name2.lower())
    #high and low jaro
    j1=' '.join(filter(lambda x:len(x)>1,name1.split()))
    j2=' '.join(filter(lambda x:len(x)>1,name2.split()))
    
    if not (j1.strip() and j2.strip()):
        return False
    
    score=jellyfish.jaro_winkler(j1, j2)
    if score>=0.9:
        return True
    if score<=0.5:
        return False
    
    splitNames1 = name1.split()
    splitNames2 = name2.split()
    arr1 = splitNames1[:]
    arr2 = splitNames2[:]
    
    # direct match
    for s1 in splitNames1:
        s1 = s1.strip()
        for s2 in splitNames2:
            s2 = s2.strip()
            
            if len(s1) == 1 and len(s2) == 1:
                if s1 == s2:
                    arr1.remove(s1)
                    arr2.remove(s2)
                    splitNames2.remove(s2)
                    break
            elif len(s1) > 1 and len(s2) > 1:
                nameSound = doublemetaphone(s1)
                #print s1,' : ',s2,' : ' ,str(jellyfish.jaro_distance(s1, s2))
                if s1 == s2 or (nameSound == doublemetaphone(s2)) or (s1[0] == s2[0] and ((len(s1) <= 6 and editdistance.eval(s1, s2) == 1) or (len(s1) > 6 and editdistance.eval(s1, s2) == 2))):
                    arr1.remove(s1)
                    arr2.remove(s2)   
                    splitNames2.remove(s2)
                    break                                          
                
    tempArr1 = arr1[:]
    tempArr2 = arr2[:]
    
    for s1 in arr1:
        s1 = s1.strip()
        
        for s2 in arr2:
            s2 = s2.strip()
            
            if len(s1) == 1 and len(s2) > 1 and s1[0] == s2[0]:
                tempArr1.remove(s1)
                tempArr2.remove(s2)
                arr2.remove(s2)
                break
            
            elif len(s1) > 1 and len(s2) == 1 and s1[0] == s2[0]:
                tempArr1.remove(s1)
                tempArr2.remove(s2)
                arr2.remove(s2)
                break
            
    if len(tempArr1) and len(tempArr2):
        return False
    
    return True        

def namesMatched(nameArr1, nameArr2):
    # remove initials
    for n1 in nameArr1:
        for n2 in nameArr2:
            if not match(n1, n2):
                return False
    return True

def namesExactlyMatched(nameArr1, nameArr2):
    for n1 in nameArr1:
        for n2 in nameArr2:
            if not matchExact(n1, n2):
                return False
    return True

def getPersonRequest(entity):
    return {
             "query":{
                    "bool":{
                        "filter":{
                            "bool":{ 
                                "must":[
                                        {"match":{
                                                    "type": {
                                                      "query": entity['type'],
                                                      "fuzziness": "AUTO"
                                                    }
                                            }
                                       }
                                     ]
                            }
                        },
                        "must": getAliasesObj(entity),
			"should": getAssociatedEntities(entity)
                    }
                }
    }

def getChangedProperties(entity, matchedEntity):
    global id
    changedProperties = {}
    #print entity
    #print matchedEntity
    articleIds = matchedEntity['articleIds'][:]  # string format
    for a in entity['articleIds']:  # object ids
        if a not  in articleIds:
            articleIds.append(a)
    changedProperties['articleIds'] = articleIds
    changedProperties['media_ids']=[]
    
    if entity.get('media_ids'):
    	changedProperties['media_ids'].extend(entity['media_ids'])
    if matchedEntity.get('media_ids'):
    	changedProperties['media_ids'].extend(matchedEntity['media_ids'])

    if matchedEntity.get('graphid') and matchedEntity['graphid']!=None:
        changedProperties['stdName'] = matchedEntity['stdName']
        changedProperties['media_ids'].append(entity['_id'])

    elif entity.get('graphid') and entity['graphid'] !=None:
        changedProperties['stdName'] = entity['stdName']
        changedProperties['media_ids'].append(matchedEntity['_id'])
    else:
        if len(matchedEntity['stdName'].strip()) > len(entity['stdName'].strip()):
            changedProperties['stdName'] = matchedEntity['stdName']
            changedProperties['media_ids'].append(matchedEntity['_id'])
        else:
            changedProperties['stdName'] =entity['stdName']
            changedProperties['media_ids'].append(matchedEntity['_id'])
    
    aliases = matchedEntity['aliases'][:]
    for a in entity['aliases']:
        if a not in aliases:
            aliases.append(a)
    changedProperties['aliases'] = aliases
    
    asscEn = mergeAssociatedEntities(entity['associatedEntities'], matchedEntity['associatedEntities'])       
    changedProperties['associatedEntities'] = asscEn
   
    if matchedEntity.get('title'):
        titles = matchedEntity['title'][:]
    else:
        titles = []
    
    if entity.get('title'):    
        for t in entity['title']:
            matchingTextFound = False
            
            for t1 in titles:
                if (t['text'] in t1['text']) or (t1['text'] in t['text']) or jellyfish.jaro_distance(t['text'].lower(), t1['text'].lower())>=0.8:
                    for articleId in t['articleIds']:
                        if articleId not in t1['articleIds']:
                            t1['articleIds'].append(articleId)
                    matchingTextFound = True
                    break
            if not matchingTextFound:
                titles.append(t)
            
    changedProperties['title'] = titles           
    
    global f2
    line=''
    
    if entity.get('graphid') and entity['graphid'] !=None:
      graphid=entity['graphid']
      #print "****************************************MEDIADB RESOLVED******************************"
      #print entity['stdName'], matchedEntity['stdName']
      line=str(entity['graphid']) + ' ; ' + entity['stdName'].replace(';','')+ ' ; ' + str(matchedEntity['_id']) + ' ; ' + matchedEntity['stdName'].replace(';','')
      print (line)
      #print '\n'
      f2.writelines(line)
      f2.write('\n')

    elif matchedEntity.get('graphid') and matchedEntity['graphid']!=None:
      graphid=matchedEntity['graphid']
      #print "****************************************MEDIADB RESOLVED******************************"
      #print entity['stdName'], matchedEntity['stdName']
      line=str(matchedEntity['graphid']) + ' ; ' + matchedEntity['stdName'].replace(';','')+ ' ; ' + str(entity['_id']) + ' ; ' + entity['stdName'].replace(';','')
      print (line)
      #print '\n'	
      f2.writelines(line)
      f2.write('\n')
    else:
        graphid=None	

    changedProperties['graphid']=graphid
    return changedProperties
            
def serializeObjectId(entity):
    if entity.get("_id"):
        entity["_id"] = str(entity["_id"])
    if entity.get("media_ids"):
        entity["media_ids"] = str(entity["media_ids"])
    
    if entity.get('articleIds'):
        ids = [str(id) for id in entity['articleIds']]
        entity['articleIds'] = ids
    
    if entity.get('title'):
        for t in entity['title']:
            ids = [str(id) for id in t['articleIds']]     
            t['articleIds'] = ids
            
    if entity.get('context'):
        for c in entity['context']:
            c['articleId'] = str(c['articleId'])
     
def getRelevantEntities(esQuery):
    global mongo_coll
    global es_index
    global es_mapping
 #   print esQuery,es_index,es_mapping
    
    res = es.search(index=es_index, body=esQuery, doc_type=es_mapping)
    #print "\n\n***RESULT***"
    #print res
    entityIds=[]
    scores=[]
    entities=[]
    
    for i in range(len(res['hits']['hits'])):
        en=res['hits']['hits'][i]
        entityIds.append(objectid.ObjectId(en['_id']))
        scores.append(en['_score'])
    
    if len(entityIds):   
        #print entityIds
        cursor=db[mongo_coll].find({'_id':{'$in':entityIds}})
        
        for relEn in cursor:
            entityIdIndex=entityIds.index(relEn['_id'])
            score=scores[entityIdIndex]
            relEn['score']=score
            entities.append(relEn)
            
        cursor.close()
    
    return entities

def insertEntity(entity):
    db[mongo_coll].insert_one(entity)
    insertedId = entity['_id']
    del entity['_id']
    serializeObjectId(entity)
    #print entity
    es.create(index=es_index, doc_type=es_mapping, body=entity, id=str(insertedId))

def updateDelEn(matchedEntities,changedProperties):
    db[mongo_coll].update_one({'_id':matchedEntities[0]['_id']}, {"$set":changedProperties})
    if len(matchedEntities)>1:
        db[mongo_coll].delete_many({'_id':{'$in':[i['_id'] for i in matchedEntities[1:]]}})
   
    serializeObjectId(changedProperties)
    actions=[
                   {
                       '_op_type': 'update',
                       '_index': es_index,
                       '_type': es_mapping,
                       '_id': str(matchedEntities[0]['_id']),
                       'doc': changedProperties
                   }
            ] 
   
    if len(matchedEntities)>1:
        actions.extend([ {
                            '_op_type':'delete',
                            '_index': es_index,
                            '_type': es_mapping,
                            '_id': str(i['_id']),
                        } for i in matchedEntities[1:]
                    ])

    helpers.bulk(es, actions)

def resolvePersonEntity(entity):
    global es_index, es_mapping, mongo_coll
    
    request = getPersonRequest(entity)
    #print "****REQUEST****"
    #print request
    relEntities=getRelevantEntities(request)
    index = 0
    changedProperties=entity
    matchedEntities=[]
    #if not entity.get('aliases'):
	#entity['aliases']=[entity['stdName'].lower()]
    
    for relEn in relEntities:
         if entity.get('graphid') and entity['graphid'] !=None and relEn.get('graphid')and relEn['graphid'] !=None:
            #handle a case when there are two graph ids for one media id, in that case both of them must have the media id
            continue
         if (namesMatched(relEn['aliases'], changedProperties['aliases']) and relEn['score'] >= 10) or namesExactlyMatched(relEn['aliases'], changedProperties['aliases']):
            index = 1
            changedProperties = getChangedProperties(changedProperties, relEn)
            matchedEntities.append(relEn)
    
    if index == 0:
        insertEntity(entity)
    else:
        updateDelEn(matchedEntities,changedProperties)
        
        
def isAbbrOf(name1, name2):
    #name 1 and name2 are abbr
    n1=re.sub('\.','',name1).lower()
    n2=re.sub('\.','',name2).lower()
    if n1==n2:
        return True

    #name1 is abbr of name2
    n2 = re.sub('\.', ' ', name2)
    n2Arr = n2.split()
    n2WithStopWords = ''.join([x[0] for x in n2Arr]).lower()
    
    if n1 == n2WithStopWords:
        return True
    
    n2 = re.sub('of|the|and|at|for|a|an|under|with|from|into|to|in|on|by|about', ' ', name2)
    n2Arr = n2.split()
    n2WithoutStopWords = ''.join([x[0] for x in n2Arr]).lower()
    
    if n1 == n2WithoutStopWords:
        return True


    #name2 is abbr of name1
    n1 = re.sub('\.', '', name2).lower()
    
    n2 = re.sub('\.', ' ', name1)
    n2Arr = n2.split()
    n2WithStopWords = ''.join([x[0] for x in n2Arr]).lower()
    
    if n1 == n2WithStopWords:
        return True
    
    n2 = re.sub('of|the|and|at|for|a|an|under|with|from|into|to|in|on|by|about', ' ', name1)
    n2Arr = n2.split()
    n2WithoutStopWords = ''.join([x[0] for x in n2Arr]).lower()
    
    
    if n1 == n2WithoutStopWords:
        return True
    
    return False
    
if __name__ == '__main__':
    collection = db['all_author_entities_unresolved']
    while(1):
        cursor = collection.find({'$and':[{'type':{'$in':['Person']}},{'resolved':'false'}]}, no_cursor_timeout=True)
        #print cursor
        #print 'hey'
        count = 1
        for entity in cursor:
            print ('hi2')
            id=entity['_id']
            if entity['type'] == 'Person':
                print ('hi3')
                resolvePersonEntity(entity)
            print (count)
            count += 1
            collection.update_one({'_id':id}, {'$set':{'resolved':True}})
        cursor.close()
        #print 'hiend' 
        #break
    client.close()     
            
