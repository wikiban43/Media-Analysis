
import psycopg2
import numpy as np

conn = psycopg2.connect(database="debanjan_media_database", user = "debanjan_final", password = "Deb@12345", host = "10.237.26.159", port = "5432")

print ("Opened database successfully")

cur = conn.cursor()

#cur.execute('''CREATE TABLE event_info
#      (event_id INT NOT NULL,
#      event_name text NOT NULL,
#      keywords text NOT NULL,
#      description text NOT NULL,
#      PRIMARY KEY (event_id));''')

#cur.execute('''DELETE FROM event_info where event_id=4''')
#conn.commit()

event_name = ['aadhaar_hindi','demon_hindi','gst_hindi','DI_hindi']

id1=[4,5,6,7]

keyword_list = ['आधार | आधार कार्ड | यूआईडीएआई | यू आई डी ए आई | यू.आई.डी.ए.आई | आधार सक्षम भुगतान प्रणाली | भारतीय विशिष्ट पहचान प्राधिकरण | भा.वि.प.प्रा. | ई-आधार | ई आधार | एईपीएस | ए ई पी एस | एनपीसीआई | एन पी सी आई | एन.पी.सी.आई | बायोमेट्रिक | यूआईडी | यू आई डी | यू.आई.डी ','नोटबंदी | विमुद्रीकरण | काला धन |क ाले धन | जाली नोट | जाली नोटों | बेनामी लेनदेन (निषेध) अधिनियम | बेनामी लेनदेन | कालाधन | भ्रष्टाचार | नकली नोट','वस्तु एवं सेवा कर | GST | गुड्स एंड सर्विसिज़ टैक्स | वसेक | जीएसटी | जी एस टी | माल और सेवा कर | जी.एस.टी','डिजिटल भारत | डिजिटल इंडिया | ई-संपर्क | ई संपर्क | डिजिटल लॉकर | बॉयोमीट्रिक | ई-कैबिनेट | डिजिटल']

description_list = ['An initiative by the government to give every Indian resident a biometric-based unique identification number. The data is collected by the Unique Identification Authority of India (UIDAI), a statutory authority under the jurisdiction of the Ministry of Electronics and Information Technology. The issue has been criticized owing to lack of security and privacy in citizens’ data collection and storage mechanisms, and also because of an allegedly faulty implementation of the platform or use of the platform by different agencies.','A policy event where the government on 8 November, 2016 banned all 500 INR and 1000 INR banknotes with the motive of curtailing the use of illicit and counterfeit cash used to fund illegal activity and terrorism. The move was widely criticized owing to multiple problems caused to common people due to sudden depletion of liquidity, irregularities in norms of exchanging old currency notes, cash exhaustion in ATMs, and so on.','An indirect tax levied in India on the sale of goods and services. It is levied at each step of the production value-chain with an effort towards formalization in the industry and simplification of multiple types of taxes which preceded the GST regime. Since its implementation there have been intense debates though on its complexity and problems in implementation which have impacted the overall growth of the economy.','It is a campaign launched by the Government of India,which includes plans to connect rural areas with high-speed Internet networks.']


for index in range(4):

	cur.execute("""INSERT INTO event_info(event_id, event_name, keywords, description)
	VALUES (%(a)s, %(b)s, %(c)s, %(d)s);""",   
	{'a':id1[index],'b': event_name[index], 'c': keyword_list[index],'d': description_list[index]})


conn.commit()
print ("Records created successfully")
conn.close()

