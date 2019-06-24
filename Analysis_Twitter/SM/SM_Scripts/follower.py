import tweepy
import sys
import te
import time
# 94761188 - newindianexpress
# 268201193 - deccanherald
# 1613094806956702521
# 1613094806956702521
# 1613094806956702521

#dh_id = '268201193'
#nie_id = '94761188' 
inc_india = '1153045459'
bjp4india = '207809313'
#num_valid_tokens = 26
#deccanherald_users = {}
user_file = open(sys.argv[1],'w')
def check_valid_tokens():
	
	CK,CS,AT,AS = te.get_access('/home/sanket/SMA/SMA/tweets/twitter_access_keys.csv') # // file name of access token files
	print len(CK)
	
	for i in xrange(len(CK)): 
		print i
		auth = tweepy.OAuthHandler(CK[i], CS[i])
		auth.set_access_token(AT[i], AS[i])
		api = tweepy.API(auth)
		try :
			print len(api.followers_ids(user_id='268201193'))
		except tweepy.error.TweepError as e:
			print e.reason




def get_followers(account_id):
	def process_page(page):
		print len(page)
		for x in page:
			user_file.write(str(x)+'\n') 
	CK,CS,AT,AS = te.get_access('/home/sanket/SMA/SMA/tweets/twitter_access_keys.csv')
	A = []
	for x in xrange(26):
		A.append(-1)
	i=0
	auth = tweepy.OAuthHandler(CK[i],CS[i])
	auth.set_access_token(AT[i],AS[i])
	api = tweepy.API(auth)
	n_cursor = -1
	start = time.time()
	log_file = open('error_file','w')
	log_file.write('start time : '+str(start)+'\n')
	cursor_file = open('cursor_file','w')
	A[i] = start
	num_users = 0
	while True:
		if n_cursor ==0:
			break	
		try:
			fid_list,c_info = api.followers_ids(user_id=account_id,cursor=n_cursor)
			process_page(fid_list)
			num_users += len(fid_list)
			cursor_file.write(str(n_cursor)+','+str(c_info[0])+'\n')
			n_cursor = c_info[1]
		except tweepy.RateLimitError as Rl:
			t = time.time()
			A[i] = t
			i+=1
			log_file.write('rate_limit,'+str(n_cursor)+','+str(t-start)+'\n')
			if i == 26:
				i = 0
			if t - A[i] < 900:
				print '----->',i,t-A[i]
				time.sleep(900 - (t-A[i]))
			auth = tweepy.OAuthHandler(CK[i],CS[i])
			auth.set_access_token(AT[i],AS[i])
			api = tweepy.API(auth)
		except tweepy.error.TweepError as Ue:
			t = time.time()
			if Ue.reason[-3:] == '429':
				A[i] = t
				log_file.write('rate_limit'+str(n_cursor)+','+str(t-start)+'\n')
				i+=1
				if i == 26:
					i=0
				if t - A[i] < 900:
					time.sleep(900 - (t-A[i]))
				auth = tweepy.OAuthHandler(CK[i],CS[i])
				auth.set_access_token(AT[i],AS[i])
				api = tweepy.API(auth)
			else:
				log_file.write('unknown_error'+str(n_cursor)+','+str(t-start)+'\n')
				print Ue.reason
				break
		except:
			t = time.time()
			log_file.write('unknown_error'+str(n_cursor)+','+str(t-start)+'\n')
			print sys.exc_info()
			break

def get_url_tweets():

	agri_url_file = open('/home/sanket/Downloads/Data_1/Agriculture_article_data.csv','r')
	CK,CS,AT,AS = te.get_access('/home/sanket/SMA/SMA/tweets/twitter_access_keys.csv')
	i=0
	auth = tweepy.OAuthHandler(CK[i],CS[i])
	auth.set_access_token(AT[i],AS[i])
	api = tweepy.API(auth)

	for line in agri_url_file:
		i+=1
		if line!='':
			row = line.split(';')
			url = row[-1][:-1]
			query = url.split('/')[-1]
			print query
		if i==100:
			break

		tweets = tweepy.Cursor(api.search, q='url:'+query)

		for tweet in tweets.items():
			print tweet
	

	'''
	CK,CS,AT,AS = te.get_access('/home/sanket/SMA/SMA/tweets/twitter_access_keys.csv')
	A = []
	for x in xrange(26):
		A.append(-1)
	i=0
	auth = tweepy.OAuthHandler(CK[i],CS[i])
	auth.set_access_token(AT[i],AS[i])
	api = tweepy.API(auth)
	n_cursor = -1
	start = time.time()
	log_file = open('error_file','w')
	log_file.write('start time : '+str(start)+'\n')
	cursor_file = open('cursor_file','w')
	A[i] = start
	while True:
		if n_cursor ==0:
			break	
		try:
			fid_list,c_info = api.followers_ids(user_id=account_id,cursor=n_cursor)
			process_page(fid_list)
			cursor_file.write(str(n_cursor)+','+str(c_info[0])+'\n')
			n_cursor = c_info[1]
		except tweepy.RateLimitError as Rl:
			t = time.time()
			A[i] = t
			i+=1
			log_file.write('rate_limit,'+str(n_cursor)+','+str(t-start)+'\n')
			if i == 26:
				i = 0
			if t - A[i] < 900:
				time.sleep(900 - (t-A[i]))
			auth = tweepy.OAuthHandler(CK[i],CS[i])
			auth.set_access_token(AT[i],AS[i])
			api = tweepy.API(auth)
		except tweepy.error.TweepError as Ue:
			t = time.time()
			if Ue.reason[-3:] == '429':
				A[i] = t
				log_file.write('rate_limit'+str(n_cursor)+','+str(t-start)+'\n')
				i+=1
				if i == 26:
					i=0
				if t - A[i] < 900:
					time.sleep(900 - (t-A[i]))
				auth = tweepy.OAuthHandler(CK[i],CS[i])
				auth.set_access_token(AT[i],AS[i])
				api = tweepy.API(auth)
			else:
				log_file.write('unknown_error'+str(n_cursor)+','+str(t-start)+'\n')
				print Ue.reason
				break
		except:
			t = time.time()
			log_file.write('unknown_error'+str(n_cursor)+','+str(t-start)+'\n')
			print sys.exc_info()
			break
	'''



def main():
	acc_id = sys.argv[2]
	get_followers(acc_id)
	#get_url_tweets();

	'''
	CK,CS,AT,AS = te.get_access('/home/sanket/SMA/SMA/tweets/twitter_access_keys.csv')
	i=0
	auth = tweepy.OAuthHandler(CK[1],CS[1])
	auth.set_access_token(AT[1],AS[1])
	api = tweepy.API(auth)

	tweets = api.search(q='\"url:Cash-flow-to-rural-areas-hit-as-coop-banks-get-no-leeway\"',count=1)

	print tweets
	'''
	

if __name__ == '__main__':
	main()
