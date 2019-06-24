import multiprocessing as mp
import Queue
import json
import te
import tweepy
import time
import sys
import trim_tweet


# Queues used for dividing the workload between the processes
untwq = mp.Queue()
uq = mp.Queue()

num_processes = 0

# function that downloads tweets and logs errors and exceptions if any occur
def dwut(q1,q2,n):
	A = [0,0,0,0]
	fi = 0
	print 'entered', n
	log_file = open('dlog_file_'+str(n)+'.txt','w')
	start = time.time()
	log_file.write(str(start)+'\n')
	i=0
	j=0
	k=0
	CK,CS,AT,AS = te.get_access('twitter_access_keys.csv')
	auth = tweepy.OAuthHandler(CK[n], CS[n])
	auth.set_access_token(AT[n], AS[n])
	api = tweepy.API(auth)
	user_file = open('duser_file_'+str(n)+'.json','w')
	while True:
		if q1.empty():
			break
		try:
			x = q1.get(timeout=10)
			#print x
			alltweets = []
			for page in tweepy.Cursor(api.user_timeline,user_id = x,tweet_mode='extended',count=200).pages():
				alltweets.extend(page)
			if len(alltweets) == 0:
				pass
			fil = open('./dstorage'+str(n)+'/'+alltweets[0]._json["user"]["id_str"]+'.json','w')
			tw = []
			for status in alltweets:
				tw.extend(trim_tweet.trim(status._json))
			json.dump(tw,fil)
			fil.close()
			fi+=1
			json.dump(alltweets[0]._json["user"],user_file)
			user_file.write('\n')
			#q2.put(alltweets)
		except tweepy.RateLimitError as Rl:
			t = time.time()
			####
			A[i] = t
			i+=1
			log_file.write('RLuser: '+x+'\n'+Rl.reason+' time:'+str(t-start)+'\n')
			if i == 4:
				i = 0
			if t - A[i] < 900:
				time.sleep(900 - (t-A[i]))

			auth = tweepy.OAuthHandler(CK[n+i*num_processes], CS[n+i*num_processes])
			auth.set_access_token(AT[n+i*num_processes], AS[n+i*num_processes])
			api = tweepy.API(auth)

		except tweepy.error.TweepError as Ue:
			t = time.time()
			if Ue.reason[-3:] == '429':
				A[i] = t
				log_file.write('Captured '+x+'\ntime:'+str(t-start)+'\n')
				i+=1
				if i == 4:
					i=0
				if t - A[i] < 900:
					time.sleep(900 - (t-A[i]))
				auth = tweepy.OAuthHandler(CK[n+i*num_processes], CS[n+i*num_processes])
				auth.set_access_token(AT[n+i*num_processes], AS[n+i*num_processes])
				api = tweepy.API(auth)
			else:
				log_file.write('Guser: '+x+'\n'+Ue.reason+' time:'+str(time.time()-start)+'\n')
			j+=1
			if j == 500:
				break

			#print(Ue.reason)
			#print n
		except Queue.Empty:
			print n, 'exiting'
			break
		
		except Exception as e:
			k+=1
			log_file.write('user: '+x+'\n'+str(sys.exc_info()[0])+' time:'+str(time.time()-start)+'\n')
			if k == 5:
				log_file.write(str(sys.exc_info()[2]))
				break
		

	print fi, n
	log_file.close()
	user_file.close()

if __name__ == "__main__":
	procs = []

	# open the user list file and add the usreids to a queue
	with open(sys.argv[1],'r') as fp:
		user_list = json.load(fp)
	k = 0
	for key in user_list:
		untwq.put(str(key))

	num_processes = int(sys.argv[2])

	# start the required no. of processes
	for i in range(int(sys.argv[2])):
		proc = mp.Process(target=dwut,args=(untwq,uq,i))
		procs.append(proc)
		proc.start()
	print 'running'

	# ensure that all the processes finish before exiting
	for proc in procs:
		proc.join()

#process tweet queue
