import tweepy
import time
import json
from sys import argv
'''
def Exit(x):
	print (time.time() - start)
	x.close()
	

def fetchUserTweets(x):
	ft = open(str(x)+'checktweets.json','w')
	try:
		#json.dump([status._json for status in tweepy.Cursor(api.user_timeline,user_id = x,tweet_mode='extended').items()],ft,indent =4)
		
		alltweets = []
		for page in tweepy.Cursor(api.user_timeline,user_id = str(x),tweet_mode='extended',count=200).pages():
			#alltweets.extend([status._json for status in page])
			
			for status in page:
				alltweets.extend(status._json)
				#print status._json
			
		json.dump(alltweets,ft,indent = 4)
		ft.close()
		
    	# process status here
    	#process_status(status)
		
	except tweepy.RateLimitError as Rl:
		print (Rl.reason)
		Exit(ft)
	except tweepy.error.TweepError as Ue:
		print (Ue.reason)
		Exit(ft)
'''
		
def get_access(x):
	f = open(x,'r')
	CK = []
	CS = []
	AT = []
	AS = []
	access_data = f.readline()
	while access_data != '':
		temp = access_data[:-1].split(';')
		#print temp
		CK.append(temp[0])
		CS.append(temp[1])
		AT.append(temp[2])
		AS.append(temp[3])
		access_data = f.readline()
	f.close()
	return CK,CS,AT,AS


'''
if __name__ == '__main__':
	CK,CS,AT,AS = get_access(argv[1])

	auth = tweepy.OAuthHandler(CK[0], CS[0])
	auth.set_access_token(AT[0], AS[0])

	api = tweepy.API(auth)

	#users = np.genfromtxt('/home/sanket/Desktop/Sanket/news_followers/htTweets.txt', delimiter=';', dtype=str)
	with open(argv[2],'rb') as fp:
		users = [key for key  in json.load(fp)]
	iterusers = iter(users)
	next(iterusers)
	start = time.time()
	I = 0
	for user in iterusers:
		fetchUserTweets(user)
		I+=1
		if I == 3:
			print (time.time() - start)
			break
		print (user, "done")

'''

