from scipy.stats import entropy
import numpy as np
import psycopg2

conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")

cur = conn.cursor()

cur.execute("SELECT event_id,newspaper,coverage from massmedia_aspectwise_coverage")
rows = cur.fetchall()
cov_hindu = []
cov_ht = []
cov_toi = []
cov_teleg = []
cov_nie = []
cov_ie = []
cov_dech = []

for row in rows:

   if(row[0] == 3):
      if(row[1]=='thehindu'):
         cov_hindu.append(float(row[2]))
      elif(row[1]=='hindustantimes'):
         cov_ht.append(float(row[2]))
      elif(row[1]=='timesofindia'):
         cov_toi.append(float(row[2]))
      elif(row[1]=='telegraph'):
         cov_teleg.append(float(row[2]))
      elif(row[1]=='newindianexpress'):
         cov_nie.append(float(row[2]))
      elif(row[1]=='indianexpress'):
         cov_ie.append(float(row[2]))
      elif(row[1]=='deccanherald'):
         cov_dech.append(float(row[2]))   

print ("Operation done successfully")
conn.commit()

cur.execute("SELECT event_id,aspect_id,mean_coverage from mean_aspect_cov")
rows = cur.fetchall()
mean_topic = []

for row in rows:

   if(row[0]==3):
      mean_topic.append(float(row[2]))
      
print ("Operation done successfully")
conn.commit()

#cur.execute('''CREATE TABLE KL_div_result
#      (event_id INT NOT NULL,
#       newspaper TEXT NOT NULL,
#       Symmetric_KL_div decimal NOT NULL,
#       Mean_Entropy decimal NOT NULL,
#       PRIMARY KEY (event_id,newspaper));''')
      
#print ("Table created successfully")
#conn.commit()

def KLdivergence(given_dist,target_dist):
    # print('Symmetric KL divergence')
    KL_div = 0.0
    for i in range(len(given_dist)):
        KL_div = KL_div + findEntropy(float(given_dist[i]),float(target_dist[i]))
    return KL_div

def findEntropy(p,q):
    if p > 0 and q > 0:
        return ((p * np.log(float(p) / float(q))) )#+ (q * np.log(q/p)) )
    return 0

def findMeanEntropy(p,m):
    output = 0.0
    for i in range(len(p)):
        val = 0.0
        if m[i] > 0:
            val = p[i] * np.log(float(m[i]))
        output = output + val
    return output

def findMeanEntropy1(m):
    output = 0.0
    for i in range(len(m)):
        val = 0.0
        if m[i] > 0:
            val = m[i] * np.log(float(m[i]))
        output = output + val
    return output
    
def findAspectwiseDivergence(given_dist,target_dist):
    KL_div_p_mean = []
    num_topics = len(given_dist)
    for j in range(num_topics):
        q = target_dist[j]
        p = given_dist[j]
        div = 0
        if p > 0 and q > 0:
            div = p*np.log(float(p)/float(q))
        KL_div_p_mean.append(str(div))
    return ';'.join(KL_div_p_mean)

newspaper = ['HINDU', 'HINDUSTANTIMES', 'TIMESOFINDIA', 'TELEGRAPH', 'NEWINDIANEXPRESS', 'INDIANEXPRESS',
             'DECCANHERALD']
short_newspaper =['Hindu','HT','TOI','TeleG','NIE','IE','DECH']

for i,newsp in enumerate(newspaper):
    if(i==0):
        d = KLdivergence(mean_topic,cov_hindu)
        d1 = findMeanEntropy(mean_topic,cov_hindu)
    elif(i==1):
        d = KLdivergence(mean_topic,cov_ht)
        d1 = findMeanEntropy(mean_topic,cov_ht)
    elif(i==2):
        d = KLdivergence(mean_topic,cov_toi)
        d1 = findMeanEntropy(mean_topic,cov_toi)
    if(i==3):
        d = KLdivergence(mean_topic,cov_teleg)
        d1 = findMeanEntropy(mean_topic,cov_teleg)
    if(i==4):
        d = KLdivergence(mean_topic,cov_nie)
        d1 = findMeanEntropy(mean_topic,cov_nie)
    if(i==5):
        d = KLdivergence(mean_topic,cov_ie)
        d1 = findMeanEntropy(mean_topic,cov_ie)
    if(i==6):
        d = KLdivergence(mean_topic,cov_dech)
        d1 = findMeanEntropy(mean_topic,cov_dech)
    
    cur.execute("""INSERT INTO KL_div_result(event_id,newspaper,Symmetric_KL_div,Mean_Entropy)
    VALUES (3,%(txt)s,%(fl1)s,%(fl2)s);""",
    {'txt':short_newspaper[i],'fl1':d,'fl2':d1})
    
conn.commit()
print('Records inserted succesfully')
conn.close()


